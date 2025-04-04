<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['category', 'author'])
            ->latest()
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        $tags = NewsTag::all();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'news_category_id' => 'required|exists:news_categories,id',
            'tags' => 'nullable|array',
        ]);
        dd($request);

        $imagePath = $request->file('featured_image')->store('news', 'public');

        $news = News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $imagePath,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->status,
            'news_category_id' => $request->news_category_id,
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
                    $newTag = NewsTag::firstOrCreate(
                        ['name' => $tagName],
                        ['slug' => Str::slug($tagName)]
                    );

                    $tagIds[] = $newTag->id;
                } else {
                    // Existing tag
                    $tagIds[] = $tagValue;
                }
            }

            // Attach all tags to the news item
            $news->tags()->attach($tagIds);
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        $tags = NewsTag::all();
        return view('admin.news.edit', compact('news', 'categories', 'tags'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'news_category_id' => 'required|exists:news_categories,id',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            Storage::disk('public')->delete($news->featured_image);
            $imagePath = $request->file('featured_image')->store('news', 'public');
        }

        $news->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $request->hasFile('featured_image') ? $imagePath : $news->featured_image,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'is_featured' => $request->is_featured ?? false,
            'status' => $request->status,
            'news_category_id' => $request->news_category_id,
            'published_at' => $request->status === 'published' && !$news->published_at ? now() : $news->published_at,
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
                    $newTag = NewsTag::firstOrCreate(
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

        // Sync all tags with the news item
        $news->tags()->sync($tagIds);

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }
}
