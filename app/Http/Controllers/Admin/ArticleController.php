<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'author'])
            ->latest()
            ->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'article_category_id' => 'required|exists:article_categories,id',
            'tags' => 'nullable|array',
        ]);

        $imagePath = $request->file('featured_image')->store('articles', 'public');

        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imagePath,
            'reading_time' => $request->reading_time ?? '5 min read',
            'is_featured' => $request->is_featured ?? false,
            'status' => $request->status,
            'article_category_id' => $request->article_category_id,
            'author_id' => auth()->id(),
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        // Process tags (both existing and new ones)
        if ($request->has('tags')) {
            $tagIds = [];

            foreach ($request->tags as $tagValue) {
                // Check if it's a new tag (starts with 'new_')
                if (Str::startsWith($tagValue, 'new_')) {
                    // Extract the tag name from the ID
                    $tagName = Str::replace('_', ' ', Str::after($tagValue, 'new_'));

                    // Create a new tag
                    $newTag = ArticleTag::firstOrCreate(
                        ['name' => $tagName],
                        ['slug' => Str::slug($tagName)]
                    );

                    $tagIds[] = $newTag->id;
                } else {
                    // Existing tag
                    $tagIds[] = $tagValue;
                }
            }

            // Attach all tags to the article
            $article->tags()->attach($tagIds);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'article_category_id' => 'required|exists:article_categories,id',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            Storage::disk('public')->delete($article->featured_image);
            $imagePath = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $request->hasFile('featured_image') ? $imagePath : $article->featured_image,
            'reading_time' => $request->reading_time,
            'is_featured' => $request->is_featured ?? false,
            'status' => $request->status,
            'article_category_id' => $request->article_category_id,
            'published_at' => $request->status === 'published' && !$article->published_at ? now() : $article->published_at,
        ]);

        // Process tags (both existing and new ones)
        $tagIds = [];

        if ($request->has('tags')) {
            foreach ($request->tags as $tagValue) {
                // Check if it's a new tag (starts with 'new_')
                if (Str::startsWith($tagValue, 'new_')) {
                    // Extract the tag name from the ID
                    $tagName = Str::replace('_', ' ', Str::after($tagValue, 'new_'));

                    // Create a new tag
                    $newTag = ArticleTag::firstOrCreate(
                        ['name' => $tagName],
                        ['slug' => Str::slug($tagName)]
                    );

                    $tagIds[] = $newTag->id;
                } else {
                    // Existing tag
                    $tagIds[] = $tagValue;
                }
            }
        }

        // Sync all tags with the article
        $article->tags()->sync($tagIds);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
