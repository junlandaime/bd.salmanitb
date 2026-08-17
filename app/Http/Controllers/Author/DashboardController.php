<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        // Articles statistics
        $articleQuery = Article::ownedBy($user);
        $articleCount = (clone $articleQuery)->count();
        $publishedArticleCount = (clone $articleQuery)->where('status', 'published')->count();
        $draftArticleCount = (clone $articleQuery)->where('status', 'draft')->count();
        $featuredArticleCount = (clone $articleQuery)->where('is_featured', true)->count();

        // News statistics
        $newsQuery = News::ownedBy($user);
        $newsCount = (clone $newsQuery)->count();
        $publishedNewsCount = (clone $newsQuery)->where('status', 'published')->count();
        $draftNewsCount = (clone $newsQuery)->where('status', 'draft')->count();
        $featuredNewsCount = (clone $newsQuery)->where('is_featured', true)->count();

        // Recent Articles & News
        $recentArticles = Article::ownedBy($user)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentNews = News::ownedBy($user)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('author.dashboard', [
            'articleCount' => $articleCount,
            'publishedArticleCount' => $publishedArticleCount,
            'draftArticleCount' => $draftArticleCount,
            'featuredArticleCount' => $featuredArticleCount,
            'newsCount' => $newsCount,
            'publishedNewsCount' => $publishedNewsCount,
            'draftNewsCount' => $draftNewsCount,
            'featuredNewsCount' => $featuredNewsCount,
            'recentArticles' => $recentArticles,
            'recentNews' => $recentNews,
        ]);
    }
}
