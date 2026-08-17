<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityBatch;
use App\Models\SpnDiscount;
use App\Models\SpnPricingPackage;
use Illuminate\Http\Request;

class SpnPricingController extends Controller
{
    protected function getActiveBatch()
    {
        return ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })->where('status', 'aktif')->latest()->first();
    }

    public function index()
    {
        $batch = $this->getActiveBatch();
        $batchId = $batch ? $batch->id : 0;

        $packages = SpnPricingPackage::where('activity_batch_id', $batchId)
            ->orderBy('sort_order')
            ->get();

        $discounts = SpnDiscount::where('activity_batch_id', $batchId)
            ->get();

        return view('admin.spn.pricing.index', compact('packages', 'discounts', 'batch'));
    }

    public function storePackage(Request $request)
    {
        $batch = $this->getActiveBatch();
        if (!$batch) {
            return back()->with('error', 'Tidak ada batch SPN yang aktif.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only(['name', 'slug', 'base_price', 'available_from', 'available_until', 'sort_order']);
        $data['activity_batch_id'] = $batch->id;
        $data['is_active'] = $request->has('is_active');

        SpnPricingPackage::create($data);

        return redirect()->route('admin.spn.pricing.index')->with('success', 'Paket harga berhasil ditambahkan.');
    }

    public function updatePackage(Request $request, $id)
    {
        $package = SpnPricingPackage::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only(['name', 'slug', 'base_price', 'available_from', 'available_until', 'sort_order']);
        $data['is_active'] = $request->has('is_active');

        $package->update($data);

        return redirect()->route('admin.spn.pricing.index')->with('success', 'Paket harga berhasil diperbarui.');
    }

    public function destroyPackage($id)
    {
        $package = SpnPricingPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.spn.pricing.index')->with('success', 'Paket harga berhasil dihapus.');
    }

    public function storeDiscount(Request $request)
    {
        $batch = $this->getActiveBatch();
        if (!$batch) {
            return back()->with('error', 'Tidak ada batch SPN yang aktif.');
        }

        $request->validate([
            'category' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'applies_to_status_diri' => 'nullable|string|max:255',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        $data = $request->only(['category', 'label', 'applies_to_status_diri', 'discount_percent']);
        $data['activity_batch_id'] = $batch->id;
        $data['is_active'] = $request->has('is_active');

        SpnDiscount::create($data);

        return redirect()->route('admin.spn.pricing.index')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function updateDiscount(Request $request, $id)
    {
        $discount = SpnDiscount::findOrFail($id);

        $request->validate([
            'category' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'applies_to_status_diri' => 'nullable|string|max:255',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        $data = $request->only(['category', 'label', 'applies_to_status_diri', 'discount_percent']);
        $data['is_active'] = $request->has('is_active');

        $discount->update($data);

        return redirect()->route('admin.spn.pricing.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function destroyDiscount($id)
    {
        $discount = SpnDiscount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.spn.pricing.index')->with('success', 'Diskon berhasil dihapus.');
    }
}
