<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['category', 'author', 'tags'])
            ->where('status', 'published');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $featuredNews = (clone $query)->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $news = (clone $query)
            ->where('is_featured', false)
            ->latest('published_at')
            ->paginate(9);

        $categories = NewsCategory::withCount(['news' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        // @dd($news);

        return view('news.index', compact('news', 'featuredNews', 'categories'));
    }

    public function show($slug)
    {
        $news = News::with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->where('id', '!=', $news->id)
            ->where('news_category_id', $news->news_category_id)
            ->latest('published_at')
            ->take(2)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
