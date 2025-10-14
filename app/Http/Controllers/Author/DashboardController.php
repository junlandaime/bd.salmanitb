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

        $articleCount = Article::ownedBy($user)->count();
        $publishedArticleCount = Article::ownedBy($user)->where('status', 'published')->count();
        $newsCount = News::ownedBy($user)->count();
        $publishedNewsCount = News::ownedBy($user)->where('status', 'published')->count();

        return view('author.dashboard', [
            'articleCount' => $articleCount,
            'publishedArticleCount' => $publishedArticleCount,
            'newsCount' => $newsCount,
            'publishedNewsCount' => $publishedNewsCount,
        ]);
    }
}
