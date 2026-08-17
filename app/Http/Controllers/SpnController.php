<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityBatch;
use App\Models\ActivityGallery;
use App\Models\SpnPricingPackage;
use App\Models\SpnDiscount;
use Illuminate\Http\Request;

class SpnController extends Controller
{
    /**
     * Get the SPN activity model (offline or online).
     */
    private function getActivity(?string $type = null): ?Activity
    {
        $slugs = ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn'];
        if ($type === 'online') {
            $slugs = ['sekolah-pranikah-online'];
        } elseif ($type === 'offline') {
            $slugs = ['sekolah-pranikah-offline'];
        }

        return Activity::whereIn('slug', $slugs)->with([
            'faqs',
            'testimonials',
            'gallery',
            'highlights',
            'learningPath',
            'program.topics',
            'program.schedules'
        ])->first();
    }

    /**
     * Get the active SPN batch.
     */
    private function getActiveBatch(?string $type = null): ?ActivityBatch
    {
        ActivityBatch::updateExpiredBatches();

        $slugs = ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn'];
        if ($type === 'online') {
            $slugs = ['sekolah-pranikah-online'];
        } elseif ($type === 'offline') {
            $slugs = ['sekolah-pranikah-offline'];
        }

        return ActivityBatch::whereHas('activity', function ($q) use ($slugs) {
            $q->whereIn('slug', $slugs);
        })->where('status', 'aktif')->latest()->first();
    }

    /**
     * SPN Landing Page.
     */
    public function index()
    {
        $batch = $this->getActiveBatch();
        $activity = $batch ? $batch->activity : $this->getActivity('offline');

        if ($activity) {
            $activity->load(['faqs', 'testimonials', 'gallery', 'highlights', 'learningPath']);
        }

        $faqs = $activity ? $activity->faqs : collect();
        $testimonials = $activity ? $activity->testimonials : collect();
        $highlights = $activity ? $activity->highlights : collect();
        $gallery = $activity ? $activity->gallery : collect();

        return view('spn.index', [
            'activePage' => 'beranda',
            'activity' => $activity,
            'batch' => $batch,
            'faqs' => $faqs,
            'testimonials' => $testimonials,
            'highlights' => $highlights,
            'gallery' => $gallery,
        ]);
    }

    /**
     * Kurikulum Page - loads both Offline (18 sessions) and Online (3 modules) curricula from DB.
     */
    public function kurikulum(Request $request)
    {
        $batch = $this->getActiveBatch();

        $offlineActivity = Activity::where('slug', 'sekolah-pranikah-offline')
            ->with(['learningPath' => fn($q) => $q->orderBy('order')])
            ->first();

        $onlineActivity = Activity::where('slug', 'sekolah-pranikah-online')
            ->with(['learningPath' => fn($q) => $q->orderBy('order')])
            ->first();

        $offlineLearningPaths = $offlineActivity ? $offlineActivity->learningPath : collect();
        $onlineLearningPaths = $onlineActivity ? $onlineActivity->learningPath : collect();

        // Default type to active batch, or query param, or 'offline'
        $activeType = $request->query('type');
        if (!$activeType) {
            if ($batch && $batch->activity && $batch->activity->slug === 'sekolah-pranikah-online') {
                $activeType = 'online';
            } else {
                $activeType = 'offline';
            }
        }

        return view('spn.kurikulum', [
            'activePage' => 'kurikulum',
            'batch' => $batch,
            'activeType' => $activeType,
            'offlineActivity' => $offlineActivity,
            'onlineActivity' => $onlineActivity,
            'offlineLearningPaths' => $offlineLearningPaths,
            'onlineLearningPaths' => $onlineLearningPaths,
        ]);
    }

