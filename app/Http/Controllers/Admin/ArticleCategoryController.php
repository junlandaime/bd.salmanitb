<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::withCount('articles')->get();
        return view('admin.articles.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.articles.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        ArticleCategory::create($validated);

        return redirect()->route('admin.article-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        return view('admin.articles.categories.edit', compact('articleCategory'));
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $articleCategory->update($validated);

        return redirect()->route('admin.article-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();

        return redirect()->route('admin.article-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
