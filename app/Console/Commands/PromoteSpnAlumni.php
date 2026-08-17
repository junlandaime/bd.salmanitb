<?php

namespace App\Console\Commands;

use App\Models\ActivityBatch;
use App\Models\BatchAlumni;
use App\Models\SpnRegistration;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PromoteSpnAlumni extends Command
{
    protected $signature = 'spn:promote-alumni {--dry-run : Show what would happen without making changes}';

    protected $description = 'Promote verified SPN registrants to alumni after their activity batch has ended (tanggal_selesai_kegiatan passed).';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $today = Carbon::today();

        // Find activity batches where kegiatan has ended
        $endedBatches = ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })
            ->whereNotNull('tanggal_selesai_kegiatan')
            ->whereDate('tanggal_selesai_kegiatan', '<', $today)
            ->get();

        if ($endedBatches->isEmpty()) {
            $this->info('No ended activity batches found.');
            return self::SUCCESS;
        }

        $promoted = 0;
        $skipped = 0;

        foreach ($endedBatches as $batch) {
            $this->info("Processing batch: {$batch->nama_batch} (ended {$batch->tanggal_selesai_kegiatan->format('d M Y')})");

            // Get verified registrations that have a linked user who is NOT yet alumni
            $registrations = SpnRegistration::where('activity_batch_id', $batch->id)
                ->where('status', 'terverifikasi')
                ->whereNotNull('user_id')
                ->with('user')
                ->get();

            foreach ($registrations as $reg) {
                $user = $reg->user;

                if (!$user) {
                    $this->warn("  ⏭ Reg {$reg->registration_code}: No linked user, skipping.");
                    $skipped++;
                    continue;
                }

                // Check if already an alumni for this batch
                $alreadyAlumni = BatchAlumni::where('user_id', $user->id)
                    ->where('activity_batch_id', $batch->id)
                    ->exists();

                if ($alreadyAlumni) {
                    $skipped++;
                    continue;
                }

                if ($dryRun) {
                    $this->line("  🔍 [DRY-RUN] Would promote: {$reg->nama_lengkap} ({$user->email})");
                    $promoted++;
                    continue;
                }

                DB::transaction(function () use ($user, $reg, $batch) {
                    // Create BatchAlumni record
                    BatchAlumni::create([
                        'user_id' => $user->id,
                        'activity_batch_id' => $batch->id,
                        'gender' => $reg->jenis_kelamin === 'pria' ? 'Pria' : 'Wanita',
                        'instagram_account' => $reg->instagram,
                        'notes' => 'Auto-promoted from SPN registration: ' . $reg->registration_code,
                    ]);

                    // Assign alumni role if not already assigned
                    if (!$user->hasRole('alumni')) {
                        $user->assignRole('alumni');
                    }
                });

                $this->line("  ✅ Promoted: {$reg->nama_lengkap} ({$user->email})");
                $promoted++;
            }
        }

        $label = $dryRun ? '[DRY-RUN] ' : '';
        $this->newLine();
        $this->info("{$label}Done. Promoted: {$promoted}, Skipped (already alumni): {$skipped}");

        return self::SUCCESS;
    }
}
