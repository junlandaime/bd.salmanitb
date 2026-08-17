<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityBatch;
use App\Models\Article;
use App\Models\BatchAlumni;
use App\Models\BatchMaterial;
use App\Models\News;
use App\Models\Program;
use App\Models\Service;
use App\Models\SpnRegistration;
use App\Models\TaarufProfile;
use App\Models\TaarufQuestion;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Pusat Aksi / Pending Tasks yang Membutuhkan Respon Admin
        $pendingActions = [
            'spn_pending' => SpnRegistration::where('status', 'pending')->count(),
            'spn_pending_changes' => SpnRegistration::whereNotNull('pending_changes')
                ->whereRaw("JSON_LENGTH(pending_changes) > 0")
                ->count(),
            'taaruf_unanswered' => TaarufQuestion::where('is_answered', false)->count(),
        ];
        $totalPendingActions = $pendingActions['spn_pending'] 
            + $pendingActions['spn_pending_changes'] 
            + $pendingActions['taaruf_unanswered'];

        // 2. Data Alumni Multi-Batch (> 1 Batch)
        $multiBatchAlumniCount = User::has('batchAlumni', '>', 1)->count();
        $topMultiBatchAlumni = User::has('batchAlumni', '>', 1)
            ->with(['batchAlumni.activityBatch.activity'])
            ->withCount('batchAlumni')
            ->orderByDesc('batch_alumni_count')
            ->take(6)
            ->get();

        // 3. Statistik Komprehensif Seluruh Modul Portal
        $stats = [
            'spn' => [
                'total' => SpnRegistration::count(),
                'verified' => SpnRegistration::where('status', 'terverifikasi')->count(),
                'pending' => $pendingActions['spn_pending'],
                'total_infak' => SpnRegistration::where('status', 'terverifikasi')->sum('total_bayar'),
            ],
            'alumni' => [
                'total' => BatchAlumni::count(),
                'materials' => BatchMaterial::count(),
                'multi_batch_count' => $multiBatchAlumniCount,
            ],
            'taaruf' => [
                'total' => TaarufProfile::count(),
                'active' => TaarufProfile::where('is_active', true)->count(),
                'unanswered_questions' => $pendingActions['taaruf_unanswered'],
                'total_questions' => TaarufQuestion::count(),
                'male' => TaarufProfile::where(function($q) {
                    $q->where('gender', 'male')->orWhere('gender', 'L')->orWhere('gender', 'like', 'laki%');
                })->count(),
                'female' => TaarufProfile::where(function($q) {
                    $q->where('gender', 'female')->orWhere('gender', 'P')->orWhere('gender', 'like', 'perempuan%');
                })->count(),
            ],
            'programs' => [
                'total' => Program::count(),
                'published' => Program::where('status', 'published')->count(),
                'draft' => Program::where('status', 'draft')->count(),
            ],
            'activities' => [
                'total' => Activity::count(),
                'active' => Activity::whereHas('batches', function ($query) {
                    $query->where('status', 'aktif');
                })->count(),
            ],
            'batches' => [
                'total' => ActivityBatch::count(),
                'active' => ActivityBatch::where('status', 'aktif')->count(),
            ],
            'articles' => [
                'total' => Article::count(),
                'published' => Article::where('status', 'published')->count(),
                'draft' => Article::where('status', 'draft')->count(),
            ],
            'news' => [
                'total' => News::count(),
                'published' => News::where('status', 'published')->count(),
                'draft' => News::where('status', 'draft')->count(),
            ],
            'services' => [
                'total' => Service::count(),
                'active' => Service::where('is_active', true)->count(),
            ],
            'users' => [
                'total' => User::count(),
                'admin' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->count(),
                'alumni' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'alumni');
                })->count(),
                'peserta' => SpnRegistration::whereNotNull('user_id')->distinct('user_id')->count('user_id'),
            ],
        ];

        // 4. Batch Aktif & Monitoring Kuota Pendaftaran
        $activeBatches = ActivityBatch::where('status', 'aktif')
            ->with(['activity.program'])
            ->withCount('materials')
            ->orderBy('tanggal_mulai_pendaftaran', 'desc')
            ->take(4)
            ->get()
            ->map(function ($batch) {
                $batch->registrations_count = SpnRegistration::where('activity_batch_id', $batch->id)
                    ->where('status', '!=', 'ditolak')
                    ->count();
                $batch->verified_count = SpnRegistration::where('activity_batch_id', $batch->id)
                    ->where('status', 'terverifikasi')
                    ->count();
                $batch->percentage = $batch->kuota > 0 
                    ? min(100, round(($batch->registrations_count / $batch->kuota) * 100))
                    : 0;
                
                $today = \Illuminate\Support\Carbon::today();
                if ($batch->tanggal_selesai_pendaftaran) {
                    $batch->days_remaining = $today->diffInDays($batch->tanggal_selesai_pendaftaran, false);
                } else {
                    $batch->days_remaining = null;
                }
                return $batch;
            });

        // 5. Distribusi Alumni Terbanyak per Kegiatan
        $topActivitiesByAlumni = Activity::withCount('batches')
            ->whereHas('batches.alumni')
            ->with(['batches' => function($q) {
                $q->withCount('alumni');
            }])
            ->get()
            ->map(function($activity) {
                $activity->total_alumni = $activity->batches->sum('alumni_count');
                return $activity;
            })
            ->sortByDesc('total_alumni')
            ->take(5);

        // 6. Pendaftar SPN Terkini
        $recentSpnRegistrations = SpnRegistration::with('activityBatch.activity')
            ->latest()
            ->take(5)
            ->get();

        // 7. Pertanyaan Ta'aruf Terbaru yang Belum Dijawab
        $recentTaarufQuestions = TaarufQuestion::with(['profile', 'askedBy'])
            ->where('is_answered', false)
            ->latest()
            ->take(5)
            ->get();

        // 8. Artikel & Berita Publikasi Terkini
        $recentArticles = Article::with(['author', 'category'])
            ->latest()
            ->take(4)
            ->get();

        $recentNews = News::with(['author', 'category'])
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'pendingActions',
            'totalPendingActions',
            'multiBatchAlumniCount',
            'topMultiBatchAlumni',
            'stats',
            'activeBatches',
            'topActivitiesByAlumni',
            'recentSpnRegistrations',
            'recentTaarufQuestions',
            'recentArticles',
            'recentNews'
        ));
    }
}
