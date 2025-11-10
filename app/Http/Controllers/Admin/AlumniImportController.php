<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityBatch;
use App\Services\ExcelImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\UploadSanitizer;

class AlumniImportController extends Controller
{
    protected $excelImportService;

    public function __construct(ExcelImportService $excelImportService)
    {
        $this->excelImportService = $excelImportService;
        // $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Show the import form
     */
    public function showImportForm()
    {
        $activityBatches = ActivityBatch::with('activity')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.alumni.import', compact('activityBatches'));
    }

    /**
     * Import alumni data
     */
    public function importAlumni(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
            'activity_batch_id' => 'required|exists:activity_batches,id',
        ]);

        try {
            // Store file temporarily
            $file = $request->file('file');
            // $filePath = $file->storeAs('temp', $file->getClientOriginalName());
            // $fullPath = Storage::path($filePath);

            $filePath = UploadSanitizer::store($file, 'temp', 'local');
            $fullPath = Storage::disk('local')->path($filePath);

            // Import data
            $stats = $this->excelImportService->importAlumniData(
                $fullPath,
                $request->activity_batch_id
            );

            // Delete temp file
            // Storage::delete($filePath);
            Storage::disk('local')->delete($filePath);

            return redirect()->route('admin.alumni.import.form')
                ->with('success', "Import completed: {$stats['created']} new users, {$stats['updated']} updated users, {$stats['failed']} failed.")
                ->with('import_stats', $stats);
        } catch (\Exception $e) {
            return redirect()->route('admin.alumni.import.form')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Show the material import form
     */
    public function showMaterialImportForm()
    {
        $activityBatches = ActivityBatch::with('activity')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.alumni.import-materials', compact('activityBatches'));
    }

    /**
     * Import batch materials
     */
    public function importMaterials(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
            'activity_batch_id' => 'required|exists:activity_batches,id',
        ]);

        try {
            // Store file temporarily
            $file = $request->file('file');
            // $filePath = $file->storeAs('temp', $file->getClientOriginalName());
            // $fullPath = Storage::path($filePath);

            $filePath = UploadSanitizer::store($file, 'temp', 'local');
            $fullPath = Storage::disk('local')->path($filePath);

            // Import data
            $stats = $this->excelImportService->importBatchMaterials(
                $fullPath,
                $request->activity_batch_id
            );

            // Delete temp file
            // Storage::delete($filePath);
            Storage::disk('local')->delete($filePath);

            return redirect()->route('admin.alumni.materials.import.form')
                ->with('success', "Import completed: {$stats['created']} materials imported, {$stats['failed']} failed.")
                ->with('import_stats', $stats);
        } catch (\Exception $e) {
            return redirect()->route('admin.alumni.materials.import.form')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
