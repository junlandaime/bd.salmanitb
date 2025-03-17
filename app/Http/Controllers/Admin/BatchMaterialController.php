<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityBatch;
use App\Models\BatchMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BatchMaterialController extends Controller
{
    /**
     * Display a listing of the batch materials for a specific batch.
     */
    public function index(ActivityBatch $batch)
    {
        $batch->load(['activity', 'materials' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);

        return view('admin.batch-materials.index', compact('batch'));
    }

    /**
     * Show the form for creating a new batch material.
     */
    public function create(ActivityBatch $batch)
    {
        return view('admin.batch-materials.create', compact('batch'));
    }

    /**
     * Store a newly created batch material in storage.
     */
    public function store(Request $request, ActivityBatch $batch)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slide_url' => 'nullable|url',
            'notes_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'order' => 'required|integer|min:1',
        ]);

        $batch->materials()->create($validated);

        return redirect()
            ->route('admin.batches.materials.index', $batch)
            ->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Display the specified batch material.
     */
    public function show(ActivityBatch $batch, BatchMaterial $material)
    {
        return view('admin.batch-materials.show', compact('batch', 'material'));
    }

    /**
     * Show the form for editing the specified batch material.
     */
    public function edit(ActivityBatch $batch, BatchMaterial $material)
    {
        return view('admin.batch-materials.edit', compact('batch', 'material'));
    }

    /**
     * Update the specified batch material in storage.
     */
    public function update(Request $request, ActivityBatch $batch, BatchMaterial $material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slide_url' => 'nullable|url',
            'notes_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'order' => 'required|integer|min:1',
        ]);

        $material->update($validated);

        return redirect()
            ->route('admin.batches.materials.index', $batch)
            ->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified batch material from storage.
     */
    public function destroy(ActivityBatch $batch, BatchMaterial $material)
    {
        $material->delete();

        return redirect()
            ->route('admin.batches.materials.index', $batch)
            ->with('success', 'Materi berhasil dihapus');
    }

    /**
     * Reorder batch materials.
     */
    public function reorder(Request $request, ActivityBatch $batch)
    {
        $request->validate([
            'materials' => 'required|array',
            'materials.*.id' => 'required|exists:batch_materials,id',
            'materials.*.order' => 'required|integer|min:1',
        ]);

        foreach ($request->materials as $item) {
            BatchMaterial::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
