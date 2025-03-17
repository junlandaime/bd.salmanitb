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
    public function allBatches()
    {
        $batches = ActivityBatch::with('activity')
            ->orderBy('tanggal_mulai_kegiatan', 'desc')
            ->get();

        return view('admin.activities.batches.all', compact('batches'));
    }
}
