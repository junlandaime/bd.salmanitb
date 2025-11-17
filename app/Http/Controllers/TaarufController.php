<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\DateHelper;
use App\Models\ActivityBatch;
use App\Models\TaarufProfile;
use App\Models\TaarufQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Support\UploadSanitizer;


class TaarufController extends Controller
{
    /**
     * Check if user is eligible for taaruf (alumni of SPN Online or Offline)
     */
    private function isEligibleForTaaruf()
    {
        $user = Auth::user();
        $batches = $user->batchesAsAlumni()->with('activity')->get();

        foreach ($batches as $batch) {
            if (Str::contains($batch->activity->title, ['Sekolah Pranikah Online', 'Sekolah Pranikah Offline'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Show taaruf dashboard
     */
    public function index()
    {
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        $needsProfileUpdate = false;
        $needsBirthDateWarning = false;
        $missingFields = [];

        if ($taarufProfile) {

            if (empty($taarufProfile->birth_place_date) || DateHelper::getAgeFromBirthPlaceDate($taarufProfile->birth_place_date) === null) {
                $needsBirthDateWarning = true;
                $missingFields[] = 'Tempat & Tanggal Lahir (format: Kota, 4 Oktober 1995)';
            }
            if (empty($taarufProfile->visi_misi)) {
                $missingFields[] = 'Kriteria Pasangan';
            }
            if (empty($taarufProfile->kelebihan_kekurangan)) {
                $missingFields[] = 'Kelebihan & Kekurangan';
            }
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
            if (empty($taarufProfile->education_level)) {
                $missingFields[] = 'Strata Pendidikan Terakhir';
            }
            if (empty($taarufProfile->university)) {
                $missingFields[] = 'Nama Institusi/Kampus';
            } else {
                if ($taarufProfile->university === 'Lainnya' && empty($taarufProfile->custom_university)) {
                    $missingFields[] = 'Nama Kampus Lainnya (Custom)';
                }
            }

            if (!empty($taarufProfile->education_level)) {
                $highEducationLevels = ['D3', 'D4', 'S1', 'S2', 'S3'];
                if (in_array($taarufProfile->education_level, $highEducationLevels) && empty($taarufProfile->major)) {
                    $missingFields[] = 'Jurusan/Program Studi';
                }
            }

            if (count($missingFields) > 0) {
                $needsProfileUpdate = true;
            }
        }

        $unreadQuestionsCount = 0;

        if ($taarufProfile) {
            $unreadQuestionsCount = $user->unreadNotifications()
                ->where('type', 'App\Notifications\NewTaarufQuestion')
                ->count();

            $unansweredQuestionsCount = TaarufQuestion::where('profile_id', $taarufProfile->id)
                ->where('is_answered', false)
                ->count();

            if ($unansweredQuestionsCount > 0 && $unreadQuestionsCount == 0) {
                $unreadQuestionsCount = $unansweredQuestionsCount;
            }
        }

        return view('taaruf.index', compact(
            'taarufProfile',
            'needsProfileUpdate',
            'needsBirthDateWarning',
            'missingFields',
            'unreadQuestionsCount'
        ));
    }

    /**
     * Helper method untuk check kelengkapan profile
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
     */
    public function showTerms()
    {
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        return view('taaruf.terms');
    }

    /**
     * Accept terms and proceed to profile form
     */
    public function acceptTerms()
    {
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if ($taarufProfile) {
            $taarufProfile->is_active = true;
            $taarufProfile->save();

            return redirect()->route('taaruf.questions');
        }

        return redirect()->route('taaruf.profile.create');
    }

    /**
     * Show the form for creating a new taaruf profile
     */
    public function createProfile()
    {
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }

        $user = Auth::user();

        if ($user->taarufProfile) {
            return redirect()->route('taaruf.profile.edit');
        }

        return view('taaruf.profile.create');
    }

    /**
     * Show the form for editing the taaruf profile
     */
    public function editProfile()
    {
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
     * Show questions form
     */
    public function showQuestions()
    {
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
     */
    public function saveQuestions(Request $request)
    {
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
     * Show list of alumni who are open for taaruf - ENHANCED VERSION
     */
    public function showList(Request $request)
    {
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

        // Per page selector
        $allowedPerPage = [10, 25, 50, 100];
        $perPage = (int) $request->query('per_page', 12);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 12;
        }

        // Main query
        $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';

        $query = TaarufProfile::where('gender', $oppositeGender)
            ->where('is_active', true);

        // Search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('nickname', 'like', '%' . $search . '%');
            });
        }

        // Filter handling
        $filter = $request->get('filter', 'all');

        // ========================================
        // EDUCATION FILTER (Enhanced)
        // ========================================
        if ($filter === 'education') {
            $educationFilterType = $request->get('education_filter_type', 'strata');

            switch ($educationFilterType) {
                case 'strata':
                    // Filter by education level only
                    if ($request->filled('filter_education_level')) {
                        $query->where('education_level', $request->filter_education_level);
                    }
                    break;

                case 'university':
                    // Filter by university only
                    if ($request->filled('filter_university')) {
                        $query->where(function ($q) use ($request) {
                            $q->where('university', $request->filter_university)
                                ->orWhere('custom_university', $request->filter_university);
                        });
                    }
                    break;

                case 'major':
                    // Filter by major only
                    if ($request->filled('filter_major')) {
                        $query->where('major', 'like', '%' . $request->filter_major . '%');
                    }
                    break;

                case 'strata_university':
                    // Filter by both strata and university
                    if ($request->filled('filter_education_level')) {
                        $query->where('education_level', $request->filter_education_level);
                    }
                    if ($request->filled('filter_university')) {
                        $query->where(function ($q) use ($request) {
                            $q->where('university', $request->filter_university)
                                ->orWhere('custom_university', $request->filter_university);
                        });
                    }
                    break;

                case 'strata_major':
                    // Filter by both strata and major
                    if ($request->filled('filter_education_level')) {
                        $query->where('education_level', $request->filter_education_level);
                    }
                    if ($request->filled('filter_major')) {
                        $query->where('major', 'like', '%' . $request->filter_major . '%');
                    }
                    break;

                case 'full':
                    // Filter by strata, university, and major
                    if ($request->filled('filter_education_level')) {
                        $query->where('education_level', $request->filter_education_level);
                    }
                    if ($request->filled('filter_university')) {
                        $query->where(function ($q) use ($request) {
                            $q->where('university', $request->filter_university)
                                ->orWhere('custom_university', $request->filter_university);
                        });
                    }
                    if ($request->filled('filter_major')) {
                        $query->where('major', 'like', '%' . $request->filter_major . '%');
                    }
                    break;
            }
        }

        // ========================================
        // LOCATION FILTER
        // ========================================
        elseif ($filter === 'location') {
            $this->applyLocationFilter($query, $request);
        }

        // ========================================
        // MARRIAGE YEAR FILTER
        // ========================================
        elseif ($filter === 'marriage_year') {
            if ($request->filled('marriage_year')) {
                $query->where('marriage_target_year', $request->marriage_year);
            }
        }

        // Get education levels for dropdown
        $educations = TaarufProfile::where('gender', $oppositeGender)
            ->where('is_active', true)
            ->whereNotNull('last_education')
            ->where('last_education', '!=', '')
            ->distinct()
            ->pluck('last_education')
            ->sort()
            ->values()
            ->toArray();

        // Paginate
        $profiles = $query->with('user')
            ->orderBy('full_name', 'asc')
            ->paginate($perPage)
            ->appends($request->except('page'));

        $myProfile = $taarufProfile;

        // View preference
        $view = $request->get('view', 'card');

        return view('taaruf.list', compact(
            'profiles',
            'myProfile',
            'educations',
            'view'
        ));
    }

    /**
     * Show a specific taaruf profile
     */
    public function showProfile($id)
    {
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

        $profile = TaarufProfile::findOrFail($id);

        if ($profile->gender === $userProfile->gender) {
            return redirect()->route('taaruf.list')
                ->with('error', 'Anda hanya dapat melihat profil lawan jenis.');
        }

        if (!$profile->is_active) {
            return redirect()->route('taaruf.list')
                ->with('error', 'Profil yang Anda cari tidak aktif.');
        }

        return view('taaruf.profile.show', compact('profile'));
    }

    /**
     * Toggle taaruf profile active status
     */
    public function toggleActive()
    {
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

        $taarufProfile->is_active = !$taarufProfile->is_active;
        $taarufProfile->save();

        $status = $taarufProfile->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('taaruf.index')
            ->with('success', "Profil Ta'aruf Anda berhasil {$status}.");
    }

    /**
     * Store a newly created taaruf profile
     */
    // public function storeProfile(Request $request)
    // {
    //     if (!$this->isEligibleForTaaruf()) {
    //         return redirect()->route('alumni.dashboard')
    //             ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
    //     }

    //     $request->validate([
    //         'gender' => 'required|in:male,female',
    //         'full_name' => 'required|string|max:255',
    //         'nickname' => 'required|string|max:100',
    //         'birth_place_date' => 'required|string|max:255',
    //         'origin_province' => 'required|string|max:255',
    //         'origin_city' => 'required|string|max:255',
    //         'origin_district' => 'required|string|max:255',
    //         'origin_village' => 'required|string|max:255',
    //         'current_residence' => 'required|string|max:255',
    //         'residence_province' => 'required|string|max:255',
    //         'residence_city' => 'required|string|max:255',
    //         'residence_district' => 'required|string|max:255',
    //         'residence_village' => 'required|string|max:255',
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

    //     $photoUrl = null;
    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
    //         $photoUrl = Storage::url($photoPath);
    //     }

    //     $informedConsentUrl = null;
    //     if ($request->hasFile('informed_consent')) {
    //         $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
    //         $informedConsentUrl = Storage::url($consentPath);
    //     }

    //     $taarufProfile = TaarufProfile::create([
    //         'user_id' => $user->id,
    //         'is_active' => true,
    //         'gender' => $request->gender,
    //         'full_name' => $request->full_name,
    //         'nickname' => $request->nickname,
    //         'birth_place_date' => $request->birth_place_date,
    //         'origin_province' => $request->origin_province,
    //         'origin_city' => $request->origin_city,
    //         'origin_district' => $request->origin_district,
    //         'origin_village' => $request->origin_village,
    //         'current_residence' => $request->current_residence,
    //         'residence_province' => $request->residence_province,
    //         'residence_city' => $request->residence_city,
    //         'residence_district' => $request->residence_district,
    //         'residence_village' => $request->residence_village,
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

    public function storeProfile(Request $request)
    {
        // Check if user is eligible
        if (!$this->isEligibleForTaaruf()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
        }


        $user = Auth::user();

        if ($user->taarufProfile()->exists()) {
            return redirect()
                ->route('taaruf.profile.edit') // atau route lain yang tepat
                ->with('error', 'Profil Ta\'aruf Anda sudah ada. Silakan perbarui profil tersebut.');
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
            'visi_misi' => 'nullable|string',
            'kelebihan_kekurangan' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => 'nullable|string|max:255',
            'informed_consent' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        $user = Auth::user();

        // Handle photo upload
        $photoUrl = null;
        if ($request->hasFile('photo')) {
            // $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
            // $photoUrl = Storage::url($photoPath);
            $photoPath = UploadSanitizer::store($request->file('photo'), 'taaruf/photos');
            $photoUrl = Storage::disk('public')->url($photoPath);
        }

        // Handle informed consent upload
        $allowedConsentMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
        ];

        $informedConsentUrl = null;
        if ($request->hasFile('informed_consent')) {

            // $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
            // $informedConsentUrl = Storage::url($consentPath);

            try {
                $consentPath = UploadSanitizer::store(
                    $request->file('informed_consent'),
                    'taaruf/consents',
                    'public',
                    $allowedConsentMimes
                );
            } catch (\RuntimeException $exception) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'informed_consent' => 'Dokumen informed consent harus berupa file PDF, JPG, JPEG, PNG, DOC, atau DOCX.',
                    ]);
            }
            $informedConsentUrl = Storage::disk('public')->url($consentPath);
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
            'visi_misi' => $request->visi_misi,
            'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
            'photo_url' => $photoUrl,
            'instagram' => $request->instagram,
            'informed_consent_url' => $informedConsentUrl,
        ]);

