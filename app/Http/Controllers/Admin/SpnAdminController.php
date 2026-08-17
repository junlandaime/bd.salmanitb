<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityBatch;
use App\Models\SpnRegistration;
use App\Services\SpnRegistrationService;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SpnAdminController extends Controller
{
    protected $registrationService;

    public function __construct(SpnRegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    protected function getActiveBatchId()
    {
        $batch = ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })->where('status', 'aktif')->latest()->first();

        return $batch ? $batch->id : 0;
    }

    protected function getSpnBatches()
    {
        return ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })->with('activity')->orderByDesc('created_at')->get();
    }

    public function dashboard(Request $request)
    {
        $batches = $this->getSpnBatches();
        $selectedBatchId = $request->batch_id ?: $this->getActiveBatchId();
        $batch = ActivityBatch::find($selectedBatchId);

        $stats = $batch
            ? $this->registrationService->getStatistics($batch->id)
            : ['total' => 0, 'pending' => 0, 'verified' => 0, 'rejected' => 0, 'total_infak' => 0, 'packages' => [], 'gender' => []];

        $recentRegistrationsQuery = SpnRegistration::orderBy('created_at', 'desc');
        
        if ($selectedBatchId) {
            $recentRegistrationsQuery->where('activity_batch_id', $selectedBatchId);
        }
        
        $recentRegistrations = $recentRegistrationsQuery->take(5)->get();

        return view('admin.spn.dashboard', compact('stats', 'recentRegistrations', 'batch', 'batches', 'selectedBatchId'));
    }

    public function registrants(Request $request)
    {
        $batches = $this->getSpnBatches();
        $selectedBatchId = $request->batch_id;

        $query = SpnRegistration::with('activityBatch.activity');

        if ($selectedBatchId) {
            $query->where('activity_batch_id', $selectedBatchId);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('paket')) {
            $query->where('paket', $request->paket);
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.spn.pendaftar.index', compact('registrations', 'batches', 'selectedBatchId'));
    }

    public function show($id)
    {
        $registration = SpnRegistration::findOrFail($id);
        return view('admin.spn.pendaftar.show', compact('registration'));
    }

    public function verify(Request $request, $id)
    {
        $registration = SpnRegistration::findOrFail($id);
        $admin = auth()->user();
        $this->registrationService->verifyRegistration($registration, $admin);

        return back()->with('success', 'Pendaftaran berhasil diverifikasi. Peserta akan otomatis menjadi alumni setelah kegiatan berakhir.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string',
        ]);

        $registration = SpnRegistration::findOrFail($id);
        $admin = auth()->user();
        $this->registrationService->rejectRegistration($registration, $admin, $request->catatan_admin);

        return back()->with('success', 'Pendaftaran telah ditolak.');
    }

    public function export(Request $request)
    {
        $query = SpnRegistration::with(['referralCode', 'activityBatch.activity'])->orderBy('created_at', 'asc');
        
        if ($request->filled('batch_id')) {
            $query->where('activity_batch_id', $request->batch_id);
        }

        $registrations = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Headers
        $headers = [
            'No', 'Batch', 'Kegiatan', 'Kode Pendaftaran', 'Nama Lengkap', 'Panggilan', 'Jenis Kelamin', 'Email', 
            'WhatsApp', 'Instagram', 'Tanggal Lahir', 'Usia', 'Asal', 'Domisili', 'Status Pernikahan', 
            'Pendidikan Terakhir', 'Status Diri', 'Pekerjaan', 'Jabatan', 'Instansi', 'Universitas',
            'Jurusan', 'Angkatan', 'Restu', 'Gambaran Awal', 'Alasan', 
            'Harapan', 'Paket', 'Metode Pembayaran', 'Harga Dasar', 'Kode Referral', 'Diskon', 
            'Total Pembayaran', 'Status Pembayaran', 'Info Dari', 'Tanggal Daftar'
        ];

        foreach (array_values($headers) as $index => $header) {
            $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);
            $sheet->setCellValue($column . '1', $header);
            $sheet->getStyle($column . '1')->getFont()->setBold(true);
        }

        // Add Data
        $row = 2;
        foreach ($registrations as $index => $reg) {
            $batchName = $reg->activityBatch ? ($reg->activityBatch->nama_batch ?? 'Batch ' . $reg->activityBatch->batch_ke) : '-';
            $activityName = $reg->activityBatch && $reg->activityBatch->activity ? $reg->activityBatch->activity->title : '-';

            $data = [
                $index + 1,
                $batchName,
                $activityName,
                $reg->registration_code,
                $reg->nama_lengkap,
                $reg->nama_panggilan,
                $reg->jenis_kelamin,
                $reg->email,
                $reg->whatsapp,
                $reg->instagram,
                $reg->tanggal_lahir,
                $reg->usia,
                $reg->asal_daerah,
                $reg->domisili,
                $reg->status_pernikahan,
                $reg->pendidikan,
                $reg->status_diri,
                $reg->pekerjaan,
                $reg->jabatan,
                $reg->instansi,
                $reg->universitas,
                $reg->jurusan,
                $reg->angkatan,
                $reg->restu,
                $reg->gambaran_awal,
                $reg->alasan,
                $reg->harapan,
                $reg->paket,
                $reg->metode_bayar,
                $reg->harga_dasar,
                $reg->referralCode?->code,
                $reg->potongan_diskon,
                $reg->total_bayar,
                $reg->status,
                $reg->info_dari,
                $reg->created_at->format('Y-m-d H:i:s'),
            ];

            foreach (array_values($data) as $colIndex => $value) {
                $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
                $sheet->setCellValue($column . $row, $value);
            }
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        
        $batchStr = '';
        if ($request->filled('batch_id')) {
            $batch = ActivityBatch::find($request->batch_id);
            if ($batch) {
                $batchStr = '_' . \Illuminate\Support\Str::slug($batch->nama_batch ?? 'Batch-' . $batch->batch_ke);
            }
        }
        
        $fileName = 'Data_Pendaftar_SPN' . $batchStr . '_' . date('Y-m-d_H-i-s') . '.xlsx';

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    public function pendingChanges()
    {
        $registrations = SpnRegistration::whereNotNull('pending_changes')
            ->whereRaw("JSON_LENGTH(pending_changes) > 0")
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.spn.pending-changes', compact('registrations'));
    }

    public function approveChange(Request $request, $id)
    {
        $registration = SpnRegistration::findOrFail($id);
        $field = $request->input('field');
        $pendingChanges = $registration->pending_changes ?? [];

        if (!isset($pendingChanges[$field])) {
            return back()->with('error', 'Perubahan tidak ditemukan.');
        }

        $registration->$field = $pendingChanges[$field];
        unset($pendingChanges[$field]);
        $registration->pending_changes = empty($pendingChanges) ? null : $pendingChanges;
        $registration->save();

        return back()->with('success', "Perubahan field '{$field}' telah disetujui.");
    }

    public function rejectChange(Request $request, $id)
    {
        $registration = SpnRegistration::findOrFail($id);
        $field = $request->input('field');
        $pendingChanges = $registration->pending_changes ?? [];

        if (!isset($pendingChanges[$field])) {
            return back()->with('error', 'Perubahan tidak ditemukan.');
        }

        unset($pendingChanges[$field]);
        $registration->pending_changes = empty($pendingChanges) ? null : $pendingChanges;
        $registration->save();

        return back()->with('success', "Perubahan field '{$field}' telah ditolak.");
    }
}