    /**
     * Jadwal Page.
     */
    public function jadwal(Request $request)
    {
        $batch = $this->getActiveBatch();

        $offlineActivity = Activity::where('slug', 'sekolah-pranikah-offline')
            ->with(['learningPath' => fn($q) => $q->orderBy('order')])
            ->first();

        $onlineActivity = Activity::where('slug', 'sekolah-pranikah-online')
            ->with(['learningPath' => fn($q) => $q->orderBy('order')])
            ->first();

        $offlineLearningPaths = $offlineActivity ? $offlineActivity->learningPath : collect();
        $onlineLearningPaths = $onlineActivity ? $onlineActivity->learningPath : collect();

        $activeType = $request->query('type');
        if (!$activeType) {
            if ($batch && $batch->activity && $batch->activity->slug === 'sekolah-pranikah-online') {
                $activeType = 'online';
            } else {
                $activeType = 'offline';
            }
        }

        return view('spn.jadwal', [
            'activePage' => 'jadwal',
            'batch' => $batch,
            'activeType' => $activeType,
            'offlineActivity' => $offlineActivity,
            'onlineActivity' => $onlineActivity,
            'offlineLearningPaths' => $offlineLearningPaths,
            'onlineLearningPaths' => $onlineLearningPaths,
        ]);
    }

    /**
     * Pemateri Page - extracts mentors dynamically from offline and online learning paths.
     */
    public function pemateri(Request $request)
    {
        $batch = $this->getActiveBatch();

        $offlineActivity = Activity::where('slug', 'sekolah-pranikah-offline')
            ->with(['learningPath' => fn($q) => $q->orderBy('order')])
            ->first();

        $onlineActivity = Activity::where('slug', 'sekolah-pranikah-online')
            ->with(['learningPath' => fn($q) => $q->orderBy('order')])
            ->first();

        $offlineLearningPaths = $offlineActivity ? $offlineActivity->learningPath : collect();
        $onlineLearningPaths = $onlineActivity ? $onlineActivity->learningPath : collect();

        $activeType = $request->query('type');
        if (!$activeType) {
            if ($batch && $batch->activity && $batch->activity->slug === 'sekolah-pranikah-online') {
                $activeType = 'online';
            } else {
                $activeType = 'offline';
            }
        }

        return view('spn.pemateri', [
            'activePage' => 'pemateri',
            'batch' => $batch,
            'activeType' => $activeType,
            'offlineActivity' => $offlineActivity,
            'onlineActivity' => $onlineActivity,
            'offlineLearningPaths' => $offlineLearningPaths,
            'onlineLearningPaths' => $onlineLearningPaths,
        ]);
    }

    /**
     * Harga Page - reads pricing and discounts from database.
     */
    public function harga()
    {
        $batch = $this->getActiveBatch();
        $activity = $batch ? $batch->activity : $this->getActivity('offline');

        $packages = collect();
        $discounts = collect();

        if ($batch) {
            $packages = SpnPricingPackage::where('activity_batch_id', $batch->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $discounts = SpnDiscount::where('activity_batch_id', $batch->id)
                ->where('is_active', true)
                ->get();
        }

        return view('spn.harga', [
            'activePage' => 'harga',
            'activity' => $activity,
            'batch' => $batch,
            'packages' => $packages,
            'discounts' => $discounts,
        ]);
    }

    /**
     * Fasilitas Page.
     */
    public function fasilitas()
    {
        $batch = $this->getActiveBatch();
        $activity = $batch ? $batch->activity : $this->getActivity('offline');
        
        $spnActivityIds = Activity::whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn'])->pluck('id');
        $gallery = ActivityGallery::whereIn('activity_id', $spnActivityIds)->latest()->get();
        if ($gallery->isEmpty() && $activity) {
            $gallery = $activity->gallery;
        }

        return view('spn.fasilitas', [
            'activePage' => 'fasilitas',
            'activity' => $activity,
            'batch' => $batch,
            'gallery' => $gallery,
        ]);
    }

    /**
     * FAQ Page.
     */
    public function faq()
    {
        $batch = $this->getActiveBatch();
        $activity = $batch ? $batch->activity : $this->getActivity('offline');
        $faqs = $activity ? $activity->faqs : collect();

        return view('spn.faq', [
            'activePage' => 'faq',
            'activity' => $activity,
            'batch' => $batch,
            'faqs' => $faqs,
        ]);
    }
}
