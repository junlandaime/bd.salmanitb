<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityBatch;
use App\Models\TaarufProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaarufController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }

    /**
     * Check if user is eligible for taaruf (alumni of SPN Online or Offline)
     *
     * @return bool
     */
    private function isEligibleForTaaruf()
    {
        $user = Auth::user();

        // Get all batches where user is an alumni
        $batches = $user->batchesAsAlumni()->with('activity')->get();

        // Check if any batch is from Sekolah Pranikah Online or Offline
        foreach ($batches as $batch) {
            if (Str::contains($batch->activity->title, ['Sekolah Pranikah Online', 'Sekolah Pranikah Offline'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Show taaruf dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        return view('taaruf.index', compact('taarufProfile'));
    }

    /**
     * Show terms and conditions for taaruf
     *
     * @return \Illuminate\View\View
     */
    public function showTerms()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        return view('taaruf.terms');
    }

    /**
     * Accept terms and proceed to profile form
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptTerms()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        // If user already has a profile, activate it and redirect to questions
        if ($taarufProfile) {
            $taarufProfile->is_active = true;
            $taarufProfile->save();

            return redirect()->route('taaruf.questions');
        }

        // Otherwise, redirect to create profile form
        return redirect()->route('taaruf.profile.create');
    }

    /**
     * Show the form for creating a new taaruf profile
     *
     * @return \Illuminate\View\View
     */
    public function createProfile()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();

        // If user already has a profile, redirect to edit
        if ($user->taarufProfile) {
            return redirect()->route('taaruf.profile.edit');
        }

        return view('taaruf.profile.create');
    }

    /**
     * Store a newly created taaruf profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProfile(Request $request)
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

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
            'informed_consent' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $user = Auth::user();

        // Handle photo upload
        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
            $photoUrl = Storage::url($photoPath);
        }

        // Handle informed consent upload
        $informedConsentUrl = null;
        if ($request->hasFile('informed_consent')) {
            $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
            $informedConsentUrl = Storage::url($consentPath);
        }

        // Create taaruf profile
        $taarufProfile = TaarufProfile::create([
            'user_id' => $user->id,
            'is_active' => true,
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
            'photo_url' => $photoUrl,
            'instagram' => $request->instagram,
            'informed_consent_url' => $informedConsentUrl,
        ]);

        return redirect()->route('taaruf.questions')
            ->with('success', 'Profil Ta\'aruf berhasil dibuat. Silakan lengkapi pertanyaan berikut.');
    }

    /**
     * Show the form for editing the taaruf profile
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $profile = $user->taarufProfile;

        if (!$profile) {
            return redirect()->route('taaruf.profile.create');
        }

        return view('taaruf.profile.edit', compact('profile'));
    }

    /**
     * Update the taaruf profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

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
            'informed_consent' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create');
        }

        // Handle photo upload or removal
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($taarufProfile->photo_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
                Storage::disk('public')->delete($oldPath);
            }

            $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
            $taarufProfile->photo_url = Storage::url($photoPath);
        } elseif ($request->has('remove_photo') && $request->remove_photo) {
            // Remove existing photo if checkbox is checked
            if ($taarufProfile->photo_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
                Storage::disk('public')->delete($oldPath);
                $taarufProfile->photo_url = null;
            }
        }

        // Handle informed consent upload
        if ($request->hasFile('informed_consent')) {
            // Delete old consent if exists
            if ($taarufProfile->informed_consent_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->informed_consent_url);
                Storage::disk('public')->delete($oldPath);
            }

            $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
            $taarufProfile->informed_consent_url = Storage::url($consentPath);
        }

        // Update profile
        $taarufProfile->update([
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
            'photo_url' => $taarufProfile->photo_url,
        ]);

        return redirect()->route('taaruf.profile.edit')
            ->with('success', 'Profil Ta\'aruf berhasil diperbarui.');
    }

    /**
     * Show questions form
     *
     * @return \Illuminate\View\View
     */
    public function showQuestions()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        return view('taaruf.questions', compact('taarufProfile'));
    }

    /**
     * Save answers to questions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveQuestions(Request $request)
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $request->validate([
            'is_in_taaruf_process' => 'required|boolean',
            'is_smoker' => 'required|boolean',
            'is_polygamy_intended' => 'required|boolean',
            'has_debt' => 'required|boolean',
            'has_dependents' => 'required|boolean',
        ]);

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        // Update profile with answers
        $taarufProfile->update([
            'is_in_taaruf_process' => $request->is_in_taaruf_process,
            'is_smoker' => $request->is_smoker,
            'is_polygamy_intended' => $request->is_polygamy_intended,
            'has_debt' => $request->has_debt,
            'has_dependents' => $request->has_dependents,
        ]);

        return redirect()->route('taaruf.list')
            ->with('success', 'Jawaban berhasil disimpan.');
    }

    /**
     * Show list of alumni who are open for taaruf
     *
     * @return \Illuminate\View\View
     */
    public function showList()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        if (!$taarufProfile->is_active) {
            return redirect()->route('taaruf.index')
                ->with('error', 'Anda harus mengaktifkan profil Ta\'aruf terlebih dahulu.');
        }

        // Get opposite gender profiles that are active
        $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';

        $profiles = TaarufProfile::where('gender', $oppositeGender)
            ->where('is_active', true)
            ->with('user')
            ->paginate(12);

        // Pass the user's own profile as myProfile
        $myProfile = $taarufProfile;

        return view('taaruf.list', compact('profiles', 'myProfile'));
    }

    /**
     * Show a specific taaruf profile
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showProfile($id)
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $userProfile = $user->taarufProfile;

        if (!$userProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        if (!$userProfile->is_active) {
            return redirect()->route('taaruf.index')
                ->with('error', 'Anda harus mengaktifkan profil Ta\'aruf terlebih dahulu.');
        }

        // Get the profile to view
        $profile = TaarufProfile::findOrFail($id);

        // Check if profile is of opposite gender
        if ($profile->gender === $userProfile->gender) {
            return redirect()->route('taaruf.list')
                ->with('error', 'Anda hanya dapat melihat profil lawan jenis.');
        }

        // Check if profile is active
        if (!$profile->is_active) {
            return redirect()->route('taaruf.list')
                ->with('error', 'Profil yang Anda cari tidak aktif.');
        }

        return view('taaruf.profile.show', compact('profile'));
    }

    /**
     * Toggle taaruf profile active status
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleActive()
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        // Toggle active status
        $taarufProfile->is_active = !$taarufProfile->is_active;
        $taarufProfile->save();

        $status = $taarufProfile->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('taaruf.index')
            ->with('success', "Profil Ta'aruf Anda berhasil {$status}.");
    }
}
