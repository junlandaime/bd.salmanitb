<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::with(['category', 'author'])
            ->ownedBy(auth()->user())
            ->latest()
            ->paginate(10);

        return view('author.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('author.articles.create', [
            'categories' => ArticleCategory::all(),
            'tags' => ArticleTag::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time' => 'nullable|string|max:20',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
            'article_category_id' => 'required|exists:article_categories,id',
            'tags' => 'nullable|array',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $request->file('featured_image')->store('articles', 'public');

        // Tentukan tanggal terbit
        $publishedAt = null;
        if ($request->status === 'published') {
            $publishedAt = $request->published_at ? $request->published_at : now();
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imagePath,
            'reading_time' => $request->reading_time ?? '5 min read',
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : false,
            'status' => $request->status,
            'article_category_id' => $request->article_category_id,
            'author_id' => auth()->id(),
            'published_at' => $publishedAt,
        ]);

        $this->syncTags($article, $request->input('tags', []));

        return redirect()->route('author.articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article): View
    {
        $this->authorizeArticle($article);

        return view('author.articles.edit', [
            'article' => $article->load('tags'),
            'categories' => ArticleCategory::all(),
            'tags' => ArticleTag::all(),
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->authorizeArticle($article);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time' => 'nullable|string|max:20',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
            'article_category_id' => 'required|exists:article_categories,id',
            'tags' => 'nullable|array',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $article->featured_image;

        if ($request->hasFile('featured_image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('featured_image')->store('articles', 'public');
        }

        // Tentukan tanggal terbit
        $publishedAt = $article->published_at;
        if ($request->status === 'published') {
            if ($request->published_at) {
                $publishedAt = $request->published_at;
            } elseif (!$article->published_at) {
                $publishedAt = now();
            }
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imagePath,
            'reading_time' => $request->reading_time ?? '5 min read',
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : false,
            'status' => $request->status,
            'article_category_id' => $request->article_category_id,
            'published_at' => $publishedAt,
        ]);

        $this->syncTags($article, $request->input('tags', []));

        return redirect()->route('author.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->authorizeArticle($article);

        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('author.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    protected function authorizeArticle(Article $article): void
    {
        abort_if($article->author_id !== auth()->id(), 403);
    }

    protected function syncTags(Article $article, array $tags): void
    {
        $tagIds = [];

        foreach ($tags as $tagValue) {
            $tagValue = (string) $tagValue;

            if (Str::startsWith($tagValue, 'new_')) {
                $tagName = Str::replace('_', ' ', Str::after($tagValue, 'new_'));
                $newTag = ArticleTag::firstOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );

                $tagIds[] = $newTag->id;
            } else {
                $tagIds[] = (int) $tagValue;
            }
        }

        $article->tags()->sync($tagIds);
    }
}
