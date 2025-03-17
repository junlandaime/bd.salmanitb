<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        // Apply category filter
        if ($request->has('category')) {
            $query->where('article_category_id', $request->category);
        }

        // Apply tag filter
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('article_tags.id', $request->tag);
            });
        }

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Get featured article
        $featuredArticle = Article::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->first();

        // Get regular articles (excluding featured)
        $articles = $query->when($featuredArticle, function ($q) use ($featuredArticle) {
            $q->where('id', '!=', $featuredArticle->id);
        })
            ->latest('published_at')
            ->paginate(9);

        // Get categories with published article counts
        $categories = ArticleCategory::withCount(['articles' => function ($query) {
            $query->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }])->get();

        // Get tags with published article counts
        $tags = ArticleTag::withCount(['articles' => function ($query) {
            $query->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }])->get();

        return view('articles.index', compact('articles', 'featuredArticle', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $article = Article::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        // Get related articles based on category and tags
        $relatedArticles = Article::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function ($query) use ($article) {
                $query->where('article_category_id', $article->article_category_id)
                    ->orWhereHas('tags', function ($q) use ($article) {
                        $q->whereIn('article_tags.id', $article->tags->pluck('id'));
                    });
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
