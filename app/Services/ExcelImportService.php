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
        
        // Load the file
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        
        // Get headers (first row)
        $headers = array_shift($rows);
        
        // Find column indexes
        $emailIndex = array_search('Email Address', $headers);
        $instagramIndex = array_search('Akun instagram', $headers);
        $nameIndex = array_search('Nama Lengkap', $headers);
        $genderIndex = array_search('Jenis Kelamin', $headers);
        
        if ($emailIndex === false || $nameIndex === false) {
            throw new \Exception('Required columns not found in the file');
        }
        
        $stats = [
            'total' => count($rows),
            'created' => 0,
            'updated' => 0,
            'failed' => 0,
            'errors' => []
        ];
        
        // Process each row
        foreach ($rows as $rowIndex => $row) {
            try {
                DB::beginTransaction();
                
                $email = trim($row[$emailIndex]);
                $name = trim($row[$nameIndex]);
                $instagram = $instagramIndex !== false ? trim($row[$instagramIndex]) : null;
                $gender = $genderIndex !== false ? trim($row[$genderIndex]) : null;
                
                if (empty($email) || empty($name)) {
                    throw new \Exception("Row " . ($rowIndex + 2) . ": Email and name are required");
                }
                
                // Check if user already exists
                $user = User::where('email', $email)->first();
                
                if (!$user) {
                    // Create new user
                    $activationToken = Str::random(60);
                    $tempPassword = Str::random(10);
                    
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make($tempPassword),
                        'is_active' => false,
                        'activation_token' => $activationToken,
                        'remember_token' => $activationToken,
                    ]);
                    
                    $stats['created']++;
                } else {
                    $stats['updated']++;
                }
                
                // Check if user is already an alumni of this batch
                $existingAlumni = BatchAlumni::where('user_id', $user->id)
                    ->where('activity_batch_id', $activityBatchId)
                    ->first();
                
                if (!$existingAlumni) {
                    // Create alumni record
                    BatchAlumni::create([
                        'user_id' => $user->id,
                        'activity_batch_id' => $activityBatchId,
                        'instagram_account' => $instagram,
                        'gender' => $gender,
                    ]);
                }
                
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $stats['failed']++;
                $stats['errors'][] = "Row " . ($rowIndex + 2) . ": " . $e->getMessage();
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
        
        // Load the file
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        
        // Get headers (first row)
        $headers = array_shift($rows);
        
        // Find column indexes
        $titleIndex = array_search('materi', $headers);
        $slideUrlIndex = array_search('slide materi', $headers);
        $notesUrlIndex = array_search('notulensi', $headers);
        $videoUrlIndex = array_search('video rekaman materi', $headers);
        
        if ($titleIndex === false || $slideUrlIndex === false) {
            throw new \Exception('Required columns not found in the file');
        }
        
        $stats = [
            'total' => 0,
            'created' => 0,
            'failed' => 0,
            'errors' => []
        ];
        
        // Process each row
        $order = 1;
        foreach ($rows as $rowIndex => $row) {
            // Skip empty rows or headers
            if (empty($row[$titleIndex]) || !isset($row[$slideUrlIndex])) {
                continue;
            }
            
            $stats['total']++;
            
            try {
                DB::beginTransaction();
                
                $title = trim($row[$titleIndex]);
                $slideUrl = trim($row[$slideUrlIndex]);
                $notesUrl = $notesUrlIndex !== false && isset($row[$notesUrlIndex]) ? trim($row[$notesUrlIndex]) : null;
                $videoUrl = $videoUrlIndex !== false && isset($row[$videoUrlIndex]) ? trim($row[$videoUrlIndex]) : null;
                
                // Create material record
                $activityBatch->materials()->create([
                    'title' => $title,
                    'slide_url' => $slideUrl,
                    'notes_url' => $notesUrl,
                    'video_url' => $videoUrl,
                    'order' => $order++,
                ]);
                
                $stats['created']++;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $stats['failed']++;
                $stats['errors'][] = "Row " . ($rowIndex + 2) . ": " . $e->getMessage();
            }
        }
        
        return $stats;
    }
}
