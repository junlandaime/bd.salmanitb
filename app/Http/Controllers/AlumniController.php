<?php

namespace App\Http\Controllers;

use App\Models\ActivityBatch;
use App\Models\BatchMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }

    /**
     * Show alumni dashboard with accessible batches
     */
    public function dashboard()
    {
        $user = Auth::user();
        $batches = $user->batchesAsAlumni()
            ->with('activity')
            ->orderBy('tanggal_selesai_kegiatan', 'desc')
            ->get();

        return view('alumni.dashboard', compact('batches'));
    }

    /**
     * Show batch materials
     */
    public function batchMaterials($batchId)
    {
        $user = Auth::user();

        // Check if user is an alumni of this batch
        $batch = $user->batchesAsAlumni()
            ->with(['activity', 'materials' => function ($query) {
                $query->orderBy('order', 'asc');
            }])
            ->where('activity_batches.id', $batchId)
            ->first();

        if (!$batch) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke materi batch ini.');
        }

        return view('alumni.materials', compact('batch'));
    }

    /**
     * Show specific material
     */
    public function viewMaterial($batchId, $materialId)
    {
        $user = Auth::user();

        // Check if user is an alumni of this batch
        $isBatchAlumni = $user->batchesAsAlumni()
            ->where('activity_batches.id', $batchId)
            ->exists();

        if (!$isBatchAlumni) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke materi ini.');
        }

        // Get the material
        $material = BatchMaterial::where('id', $materialId)
            ->where('activity_batch_id', $batchId)
            ->firstOrFail();

        $batch = ActivityBatch::with('activity')->findOrFail($batchId);

        return view('alumni.material-detail', compact('material', 'batch'));
    }
}