        return redirect()->route('taaruf.questions')
            ->with('success', 'Profil Ta\'aruf berhasil dibuat. Silakan lengkapi pertanyaan berikut.');
    }

    /**
     * Update the taaruf profile
     */
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
            'origin_province' => 'required|string|max:255',
            'origin_city' => 'required|string|max:255',
            'origin_district' => 'required|string|max:255',
            'origin_village' => 'required|string|max:255',
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
            'informed_consent' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return redirect()->route('taaruf.profile.create');
        }

        if ($request->hasFile('photo')) {
            if ($taarufProfile->photo_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
                Storage::disk('public')->delete($oldPath);
            }
            // $photoPath = $request->file('photo')->store('taaruf/photos', 'public');
            // $taarufProfile->photo_url = Storage::url($photoPath);

            $photoPath = UploadSanitizer::store($request->file('photo'), 'taaruf/photos');
            $taarufProfile->photo_url = Storage::disk('public')->url($photoPath);
        } elseif ($request->has('remove_photo') && $request->remove_photo) {
            if ($taarufProfile->photo_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->photo_url);
                Storage::disk('public')->delete($oldPath);
                $taarufProfile->photo_url = null;
            }
        }

        $allowedConsentMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
        ];

        if ($request->hasFile('informed_consent')) {
            if ($taarufProfile->informed_consent_url) {
                $oldPath = str_replace('/storage/', '', $taarufProfile->informed_consent_url);
                Storage::disk('public')->delete($oldPath);
            }
            // $consentPath = $request->file('informed_consent')->store('taaruf/consents', 'public');
            // $taarufProfile->informed_consent_url = Storage::url($consentPath);

            try {
                $consentPath = UploadSanitizer::store(
                    $request->file('informed_consent'),
                    'taaruf/consents',
                    'public',
                    $allowedConsentMimes
                );
            } catch (\RuntimeException $exception) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'informed_consent' => 'Dokumen informed consent harus berupa file PDF, JPG, JPEG, PNG, DOC, atau DOCX.',
                    ]);
            }
            $taarufProfile->informed_consent_url = Storage::disk('public')->url($consentPath);
        }

        $taarufProfile->update([
            'gender' => $request->gender,
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'birth_place_date' => $request->birth_place_date,
            'origin_province' => $request->origin_province,
            'origin_city' => $request->origin_city,
            'origin_district' => $request->origin_district,
            'origin_village' => $request->origin_village,
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

    /**
     * Apply location filter based on type and level
     */
    protected function applyLocationFilter($query, Request $request)
    {
        $locationType = $request->get('location_type', 'origin');
        $locationLevel = $request->get('location_level', 'province');

        $prefix = $locationType === 'residence' ? 'residence_' : 'origin_';

        switch ($locationLevel) {
            case 'province':
                if ($request->filled('location_province')) {
                    $query->where($prefix . 'province', $request->location_province);
                }
                break;

            case 'city':
                if ($request->filled('location_province')) {
                    $query->where($prefix . 'province', $request->location_province);
                }
                if ($request->filled('location_city')) {
                    $query->where($prefix . 'city', $request->location_city);
                }
                break;

            case 'district':
                if ($request->filled('location_province')) {
                    $query->where($prefix . 'province', $request->location_province);
                }
                if ($request->filled('location_city')) {
                    $query->where($prefix . 'city', $request->location_city);
                }
                if ($request->filled('location_district')) {
                    $query->where($prefix . 'district', $request->location_district);
                }
                break;
        }

        return $query;
    }

    /**
     * Get unique locations from database
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
     * Get unique education data for filter options (AJAX endpoint)
     */
    public function getEducationFilterOptions()
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (!$taarufProfile) {
            return response()->json([
                'levels' => [],
                'universities' => [],
                'majors' => []
            ]);
        }

        $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';

        return response()->json([
            'levels' => TaarufProfile::where('gender', $oppositeGender)
                ->where('is_active', true)
                ->distinct()
                ->pluck('education_level')
                ->filter()
                ->sort()
                ->values(),

            'universities' => TaarufProfile::where('gender', $oppositeGender)
                ->where('is_active', true)
                ->get()
                ->map(function ($profile) {
                    return $profile->university ?: $profile->custom_university;
                })
                ->filter()
                ->unique()
                ->sort()
                ->values(),

            'majors' => TaarufProfile::where('gender', $oppositeGender)
                ->where('is_active', true)
                ->distinct()
                ->pluck('major')
                ->filter()
                ->sort()
                ->values()
        ]);
    }

    /**
     * Helper method untuk debugging filter (optional)
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

        if ($request->get('filter') === 'education') {
            \Log::info('Education Filter Applied', [
                'education_filter_type' => $request->get('education_filter_type'),
                'education_level' => $request->get('filter_education_level'),
                'university' => $request->get('filter_university'),
                'major' => $request->get('filter_major'),
            ]);
        }
    }
}
