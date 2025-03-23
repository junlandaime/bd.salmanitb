<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaarufProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaarufAdminController extends Controller
{
    /**
     * Display a listing of the taaruf profiles.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = TaarufProfile::with(['user', 'user.batchAlumni']);

        // Handle all gender filter options
        if ($request->has('gender')) {
            if ($request->gender === 'male' || $request->gender === 'female') {
                // Filter by specific gender
                $query->where('gender', $request->gender);
            } elseif ($request->gender === 'gender_mismatch') {
                // Use a more explicit approach to find mismatches
                $query->whereHas('user.batchAlumni', function ($q) {
                    $q->where(function ($subquery) {
                        // Case 1: Profile is female but alumni record says Pria
                        $subquery->where('batch_alumni.gender', 'Pria')
                            ->whereHas('user.taarufProfile', function ($profileQuery) {
                                $profileQuery->where('gender', 'female');
                            });
                    })->orWhere(function ($subquery) {
                        // Case 2: Profile is male but alumni record says Wanita
                        $subquery->where('batch_alumni.gender', 'Wanita')
                            ->whereHas('user.taarufProfile', function ($profileQuery) {
                                $profileQuery->where('gender', 'male');
                            });
                    });
                });
            }
        }

        // Filter by active status if requested
        if ($request->has('status') && in_array($request->status, ['active', 'inactive'])) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $profiles = $query->latest()->paginate(15);

        // For debugging purposes, you could log the SQL query
        // \Log::info($query->toSql());
        // \Log::info($query->getBindings());

        return view('admin.taaruf.index', compact('profiles'));
    }

    /**
     * Show the form for editing the specified taaruf profile.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $profile = TaarufProfile::with('user')->findOrFail($id);

        return view('admin.taaruf.edit', compact('profile'));
    }

    /**
     * Update the specified taaruf profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'gender' => 'required|in:male,female',
            'full_name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100',
            'birth_place_date' => 'required|string|max:255',
            'current_residence' => 'required|string|max:255',
            'last_education' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'marriage_target_year' => 'nullable|integer|min:2025|max:2050',
            'personality' => 'nullable|string|max:255',
            'expectation' => 'nullable|string',
            'ideal_partner_criteria' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'is_in_taaruf_process' => 'required|boolean',
            'is_smoker' => 'required|boolean',
            'is_polygamy_intended' => 'required|boolean',
            'has_debt' => 'required|boolean',
            'has_dependents' => 'required|boolean',
        ]);

        $profile = TaarufProfile::findOrFail($id);

        // Handle photo upload or removal
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($profile->photo_url) {
                $oldPath = str_replace('/storage/', '', $profile->photo_url);
                Storage::disk('public')->delete($oldPath);
            }

            $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
            $profile->photo_url = Storage::url($photoPath);
        } elseif ($request->has('remove_photo') && $request->remove_photo) {
            // Remove existing photo if checkbox is checked
            if ($profile->photo_url) {
                $oldPath = str_replace('/storage/', '', $profile->photo_url);
                Storage::disk('public')->delete($oldPath);
                $profile->photo_url = null;
            }
        }

        // Update profile
        $profile->update([
            'gender' => $request->gender,
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'birth_place_date' => $request->birth_place_date,
            'current_residence' => $request->current_residence,
            'last_education' => $request->last_education,
            'occupation' => $request->occupation,
            'marriage_target_year' => $request->marriage_target_year,
            'personality' => $request->personality,
            'expectation' => $request->expectation,
            'ideal_partner_criteria' => $request->ideal_partner_criteria,
            'instagram' => $request->instagram,
            'is_active' => $request->is_active,
            'is_in_taaruf_process' => $request->is_in_taaruf_process,
            'is_smoker' => $request->is_smoker,
            'is_polygamy_intended' => $request->is_polygamy_intended,
            'has_debt' => $request->has_debt,
            'has_dependents' => $request->has_dependents,
            'photo_url' => $profile->photo_url,
        ]);

        return redirect()->route('admin.taaruf.index')
            ->with('success', 'Profil Ta\'aruf berhasil diperbarui.');
    }

    /**
     * Remove the specified taaruf profile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $profile = TaarufProfile::findOrFail($id);

        // Delete photo if exists
        if ($profile->photo_url) {
            $photoPath = str_replace('/storage/', '', $profile->photo_url);
            Storage::disk('public')->delete($photoPath);
        }

        // Delete informed consent if exists
        if ($profile->informed_consent_url) {
            $consentPath = str_replace('/storage/', '', $profile->informed_consent_url);
            Storage::disk('public')->delete($consentPath);
        }

        $profile->delete();

        return redirect()->route('admin.taaruf.index')
            ->with('success', 'Profil Ta\'aruf berhasil dihapus.');
    }

    /**
     * Show the details of a specific taaruf profile.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $profile = TaarufProfile::with('user')->findOrFail($id);

        return view('admin.taaruf.show', compact('profile'));
    }

    /**
     * Toggle the active status of a taaruf profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleActive($id)
    {
        $profile = TaarufProfile::findOrFail($id);
        $profile->is_active = !$profile->is_active;
        $profile->save();

        $status = $profile->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.taaruf.index')
            ->with('success', "Profil Ta'aruf berhasil {$status}.");
    }

    /**
     * Display statistics about taaruf profiles.
     *
     * @return \Illuminate\View\View
     */
    public function statistics()
    {
        $totalProfiles = TaarufProfile::count();
        $activeProfiles = TaarufProfile::where('is_active', true)->count();
        $maleProfiles = TaarufProfile::where('gender', 'male')->count();
        $femaleProfiles = TaarufProfile::where('gender', 'female')->count();
        $activeMaleProfiles = TaarufProfile::where('gender', 'male')->where('is_active', true)->count();
        $activeFemaleProfiles = TaarufProfile::where('gender', 'female')->where('is_active', true)->count();
        $inTaarufProcess = TaarufProfile::where('is_in_taaruf_process', true)->count();
        $smokerProfiles = TaarufProfile::where('is_smoker', true)->count();
        $polygamyIntendedProfiles = TaarufProfile::where('is_polygamy_intended', true)->count();
        $debtProfiles = TaarufProfile::where('has_debt', true)->count();
        $dependentProfiles = TaarufProfile::where('has_dependents', true)->count();

        return view('admin.taaruf.statistics', compact(
            'totalProfiles',
            'activeProfiles',
            'maleProfiles',
            'femaleProfiles',
            'activeMaleProfiles',
            'activeFemaleProfiles',
            'inTaarufProcess',
            'smokerProfiles',
            'polygamyIntendedProfiles',
            'debtProfiles',
            'dependentProfiles'
        ));
    }
}
