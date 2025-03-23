<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityBatch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityBatchController extends Controller
{
    public function index(Activity $activity)
    {
        $batches = $activity->batches()->orderBy('batch_ke', 'desc')->get();
        return view('admin.activities.batches.index', compact('activity', 'batches'));
    }

    public function create(Activity $activity)
    {
        return view('admin.activities.batches.create', compact('activity'));
    }

    public function store(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'nama_batch' => 'required|string|max:255',
            'batch_ke' => 'required|integer|min:1',
            'kuota' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'featured_image' => 'nullable|image|max:2048',
            'tanggal_mulai_pendaftaran' => 'required|date',
            'tanggal_selesai_pendaftaran' => 'required|date|after:tanggal_mulai_pendaftaran',
            'tanggal_mulai_kegiatan' => 'required|date|after:tanggal_mulai_pendaftaran',
            'tanggal_selesai_kegiatan' => 'required|date|after:tanggal_mulai_kegiatan',
            'status' => 'required|in:aktif,nonaktif,selesai',
            'external_link' => 'nullable|url',
            'catatan' => 'nullable|string'
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('batchs', 'public');
            $validated['featured_image'] = $path;
        }

        $activity->batches()->create($validated);

        return redirect()
            ->route('admin.activities.show', $activity)
            ->with('success', 'Batch berhasil ditambahkan');
    }

    public function edit(Activity $activity, ActivityBatch $batch)
    {
        return view('admin.activities.batches.edit', compact('activity', 'batch'));
    }

    public function update(Request $request, Activity $activity, ActivityBatch $batch)
    {
        $validated = $request->validate([
            'nama_batch' => 'required|string|max:255',
            'batch_ke' => 'required|integer|min:1',
            'kuota' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'featured_image' => 'nullable|image|max:2048',
            'tanggal_mulai_pendaftaran' => 'required|date',
            'tanggal_selesai_pendaftaran' => 'required|date|after:tanggal_mulai_pendaftaran',
            'tanggal_mulai_kegiatan' => 'required|date|after:tanggal_mulai_pendaftaran',
            'tanggal_selesai_kegiatan' => 'required|date|after:tanggal_mulai_kegiatan',
            'status' => 'required|in:aktif,nonaktif,selesai',
            'external_link' => 'nullable|url',
            'catatan' => 'nullable|string'
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('batchs', 'public');
            $validated['featured_image'] = $path;
        }

        $batch->update($validated);

        return redirect()
            ->route('admin.activities.show', $activity)
            ->with('success', 'Batch berhasil diperbarui');
    }

    public function destroy(Activity $activity, ActivityBatch $batch)
    {
        $batch->delete();

        return redirect()
            ->route('admin.activities.show', $activity)
            ->with('success', 'Batch berhasil dihapus');
    }

    /**
     * Display a listing of all activity batches across all activities.
     */
    public function allBatches(Request $request)
    {
        $query = ActivityBatch::with(['activity', 'materials']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by materials
        if ($request->filled('has_material')) {
            if ($request->has_material == '1') {
                $query->has('materials');
            } else {
                $query->doesntHave('materials');
            }
        }

        // Search by batch name or activity title
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_batch', 'like', "%{$search}%")
                    ->orWhereHas('activity', function ($q2) use ($search) {
                        $q2->where('title', 'like', "%{$search}%");
                    });
            });
        }

        // Sort
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'tanggal_mulai_kegiatan_asc':
                    $query->orderBy('tanggal_mulai_kegiatan', 'asc');
                    break;
                case 'tanggal_mulai_kegiatan_desc':
                    $query->orderBy('tanggal_mulai_kegiatan', 'desc');
                    break;
                case 'nama_batch_asc':
                    $query->orderBy('nama_batch', 'asc');
                    break;
                case 'nama_batch_desc':
                    $query->orderBy('nama_batch', 'desc');
                    break;
                case 'harga_asc':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'harga_desc':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'material_count_desc':
                    $query->withCount('materials')->orderBy('materials_count', 'desc');
                    break;
                case 'material_count_asc':
                    $query->withCount('materials')->orderBy('materials_count', 'asc');
                    break;
                default:
                    $query->orderBy('tanggal_mulai_kegiatan', 'desc');
                    break;
            }
        } else {
            $query->orderBy('tanggal_mulai_kegiatan', 'desc');
        }

        // Get results with optional pagination
        // If you want pagination (e.g. 15 items per page):
        $batches = $query->paginate(15);

        // If you don't want pagination:
        // $batches = $query->get();

        return view('admin.activities.batches.all', compact('batches'));
    }
}
