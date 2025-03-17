<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use App\Models\Program;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
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
            'programs' => [
                'total' => Program::count(),
                'published' => Program::where('status', 'published')->count(),
                'draft' => Program::where('status', 'draft')->count(),
            ],
            'activities' => [
                'total' => Activity::count(),
                'active' => Activity::whereHas('batches', function ($query) {
                    $query->where('tanggal_selesai_kegiatan', '>=', now());
                })->count(),
            ],
            'users' => [
                'total' => User::count(),
                'admin' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->count(),
                'alumni' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'alumni');
                })->count(),
            ],
        ];

        $recentArticles = Article::with(['author', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $recentNews = News::with(['author', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $upcomingActivities = Activity::whereHas('batches', function ($query) {
            $query->where('tanggal_mulai_kegiatan', '>', now())
                ->orderBy('tanggal_mulai_kegiatan', 'asc');
        })
            ->with(['batches' => function ($query) {
                $query->where('tanggal_mulai_kegiatan', '>', now())
                    ->orderBy('tanggal_mulai_kegiatan', 'asc');
            }])
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentArticles',
            'recentNews',
            'upcomingActivities'
        ));
    }
}
