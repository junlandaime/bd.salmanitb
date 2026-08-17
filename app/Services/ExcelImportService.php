<?php

namespace App\Services;

use App\Models\User;
use App\Models\ActivityBatch;
use App\Models\BatchAlumni;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImportService
{
    /**
     * Helper to find column index with case-insensitive and alternative name matching.
     */
    protected function findColumnIndex(array $headers, array $possibleNames): int|false
    {
        $normalizedHeaders = array_map(function($h) {
            return strtolower(trim((string)$h));
        }, $headers);

        foreach ($possibleNames as $name) {
            $index = array_search(strtolower(trim($name)), $normalizedHeaders);
            if ($index !== false) {
                return $index;
            }
        }
        return false;
    }

    /**
     * Import alumni data from Excel/CSV file
     *
     * @param string $filePath
     * @param int $activityBatchId
     * @return array
     */
    public function importAlumniData($filePath, $activityBatchId)
    {
        // Check if activity batch exists
        $activityBatch = ActivityBatch::findOrFail($activityBatchId);
        
        // Load the spreadsheet efficiently
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        
        if (empty($rows)) {
            throw new \Exception('Berkas spreadsheet kosong.');
        }

        // Get headers (first row)
        $headers = array_shift($rows);
        
        // Find column indexes with smart matching
        $emailIndex = $this->findColumnIndex($headers, ['email address', 'email', 'alamat email', 'surel', 'e-mail']);
        $nameIndex = $this->findColumnIndex($headers, ['nama lengkap', 'nama', 'name', 'full name', 'nama peserta']);
        $instagramIndex = $this->findColumnIndex($headers, ['akun instagram', 'instagram', 'ig', 'akun ig', 'username instagram']);
        $genderIndex = $this->findColumnIndex($headers, ['jenis kelamin', 'gender', 'jk', 'sex']);
        
        if ($emailIndex === false || $nameIndex === false) {
            throw new \Exception('Kolom wajib tidak ditemukan. Pastikan ada kolom "Email Address" dan "Nama Lengkap" di baris pertama berkas.');
        }
        
        $stats = [
            'total' => 0,
            'created' => 0,
            'updated' => 0,
            'failed' => 0,
            'errors' => []
        ];

        // 1. Pre-filter and collect valid emails
        $cleanRows = [];
        $emailsToLookup = [];

        foreach ($rows as $rowIndex => $row) {
            $email = isset($row[$emailIndex]) ? trim((string)$row[$emailIndex]) : '';
            $name = isset($row[$nameIndex]) ? trim((string)$row[$nameIndex]) : '';
            $instagram = ($instagramIndex !== false && isset($row[$instagramIndex])) ? trim((string)$row[$instagramIndex]) : null;
            $gender = ($genderIndex !== false && isset($row[$genderIndex])) ? trim((string)$row[$genderIndex]) : null;

            // Skip completely empty rows
            if (empty($email) && empty($name)) {
                continue;
            }

            $stats['total']++;

            if (empty($email) || empty($name)) {
                $stats['failed']++;
                $stats['errors'][] = "Baris " . ($rowIndex + 2) . ": Email dan Nama Lengkap wajib diisi.";
                continue;
            }

            $cleanRows[] = [
                'row_num' => $rowIndex + 2,
                'email' => $email,
                'name' => $name,
                'instagram' => $instagram,
                'gender' => $gender,
            ];

            $emailsToLookup[] = $email;
        }

        if (empty($cleanRows)) {
            return $stats;
        }

        // 2. Preload existing users and batch alumni in bulk (high performance)
        $existingUsers = User::whereIn('email', array_unique($emailsToLookup))
            ->get()
            ->keyBy(function($item) {
                return strtolower($item->email);
            });

        $existingUserIds = $existingUsers->pluck('id')->toArray();
        $existingAlumniUserIds = BatchAlumni::where('activity_batch_id', $activityBatchId)
            ->whereIn('user_id', $existingUserIds)
            ->pluck('user_id')
            ->flip()
            ->toArray();

        // 3. Pre-generate password hash ONCE (prevents Bcrypt 30s timeout on 100+ rows)
        $defaultHashedPassword = Hash::make(Str::random(16));

        // 4. Process in chunked transactions
        $chunks = array_chunk($cleanRows, 100);

        foreach ($chunks as $chunk) {
            DB::beginTransaction();
            try {
                foreach ($chunk as $item) {
                    $emailLower = strtolower($item['email']);
                    $user = $existingUsers->get($emailLower);

                    if (!$user) {
                        // Create new inactive user
                        $activationToken = Str::random(60);
                        
                        $user = User::create([
                            'name' => $item['name'],
                            'email' => $item['email'],
                            'password' => $defaultHashedPassword,
                            'is_active' => false,
                            'activation_token' => $activationToken,
                            'remember_token' => $activationToken,
                        ]);

                        // Cache in memory for any subsequent duplicates in the same file
                        $existingUsers->put($emailLower, $user);
                        $stats['created']++;
                    } else {
                        $stats['updated']++;
                    }

                    // Check if already linked as alumni in this batch
                    if (!isset($existingAlumniUserIds[$user->id])) {
                        BatchAlumni::create([
                            'user_id' => $user->id,
                            'activity_batch_id' => $activityBatchId,
                            'instagram_account' => $item['instagram'],
                            'gender' => $item['gender'],
                        ]);
                        
                        // Mark as added
                        $existingAlumniUserIds[$user->id] = true;
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $stats['failed'] += count($chunk);
                $stats['errors'][] = "Terjadi kendala saat menyimpan data: " . $e->getMessage();
            }
        }
        
        return $stats;
    }
    
    /**
     * Import batch materials from Excel/CSV file
     *
     * @param string $filePath
     * @param int $activityBatchId
     * @return array
     */
    public function importBatchMaterials($filePath, $activityBatchId)
    {
        // Check if activity batch exists
        $activityBatch = ActivityBatch::findOrFail($activityBatchId);
        
        // Load the spreadsheet
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        
        if (empty($rows)) {
            throw new \Exception('Berkas spreadsheet kosong.');
        }

        // Get headers (first row)
        $headers = array_shift($rows);
        
        // Find column indexes with smart matching
        $titleIndex = $this->findColumnIndex($headers, ['materi', 'judul materi', 'judul', 'title', 'nama materi']);
        $slideUrlIndex = $this->findColumnIndex($headers, ['slide materi', 'slide', 'link slide', 'slide url', 'url slide']);
        $notesUrlIndex = $this->findColumnIndex($headers, ['notulensi', 'notulensi materi', 'link notulensi', 'notes', 'catatan']);
        $videoUrlIndex = $this->findColumnIndex($headers, ['video rekaman materi', 'video rekaman', 'rekaman', 'video url', 'link video', 'youtube']);
        
        if ($titleIndex === false || $slideUrlIndex === false) {
            throw new \Exception('Kolom wajib tidak ditemukan. Pastikan ada kolom "Materi" dan "Slide Materi" di baris pertama.');
        }
        
        $stats = [
            'total' => 0,
            'created' => 0,
            'failed' => 0,
            'errors' => []
        ];
        
        // Process rows in transaction
        $order = 1;
        DB::beginTransaction();
        try {
            foreach ($rows as $rowIndex => $row) {
                $title = isset($row[$titleIndex]) ? trim((string)$row[$titleIndex]) : '';
                $slideUrl = isset($row[$slideUrlIndex]) ? trim((string)$row[$slideUrlIndex]) : '';

                // Skip empty rows
                if (empty($title) && empty($slideUrl)) {
                    continue;
                }
                
                $stats['total']++;

                if (empty($title) || empty($slideUrl)) {
                    $stats['failed']++;
                    $stats['errors'][] = "Baris " . ($rowIndex + 2) . ": Judul Materi dan Link Slide wajib diisi.";
                    continue;
                }

                $notesUrl = ($notesUrlIndex !== false && isset($row[$notesUrlIndex])) ? trim((string)$row[$notesUrlIndex]) : null;
                $videoUrl = ($videoUrlIndex !== false && isset($row[$videoUrlIndex])) ? trim((string)$row[$videoUrlIndex]) : null;
                
                $activityBatch->materials()->create([
                    'title' => $title,
                    'slide_url' => $slideUrl,
                    'notes_url' => $notesUrl ?: null,
                    'video_url' => $videoUrl ?: null,
                    'order' => $order++,
                ]);
                
                $stats['created']++;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $stats['failed'] = $stats['total'];
            $stats['errors'][] = "Gagal mengimpor materi: " . $e->getMessage();
        }
        
        return $stats;
    }
}
