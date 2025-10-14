<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::with(['category', 'author'])
            ->ownedBy(auth()->user())
            ->latest()
            ->paginate(10);

        return view('author.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('author.news.create', [
            'categories' => NewsCategory::all(),
            'tags' => NewsTag::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
            'news_category_id' => 'required|exists:news_categories,id',
            'tags' => 'nullable|array',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $request->hasFile('featured_image')
            ? $request->file('featured_image')->store('news', 'public')
            : null;

        // Tentukan tanggal terbit
        $publishedAt = null;
        if ($request->status === 'published') {
            $publishedAt = $request->published_at ? $request->published_at : now();
        }

        $news = News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imagePath,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : false,
            'status' => $request->status,
            'news_category_id' => $request->news_category_id,
            'author_id' => auth()->id(),
            'published_at' => $publishedAt,
        ]);

        $this->syncTags($news, $request->input('tags', []));

        return redirect()->route('author.news.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function edit(News $news): View
    {
        $this->authorizeNews($news);

        return view('author.news.edit', [
            'news' => $news->load('tags'),
            'categories' => NewsCategory::all(),
            'tags' => NewsTag::all(),
        ]);
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $this->authorizeNews($news);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
            'news_category_id' => 'required|exists:news_categories,id',
            'tags' => 'nullable|array',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $news->featured_image;

        if ($request->hasFile('featured_image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('featured_image')->store('news', 'public');
        }

        // Tentukan tanggal terbit
        $publishedAt = $news->published_at;
        if ($request->status === 'published') {
            if ($request->published_at) {
                $publishedAt = $request->published_at;
            } elseif (!$news->published_at) {
                $publishedAt = now();
            }
        }

        $news->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imagePath,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : false,
            'status' => $request->status,
            'news_category_id' => $request->news_category_id,
            'published_at' => $publishedAt,
        ]);

        $this->syncTags($news, $request->input('tags', []));

        return redirect()->route('author.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $this->authorizeNews($news);

        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('author.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    protected function authorizeNews(News $news): void
    {
        abort_if($news->author_id !== auth()->id(), 403);
    }

    protected function syncTags(News $news, array $tags): void
    {
        $tagIds = [];

        foreach ($tags as $tagValue) {
            $tagValue = (string) $tagValue;

            if (Str::startsWith($tagValue, 'new_')) {
                $tagName = Str::replace('_', ' ', Str::after($tagValue, 'new_'));
                $newTag = NewsTag::firstOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );

                $tagIds[] = $newTag->id;
            } else {
                $tagIds[] = (int) $tagValue;
            }
        }

        $news->tags()->sync($tagIds);
    }
}
