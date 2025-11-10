<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ActivityBatch;
use App\Models\TaarufProfile;
use App\Models\TaarufQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    /**
     * CONTROLLER METHOD - Update index() method
     * File: app/Http/Controllers/TaarufController.php
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

        // Check if profile exists but fields are incomplete
        $needsProfileUpdate = false;
        $missingFields = [];

        if ($taarufProfile) {
            // Check for old missing fields
            if (empty($taarufProfile->visi_misi)) {
                $missingFields[] = 'Visi Misi';
            }
            if (empty($taarufProfile->kelebihan_kekurangan)) {
                $missingFields[] = 'Kelebihan & Kekurangan';
            }

            // Check for NEW location fields - Asal Daerah
            if (empty($taarufProfile->origin_province)) {
                $missingFields[] = 'Provinsi Asal';
            }
            if (empty($taarufProfile->origin_city)) {
                $missingFields[] = 'Kota/Kabupaten Asal';
            }
            if (empty($taarufProfile->origin_district)) {
                $missingFields[] = 'Kecamatan Asal';
            }
            if (empty($taarufProfile->origin_village)) {
                $missingFields[] = 'Kelurahan Asal';
            }

            // Check for NEW location fields - Domisili
            if (empty($taarufProfile->residence_province)) {
                $missingFields[] = 'Provinsi Domisili';
            }
            if (empty($taarufProfile->residence_city)) {
                $missingFields[] = 'Kota/Kabupaten Domisili';
            }
            if (empty($taarufProfile->residence_district)) {
                $missingFields[] = 'Kecamatan Domisili';
            }
            if (empty($taarufProfile->residence_village)) {
                $missingFields[] = 'Kelurahan Domisili';
            }

            // Check for NEW education fields
            if (empty($taarufProfile->education_level)) {
                $missingFields[] = 'Strata Pendidikan Terakhir';
            }

            if (empty($taarufProfile->university)) {
                $missingFields[] = 'Nama Institusi/Kampus';
            } else {
                // Jika pilih "Lainnya", custom_university harus diisi
                if ($taarufProfile->university === 'Lainnya' && empty($taarufProfile->custom_university)) {
                    $missingFields[] = 'Nama Kampus Lainnya (Custom)';
                }
            }

            // Major/Jurusan - hanya wajib untuk pendidikan tinggi (D3, D4, S1, S2, S3)
            if (!empty($taarufProfile->education_level)) {
                $highEducationLevels = ['D3', 'D4', 'S1', 'S2', 'S3'];
                if (in_array($taarufProfile->education_level, $highEducationLevels) && empty($taarufProfile->major)) {
                    $missingFields[] = 'Jurusan/Program Studi';
                }
            }

            // Set flag if there are missing fields
            if (count($missingFields) > 0) {
                $needsProfileUpdate = true;
            }
        }

        // Get unread notifications count for taaruf questions
        $unreadQuestionsCount = 0;

        if ($taarufProfile) {
            $unreadQuestionsCount = $user->unreadNotifications()
                ->where('type', 'App\Notifications\NewTaarufQuestion')
                ->count();

            // Get count of unanswered questions
            $unansweredQuestionsCount = TaarufQuestion::where('profile_id', $taarufProfile->id)
                ->where('is_answered', false)
                ->count();

            // If there are unanswered questions, make sure to show notification
            if ($unansweredQuestionsCount > 0 && $unreadQuestionsCount == 0) {
                $unreadQuestionsCount = $unansweredQuestionsCount;
            }
        }

        return view('taaruf.index', compact(
            'taarufProfile',
            'needsProfileUpdate',
            'missingFields',
            'unreadQuestionsCount'
        ));
    }

    /**
     * OPTIONAL: Helper method untuk check kelengkapan profile
     * Bisa dipanggil dari berbagai tempat
     */
    protected function checkProfileCompleteness($profile)
    {
        $requiredFields = [
            'visi_misi' => 'Visi Misi',
            'kelebihan_kekurangan' => 'Kelebihan & Kekurangan',
            'origin_province' => 'Provinsi Asal',
            'origin_city' => 'Kota/Kabupaten Asal',
            'origin_district' => 'Kecamatan Asal',
            'origin_village' => 'Kelurahan Asal',
            'residence_province' => 'Provinsi Domisili',
            'residence_city' => 'Kota/Kabupaten Domisili',
            'residence_district' => 'Kecamatan Domisili',
            'residence_village' => 'Kelurahan Domisili',
        ];

        $missing = [];
        foreach ($requiredFields as $field => $label) {
            if (empty($profile->$field)) {
                $missing[] = $label;
            }
        }

        return [
            'is_complete' => count($missing) === 0,
            'missing_fields' => $missing,
            'completion_percentage' => round((1 - (count($missing) / count($requiredFields))) * 100, 0)
        ];
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
    // public function storeProfile(Request $request)
    // {
    //     // Check if user is eligible
    //     if (!$this->isEligibleForTaaruf()) {
    //         return redirect()->route('alumni.dashboard')
    //             ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
    //     }

    //     $request->validate([
    //         'gender' => 'required|in:male,female',
    //         'full_name' => 'required|string|max:255',
    //         'nickname' => 'required|string|max:100',
    //         'birth_place_date' => 'required|string|max:255',
    //         'current_residence' => 'required|string|max:255',
    //         'last_education' => 'required|string|max:255',
    //         'occupation' => 'required|string|max:255',
    //         'marriage_target_year' => 'nullable|integer|min:2025|max:2050',
    //         'personality' => 'nullable|string|max:255',
    //         'expectation' => 'nullable|string',
    //         'ideal_partner_criteria' => 'nullable|string',
    //         'visi_misi' => 'nullable|string',
    //         'kelebihan_kekurangan' => 'nullable|string',
    //         'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'instagram' => 'nullable|string|max:255',
    //         'informed_consent' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
    //     ]);

    //     $user = Auth::user();

    //     // Handle photo upload
    //     $photoUrl = null;
    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
    //         $photoUrl = Storage::url($photoPath);
    //     }

    //     // Handle informed consent upload
    //     $informedConsentUrl = null;
    //     if ($request->hasFile('informed_consent')) {
    //         $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
    //         $informedConsentUrl = Storage::url($consentPath);
    //     }

    //     // Create taaruf profile
    //     $taarufProfile = TaarufProfile::create([
    //         'user_id' => $user->id,
    //         'is_active' => true,
    //         'gender' => $request->gender,
    //         'full_name' => $request->full_name,
    //         'nickname' => $request->nickname,
    //         'birth_place_date' => $request->birth_place_date,
    //         'current_residence' => $request->current_residence,
    //         'last_education' => $request->last_education,
    //         'occupation' => $request->occupation,
    //         'marriage_target_year' => $request->marriage_target_year,
    //         'personality' => $request->personality,
    //         'expectation' => $request->expectation,
    //         'ideal_partner_criteria' => $request->ideal_partner_criteria,
    //         'visi_misi' => $request->visi_misi,
    //         'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
    //         'photo_url' => $photoUrl,
    //         'instagram' => $request->instagram,
    //         'informed_consent_url' => $informedConsentUrl,
    //     ]);

    //     return redirect()->route('taaruf.questions')
    //         ->with('success', 'Profil Ta\'aruf berhasil dibuat. Silakan lengkapi pertanyaan berikut.');
    // }

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
    // public function updateProfile(Request $request)
    // {
    //     // Check if user is eligible
    //     if (!$this->isEligibleForTaaruf()) {
    //         return redirect()->route('alumni.dashboard')
    //             ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
    //     }

    //     $request->validate([
    //         'gender' => 'required|in:male,female',
    //         'full_name' => 'required|string|max:255',
    //         'nickname' => 'required|string|max:100',
    //         'birth_place_date' => 'required|string|max:255',
    //         'current_residence' => 'required|string|max:255',
    //         'last_education' => 'required|string|max:255',
    //         'occupation' => 'required|string|max:255',
    //         'marriage_target_year' => 'nullable|integer|min:2025|max:2050',
    //         'personality' => 'nullable|string|max:255',
    //         'expectation' => 'nullable|string',
    //         'ideal_partner_criteria' => 'nullable|string',
    //         'visi_misi' => 'nullable|string',
    //         'kelebihan_kekurangan' => 'nullable|string',
    //         'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'instagram' => 'nullable|string|max:255',
    //         'informed_consent' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    //     ]);

    //     $user = Auth::user();
    //     $taarufProfile = $user->taarufProfile;

    //     if (!$taarufProfile) {
    //         return redirect()->route('taaruf.profile.create');
    //     }

    //     // Handle photo upload or removal
    //     if ($request->hasFile('photo')) {
    //         // Delete old photo if exists
    //         if ($taarufProfile->photo_url) {
    //             $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
    //             Storage::disk('public')->delete($oldPath);
    //         }

    //         $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
    //         $taarufProfile->photo_url = Storage::url($photoPath);
    //     } elseif ($request->has('remove_photo') && $request->remove_photo) {
    //         // Remove existing photo if checkbox is checked
    //         if ($taarufProfile->photo_url) {
    //             $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
    //             Storage::disk('public')->delete($oldPath);
    //             $taarufProfile->photo_url = null;
    //         }
    //     }

    //     // Handle informed consent upload
    //     if ($request->hasFile('informed_consent')) {
    //         // Delete old consent if exists
    //         if ($taarufProfile->informed_consent_url) {
    //             $oldPath = str_replace('/storage/', '', $taarufProfile->informed_consent_url);
    //             Storage::disk('public')->delete($oldPath);
    //         }

    //         $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
    //         $taarufProfile->informed_consent_url = Storage::url($consentPath);
    //     }

    //     // Update profile
    //     $taarufProfile->update([
    //         'gender' => $request->gender,
    //         'full_name' => $request->full_name,
    //         'nickname' => $request->nickname,
    //         'birth_place_date' => $request->birth_place_date,
    //         'current_residence' => $request->current_residence,
    //         'last_education' => $request->last_education,
    //         'occupation' => $request->occupation,
    //         'marriage_target_year' => $request->marriage_target_year,
    //         'personality' => $request->personality,
    //         'expectation' => $request->expectation,
    //         'ideal_partner_criteria' => $request->ideal_partner_criteria,
    //         'visi_misi' => $request->visi_misi,
    //         'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
    //         'instagram' => $request->instagram,
    //         'photo_url' => $taarufProfile->photo_url,
    //     ]);

    //     return redirect()->route('taaruf.profile.edit')
    //         ->with('success', 'Profil Ta\'aruf berhasil diperbarui.');
    // }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    // public function showList(Request $request)
    // {
    //     // --- eligibility checks (tetap) ---
    //     if (!$this->isEligibleForTaaruf()) {
    //         return redirect()->route('alumni.dashboard')
    //             ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
    //     }

    //     $user = Auth::user();
    //     $taarufProfile = $user->taarufProfile;

    //     if (!$taarufProfile) {
    //         return redirect()->route('taaruf.profile.create')
    //             ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
    //     }

    //     if (!$taarufProfile->is_active) {
    //         return redirect()->route('taaruf.index')
    //             ->with('error', 'Anda harus mengaktifkan profil Ta\'aruf terlebih dahulu.');
    //     }

    //     // --- perPage selector ---
    //     $allowedPerPage = [10, 25, 50, 100];
    //     $perPage = (int) $request->query('per_page', 12); // default lama 12 (boleh diganti 25)
    //     if (!in_array($perPage, $allowedPerPage, true)) {
    //         $perPage = 12; // fallback aman
    //     }

    //     // --- query utama ---
    //     $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';

    //     $query = TaarufProfile::where('gender', $oppositeGender)
    //         ->where('is_active', true);

    //     // search
    //     if ($request->filled('search')) {
    //         $search = $request->search;
    //         $query->where('full_name', 'like', '%' . $search . '%');
    //     }

    //     // filter
    //     if ($request->has('filter') && $request->filter !== 'all') {
    //         switch ($request->filter) {
    //             case 'location':
    //                 if ($request->filled('location')) {
    //                     $query->where('current_residence', $request->location);
    //                 }
    //                 break;
    //             case 'education':
    //                 if ($request->filled('education')) {
    //                     $query->where('last_education', $request->education);
    //                 }
    //                 break;
    //             case 'marriage_year':
    //                 if ($request->filled('marriage_year')) {
    //                     $query->where('marriage_target_year', $request->marriage_year);
    //                 }
    //                 break;
    //         }
    //     }

    //     // dropdown sources (opsional: filter null)
    //     $locations = TaarufProfile::where('gender', $oppositeGender)
    //         ->where('is_active', true)
    //         ->whereNotNull('current_residence')
    //         ->distinct()
    //         ->pluck('current_residence')
    //         ->toArray();

    //     $educations = TaarufProfile::where('gender', $oppositeGender)
    //         ->where('is_active', true)
    //         ->whereNotNull('last_education')
    //         ->distinct()
    //         ->pluck('last_education')
    //         ->toArray();

    //     // paginate dengan perPage dinamis
    //     $profiles = $query->with('user')
    //         ->orderBy('full_name', 'asc')
    //         ->paginate($perPage)
    //         ->appends($request->except('page')); // pertahankan query-string

    //     $myProfile = $taarufProfile;

    //     return view('taaruf.list', compact(
    //         'profiles',
    //         'myProfile',
    //         'locations',
    //         'educations'
    //     ));
    // }


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



    // Update validation di storeProfile method
    public function storeProfile(Request $request)
    {
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $request->validate([
            'gender' => 'required|in:male,female',
            'full_name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100',
            'birth_place_date' => 'required|string|max:255',

            // Asal Daerah (Detail)
            'origin_province' => 'required|string|max:255',
            'origin_city' => 'required|string|max:255',
            'origin_district' => 'required|string|max:255',
            'origin_village' => 'required|string|max:255',

            // Domisili (Detail)
            'current_residence' => 'required|string|max:255',
            'residence_province' => 'required|string|max:255',
            'residence_city' => 'required|string|max:255',
            'residence_district' => 'required|string|max:255',
            'residence_village' => 'required|string|max:255',

            'last_education' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'marriage_target_year' => 'nullable|integer|min:2025|max:2050',
            'personality' => 'nullable|string|max:255',
            'expectation' => 'nullable|string',
            'ideal_partner_criteria' => 'nullable|string',
            'visi_misi' => 'nullable|string',
            'kelebihan_kekurangan' => 'nullable|string',
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

            // Asal Daerah
            'origin_province' => $request->origin_province,
            'origin_city' => $request->origin_city,
            'origin_district' => $request->origin_district,
            'origin_village' => $request->origin_village,

            // Domisili
            'current_residence' => $request->current_residence,
            'residence_province' => $request->residence_province,
            'residence_city' => $request->residence_city,
            'residence_district' => $request->residence_district,
            'residence_village' => $request->residence_village,

            'last_education' => $request->last_education,
            'occupation' => $request->occupation,
            'marriage_target_year' => $request->marriage_target_year,
            'personality' => $request->personality,
            'expectation' => $request->expectation,
            'ideal_partner_criteria' => $request->ideal_partner_criteria,
            'visi_misi' => $request->visi_misi,
            'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
            'photo_url' => $photoUrl,
            'instagram' => $request->instagram,
            'informed_consent_url' => $informedConsentUrl,
        ]);

        return redirect()->route('taaruf.questions')
            ->with('success', 'Profil Ta\'aruf berhasil dibuat. Silakan lengkapi pertanyaan berikut.');
    }

    // Update validation di updateProfile method
    public function updateProfile(Request $request)
    {

        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $request->validate([
            'gender' => 'required|in:male,female',
            'full_name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100',
            'birth_place_date' => 'required|string|max:255',

            // Asal Daerah (Detail)
            'origin_province' => 'required|string|max:255',
            'origin_city' => 'required|string|max:255',
            'origin_district' => 'required|string|max:255',
            'origin_village' => 'required|string|max:255',

            // Domisili (Detail)
            'current_residence' => 'required|string|max:255',
            'residence_province' => 'required|string|max:255',
            'residence_city' => 'required|string|max:255',
            'residence_district' => 'required|string|max:255',
            'residence_village' => 'required|string|max:255',

            'last_education' => 'required|string|max:255',

            'education_level' => 'required|string|in:SD,SMP,SMA,SMK,D3,D4,S1,S2,S3',
            'university' => 'required|string',
            'custom_university' => 'nullable|string|required_if:university,Lainnya',
            'major' => 'nullable|string',

            'occupation' => 'required|string|max:255',
            'marriage_target_year' => 'nullable|integer|min:2025|max:2050',
            'personality' => 'nullable|string|max:255',
            'expectation' => 'nullable|string',
            'ideal_partner_criteria' => 'nullable|string',
            'visi_misi' => 'nullable|string',
            'kelebihan_kekurangan' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => 'nullable|string|max:255',
            'informed_consent' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        // dd($request);
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create');
        }

        // Handle photo upload or removal
        if ($request->hasFile('photo')) {
            if ($taarufProfile->photo_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
                Storage::disk('public')->delete($oldPath);
            }
            $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
            $taarufProfile->photo_url = Storage::url($photoPath);
        } elseif ($request->has('remove_photo') && $request->remove_photo) {
            if ($taarufProfile->photo_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
                Storage::disk('public')->delete($oldPath);
                $taarufProfile->photo_url = null;
            }
        }

        // Handle informed consent upload
        if ($request->hasFile('informed_consent')) {
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

            // Asal Daerah
            'origin_province' => $request->origin_province,
            'origin_city' => $request->origin_city,
            'origin_district' => $request->origin_district,
            'origin_village' => $request->origin_village,

            // Domisili
            'current_residence' => $request->current_residence,
            'residence_province' => $request->residence_province,
            'residence_city' => $request->residence_city,
            'residence_district' => $request->residence_district,
            'residence_village' => $request->residence_village,

            'last_education' => $request->last_education,

            'education_level' => $request->education_level,
            'university' => $request->university,
            'custom_university' => $request->custom_university,
            'major' => $request->major,

            'occupation' => $request->occupation,
            'marriage_target_year' => $request->marriage_target_year,
            'personality' => $request->personality,
            'expectation' => $request->expectation,
            'ideal_partner_criteria' => $request->ideal_partner_criteria,
            'visi_misi' => $request->visi_misi,
            'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
            'instagram' => $request->instagram,
            'photo_url' => $taarufProfile->photo_url,
        ]);

        return redirect()->route('taaruf.profile.edit')
            ->with('success', 'Profil Ta\'aruf berhasil diperbarui.');
    }












    public function showList(Request $request)
    {
        // --- eligibility checks (tetap) ---
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

        // --- perPage selector ---
        $allowedPerPage = [10, 25, 50, 100];
        $perPage = (int) $request->query('per_page', 12);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 12;
        }

        // --- query utama ---
        $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';

        $query = TaarufProfile::where('gender', $oppositeGender)
            ->where('is_active', true);

        // --- SEARCH ---
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('nickname', 'like', '%' . $search . '%');
            });
        }

        // --- FILTER ---
        $filter = $request->get('filter', 'all');

        if ($filter !== 'all') {
            switch ($filter) {
                case 'location':
                    $this->applyLocationFilter($query, $request);
                    break;

                case 'education':
                    if ($request->filled('education')) {
                        $query->where('last_education', $request->education);
                    }
                    break;

                case 'marriage_year':
                    if ($request->filled('marriage_year')) {
                        $query->where('marriage_target_year', $request->marriage_year);
                    }
                    break;
            }
        }

        // --- DROPDOWN SOURCES untuk Education ---
        $educations = TaarufProfile::where('gender', $oppositeGender)
            ->where('is_active', true)
            ->whereNotNull('last_education')
            ->where('last_education', '!=', '')
            ->distinct()
            ->pluck('last_education')
            ->sort()
            ->values()
            ->toArray();

        // --- PAGINATE ---
        $profiles = $query->with('user')
            ->orderBy('full_name', 'asc')
            ->paginate($perPage)
            ->appends($request->except('page'));

        $myProfile = $taarufProfile;

        return view('taaruf.list', compact(
            'profiles',
            'myProfile',
            'educations'
        ));
    }

    /**
     * Apply location filter based on type and level
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyLocationFilter($query, Request $request)
    {
        // Get filter parameters
        $locationType = $request->get('location_type', 'origin'); // origin or residence
        $locationLevel = $request->get('location_level', 'province'); // province, city, or district

        // Determine field prefix based on location type
        $prefix = $locationType === 'residence' ? 'residence_' : 'origin_';

        // Apply filter based on level
        switch ($locationLevel) {
            case 'province':
                // Filter by province only
                if ($request->filled('location_province')) {
                    $query->where($prefix . 'province', $request->location_province);
                }
                break;

            case 'city':
                // Filter by province (if selected)
                if ($request->filled('location_province')) {
                    $query->where($prefix . 'province', $request->location_province);
                }
                // Filter by city (if selected)
                if ($request->filled('location_city')) {
                    $query->where($prefix . 'city', $request->location_city);
                }
                break;

            case 'district':
                // Filter by province (if selected)
                if ($request->filled('location_province')) {
                    $query->where($prefix . 'province', $request->location_province);
                }
                // Filter by city (if selected)
                if ($request->filled('location_city')) {
                    $query->where($prefix . 'city', $request->location_city);
                }
                // Filter by district (if selected)
                if ($request->filled('location_district')) {
                    $query->where($prefix . 'district', $request->location_district);
                }
                break;
        }

        return $query;
    }

    /**
     * Get unique locations from database (alternative method if needed)
     * 
     * @param string $oppositeGender
     * @param string $type (origin or residence)
     * @param string $level (province, city, or district)
     * @return array
     */
    protected function getUniqueLocations($oppositeGender, $type = 'origin', $level = 'province')
    {
        $prefix = $type === 'residence' ? 'residence_' : 'origin_';
        $field = $prefix . $level;

        return TaarufProfile::where('gender', $oppositeGender)
            ->where('is_active', true)
            ->whereNotNull($field)
            ->where($field, '!=', '')
            ->distinct()
            ->pluck($field)
            ->sort()
            ->values()
            ->toArray();
    }

    /**
     * OPTIONAL: Helper method untuk debugging filter
     * Tambahkan ini jika ingin log filter yang diterapkan
     */
    protected function logFilterParameters(Request $request)
    {
        if ($request->get('filter') === 'location') {
            \Log::info('Location Filter Applied', [
                'location_type' => $request->get('location_type'),
                'location_level' => $request->get('location_level'),
                'province' => $request->get('location_province'),
                'city' => $request->get('location_city'),
                'district' => $request->get('location_district'),
            ]);
        }
    }
}
