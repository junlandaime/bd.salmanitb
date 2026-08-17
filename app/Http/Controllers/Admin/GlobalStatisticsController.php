<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityBatch;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\BatchAlumni;
use App\Models\BatchMaterial;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Program;
use App\Models\Service;
use App\Models\SpnRegistration;
use App\Models\TaarufProfile;
use App\Models\TaarufQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalStatisticsController extends Controller
{
    public function index()
    {
        // =========================================================================
        // 1. EXECUTIVE SUMMARY & OVERALL KPIS
        // =========================================================================
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = $totalUsers - $activeUsers;
        $totalAlumniRecords = BatchAlumni::count();
        $multiBatchAlumniCount = User::has('batchAlumni', '>', 1)->count();
        
        $totalSpnInfak = SpnRegistration::where('status', 'terverifikasi')->sum('total_bayar');
        $totalSpnRegistrations = SpnRegistration::count();
        $verifiedSpnRegistrations = SpnRegistration::where('status', 'terverifikasi')->count();
        
        $totalTaarufProfiles = TaarufProfile::count();
        $activeTaarufProfiles = TaarufProfile::where('is_active', true)->count();
        $inProcessTaaruf = TaarufProfile::where('is_in_taaruf_process', true)->count();
        
        $totalMaterials = BatchMaterial::count();
        $materialsWithSlide = BatchMaterial::whereNotNull('slide_url')->where('slide_url', '!=', '')->count();
        $materialsWithVideo = BatchMaterial::whereNotNull('video_url')->where('video_url', '!=', '')->count();
        $materialsWithNotes = BatchMaterial::whereNotNull('notes_url')->where('notes_url', '!=', '')->count();

        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $totalNews = News::count();
        $publishedNews = News::where('status', 'published')->count();
        $totalServices = Service::where('is_active', true)->count();

        // =========================================================================
        // 2. KADERISASI & ALUMNI ANALYTICS
        // =========================================================================
        // Top 8 Activities by Alumni Count
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
            ->take(8);

        // Alumni Retention / Batch Attendance Frequency
        $retentionStats = [
            '1_batch' => User::has('batchAlumni', '=', 1)->count(),
            '2_batches' => User::has('batchAlumni', '=', 2)->count(),
            '3_batches' => User::has('batchAlumni', '=', 3)->count(),
            '4_plus_batches' => User::has('batchAlumni', '>=', 4)->count(),
        ];

        // Alumni Gender Composition
        $alumniMale = BatchAlumni::where(function($q) {
            $q->where('gender', 'male')->orWhere('gender', 'L')->orWhere('gender', 'like', 'laki%')->orWhere('gender', 'like', 'pria%');
        })->count();
        $alumniFemale = BatchAlumni::where(function($q) {
            $q->where('gender', 'female')->orWhere('gender', 'P')->orWhere('gender', 'like', 'perempuan%')->orWhere('gender', 'like', 'wanita%');
        })->count();
        $alumniUnknownGender = max(0, $totalAlumniRecords - ($alumniMale + $alumniFemale));

        // =========================================================================
        // 3. REGISTRATIONS & DEMOGRAPHICS (SPN & PARTICIPANTS)
        // =========================================================================
        // Channel / Info Dari
        $infoDariStats = SpnRegistration::select('info_dari', DB::raw('count(*) as count'))
            ->whereNotNull('info_dari')
            ->groupBy('info_dari')
            ->orderByDesc('count')
            ->get();

        // Status Diri / Profesi
        $statusDiriStats = SpnRegistration::select('status_diri', DB::raw('count(*) as count'))
            ->whereNotNull('status_diri')
            ->groupBy('status_diri')
            ->orderByDesc('count')
            ->get();

        // Jenjang Pendidikan
        $educationStats = SpnRegistration::select('pendidikan', DB::raw('count(*) as count'))
            ->whereNotNull('pendidikan')
            ->groupBy('pendidikan')
            ->orderByDesc('count')
            ->get();

        // Metode Pembayaran
        $paymentMethods = SpnRegistration::select('metode_bayar', DB::raw('count(*) as count'))
            ->whereNotNull('metode_bayar')
            ->groupBy('metode_bayar')
            ->orderByDesc('count')
            ->get();

        // Paket Pendaftaran
        $packageStats = SpnRegistration::select('paket', DB::raw('count(*) as count'))
            ->whereNotNull('paket')
            ->groupBy('paket')
            ->orderByDesc('count')
            ->get();

        // Status Pernikahan
        $maritalStats = SpnRegistration::select('status_pernikahan', DB::raw('count(*) as count'))
            ->whereNotNull('status_pernikahan')
            ->groupBy('status_pernikahan')
            ->orderByDesc('count')
            ->get();

        // Gender Peserta SPN
        $spnMale = SpnRegistration::where('jenis_kelamin', 'pria')->count();
        $spnFemale = SpnRegistration::where('jenis_kelamin', 'wanita')->count();

        // Top Asal Daerah Peserta SPN
        $topRegions = SpnRegistration::select('asal_daerah', DB::raw('count(*) as count'))
            ->whereNotNull('asal_daerah')
            ->where('asal_daerah', '!=', '')
            ->groupBy('asal_daerah')
            ->orderByDesc('count')
            ->take(6)
            ->get();

        // =========================================================================
        // 4. LAYANAN TA'ARUF ANALYTICS
        // =========================================================================
        $taarufMale = TaarufProfile::where(function($q) {
            $q->where('gender', 'male')->orWhere('gender', 'L')->orWhere('gender', 'like', 'laki%');
        })->count();
        $taarufFemale = TaarufProfile::where(function($q) {
            $q->where('gender', 'female')->orWhere('gender', 'P')->orWhere('gender', 'like', 'perempuan%');
        })->count();

        $activeTaarufMale = TaarufProfile::where('is_active', true)->where(function($q) {
            $q->where('gender', 'male')->orWhere('gender', 'L')->orWhere('gender', 'like', 'laki%');
        })->count();
        $activeTaarufFemale = TaarufProfile::where('is_active', true)->where(function($q) {
            $q->where('gender', 'female')->orWhere('gender', 'P')->orWhere('gender', 'like', 'perempuan%');
        })->count();

        $marriageTargets = TaarufProfile::select('marriage_target_year', DB::raw('count(*) as count'))
            ->whereNotNull('marriage_target_year')
            ->groupBy('marriage_target_year')
            ->orderBy('marriage_target_year')
            ->get();

        $totalTaarufQuestions = TaarufQuestion::count();
        $answeredTaarufQuestions = TaarufQuestion::where('is_answered', true)->count();
        $questionResponseRate = $totalTaarufQuestions > 0 ? round(($answeredTaarufQuestions / $totalTaarufQuestions) * 100) : 0;

        $smokerCount = TaarufProfile::where('is_smoker', true)->count();
        $debtCount = TaarufProfile::where('has_debt', true)->count();
        $dependentCount = TaarufProfile::where('has_dependents', true)->count();
        $polygamyCount = TaarufProfile::where('is_polygamy_intended', true)->count();

        // =========================================================================
        // 5. KONTEN & PUBLIKASI ANALYTICS
        // =========================================================================
        $topArticleCategories = ArticleCategory::withCount(['articles' => function($q) {
            $q->where('status', 'published');
        }])->orderByDesc('articles_count')->take(6)->get();

        $topNewsCategories = NewsCategory::withCount(['news' => function($q) {
            $q->where('status', 'published');
        }])->orderByDesc('news_count')->take(6)->get();

        $topAuthors = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['admin', 'author']);
        })->withCount(['articles' => function($q) {
            $q->where('status', 'published');
        }])->having('articles_count', '>', 0)->orderByDesc('articles_count')->take(5)->get();

        return view('admin.statistics.index', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'totalAlumniRecords',
            'multiBatchAlumniCount',
            'totalSpnInfak',
            'totalSpnRegistrations',
            'verifiedSpnRegistrations',
            'totalTaarufProfiles',
            'activeTaarufProfiles',
            'inProcessTaaruf',
            'totalMaterials',
            'materialsWithSlide',
            'materialsWithVideo',
            'materialsWithNotes',
            'totalArticles',
            'publishedArticles',
            'totalNews',
            'publishedNews',
            'totalServices',
            'topActivitiesByAlumni',
            'retentionStats',
            'alumniMale',
            'alumniFemale',
            'alumniUnknownGender',
            'infoDariStats',
            'statusDiriStats',
            'educationStats',
            'paymentMethods',
            'packageStats',
            'maritalStats',
            'spnMale',
            'spnFemale',
            'topRegions',
            'taarufMale',
            'taarufFemale',
            'activeTaarufMale',
            'activeTaarufFemale',
            'marriageTargets',
            'totalTaarufQuestions',
            'answeredTaarufQuestions',
            'questionResponseRate',
            'smokerCount',
            'debtCount',
            'dependentCount',
            'polygamyCount',
            'topArticleCategories',
            'topNewsCategories',
            'topAuthors'
        ));
    }
}
