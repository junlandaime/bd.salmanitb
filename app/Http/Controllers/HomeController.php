<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Article;
use App\Models\Program;
use App\Models\Activity;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArticles = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestNews = News::with(['author', 'category'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(4)
            ->get();

        $featuredPrograms = Program::
            // where('is_featured', true)
            // ->
            latest()
            ->take(3)
            ->get();

        $activities = Activity::where('is_featured', true)
            ->with(['program', 'learningPath', 'highlights'])
            ->where('status', 'published')
            ->latest()
            ->take(4)
            ->get();

        $upcomingActivities = Activity::whereHas('batches', function ($query) {
            $query->where('tanggal_mulai_kegiatan', '>', now())
                ->orderBy('tanggal_mulai_kegiatan', 'asc');
        })
            ->with(['batches' => function ($query) {
                $query->where('tanggal_mulai_kegiatan', '>', now())
                    ->orderBy('tanggal_mulai_kegiatan', 'asc');
            }])
            ->take(4)
            ->get();

        $landingpage = LandingPage::firstOrFail();

        return view('home', compact(
            'featuredArticles',
            'latestNews',
            'featuredPrograms',
            'activities',
            'landingpage',
            'upcomingActivities'
        ));
    }

    public function contact()
    {
        return view('contact');
    }
}
