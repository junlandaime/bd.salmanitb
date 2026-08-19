<?php

namespace App\Http\Controllers;

use App\Models\TaarufProfile;
use App\Models\TaarufQuestion;
use App\Helpers\DateHelper;
use App\Support\UploadSanitizer;
use App\Http\Requests\StoreTaarufProfileRequest;
use App\Http\Requests\UpdateTaarufProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaarufController extends Controller
{
    // =========================================================================
    // Dashboard & Navigation
    // =========================================================================

    /**
     * Show taaruf dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        $needsProfileUpdate = false;
        $needsBirthDateWarning = false;
        $missingFields = [];

        if ($taarufProfile) {
            $missingFields = $this->getMissingFields($taarufProfile);
            $needsProfileUpdate = count($missingFields) > 0;

            if (empty($taarufProfile->birth_place_date) || DateHelper::getAgeFromBirthPlaceDate($taarufProfile->birth_place_date) === null) {
                $needsBirthDateWarning = true;
            }
        }

        $unreadQuestionsCount = $this->getUnreadQuestionsCount($user, $taarufProfile);

        return view('taaruf.index', compact(
            'taarufProfile',
            'needsProfileUpdate',
            'needsBirthDateWarning',
            'missingFields',
            'unreadQuestionsCount'
        ));
    }

    /**
     * Show terms and conditions for taaruf.
     */
    public function showTerms()
    {
        return view('taaruf.terms');
    }

    /**
     * Accept terms and proceed to profile form.
     */
    public function acceptTerms()
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if ($taarufProfile) {
            $taarufProfile->update(['is_active' => true]);
            return redirect()->route('taaruf.questions');
        }

        return redirect()->route('taaruf.profile.create');
    }

    // =========================================================================
    // Profile CRUD
    // =========================================================================

    /**
     * Show the form for creating a new taaruf profile.
     * Auto-fills form with SPN registration data if available.
     */
    public function createProfile()
    {
        $user = Auth::user();

        if ($user->taarufProfile) {
            return redirect()->route('taaruf.profile.edit');
        }

        // Auto-fill from SPN Registration data if available
        $prefill = [];
        $spnReg = \App\Models\SpnRegistration::where('user_id', $user->id)
            ->where('status', 'terverifikasi')
            ->latest()
            ->first();

        if ($spnReg) {
            // Map gender values
            $genderMap = ['pria' => 'male', 'wanita' => 'female'];

            // Map pendidikan to education_level
            $educationMap = [
                'sma' => 'SMA/SMK',
                'd3' => 'D3',
                's1' => 'S1',
                's2' => 'S2',
                's3' => 'S3',
            ];

            $prefill = [
                'full_name'         => $spnReg->nama_lengkap,
                'nickname'          => $spnReg->nama_panggilan,
                'gender'            => $genderMap[$spnReg->jenis_kelamin] ?? '',
                'current_residence' => $spnReg->domisili,
                'occupation'        => $spnReg->pekerjaan,
                'university'        => $spnReg->universitas,
                'major'             => $spnReg->jurusan,
                'instagram'         => $spnReg->instagram,
                'education_level'   => $educationMap[$spnReg->pendidikan] ?? '',
                'last_education'    => ($educationMap[$spnReg->pendidikan] ?? '') . ($spnReg->jurusan ? ' ' . $spnReg->jurusan : '') . ($spnReg->universitas ? ' ' . $spnReg->universitas : ''),
            ];
        }

        return view('taaruf.profile.create', compact('prefill'));
    }

    /**
     * Store a newly created taaruf profile.
     */
    public function storeProfile(StoreTaarufProfileRequest $request)
    {
        $user = Auth::user();

        if ($user->taarufProfile()->exists()) {
            return redirect()->route('taaruf.profile.edit')
                ->with('error', 'Profil Ta\'aruf Anda sudah ada. Silakan perbarui profil tersebut.');
        }

        $photoUrl = $this->handlePhotoUpload($request);
        $informedConsentUrl = $this->handleConsentUpload($request);

        if ($informedConsentUrl === false) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'informed_consent' => 'Dokumen informed consent harus berupa file PDF, JPG, JPEG, PNG, DOC, atau DOCX.',
                ]);
        }

        TaarufProfile::create([
            'user_id'              => $user->id,
            'is_active'            => true,
            'gender'               => $request->gender,
            'full_name'            => $request->full_name,
            'nickname'             => $request->nickname,
            'birth_place_date'     => $request->birth_place_date,
            'current_residence'    => $request->current_residence,
            'last_education'       => $request->last_education,
            'occupation'           => $request->occupation,
            'marriage_target_year' => $request->marriage_target_year,
            'personality'          => $request->personality,
            'expectation'          => $request->expectation,
            'ideal_partner_criteria' => $request->ideal_partner_criteria,
            'visi_misi'            => $request->visi_misi,
            'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
            'photo_url'            => $photoUrl,
            'instagram'            => $request->instagram,
            'informed_consent_url' => $informedConsentUrl,
        ]);

        return redirect()->route('taaruf.questions')
            ->with('success', 'Profil Ta\'aruf berhasil dibuat. Silakan lengkapi pertanyaan berikut.');
    }

    /**
     * Show the form for editing the taaruf profile.
     */
    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->taarufProfile;

        if (! $profile) {
            return redirect()->route('taaruf.profile.create');
        }

        return view('taaruf.profile.edit', compact('profile'));
    }

    /**
     * Update the taaruf profile.
     */
    public function updateProfile(UpdateTaarufProfileRequest $request)
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (! $taarufProfile) {
            return redirect()->route('taaruf.profile.create');
        }

        // Handle photo upload/removal
        $this->handlePhotoUpdate($request, $taarufProfile);

        // Handle informed consent upload
        $consentResult = $this->handleConsentUpdate($request, $taarufProfile);
        if ($consentResult === false) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'informed_consent' => 'Dokumen informed consent harus berupa file PDF, JPG, JPEG, PNG, DOC, atau DOCX.',
                ]);
        }

        $taarufProfile->update([
            'gender'               => $request->gender,
            'full_name'            => $request->full_name,
            'nickname'             => $request->nickname,
            'birth_place_date'     => $request->birth_place_date,
            'origin_province'      => $request->origin_province,
            'origin_city'          => $request->origin_city,
            'origin_district'      => $request->origin_district,
            'origin_village'       => $request->origin_village,
            'current_residence'    => $request->current_residence,
            'residence_province'   => $request->residence_province,
            'residence_city'       => $request->residence_city,
            'residence_district'   => $request->residence_district,
            'residence_village'    => $request->residence_village,
            'last_education'       => $request->last_education,
            'education_level'      => $request->education_level,
            'university'           => $request->university,
            'custom_university'    => $request->custom_university,
            'major'                => $request->major,
            'occupation'           => $request->occupation,
            'marriage_target_year' => $request->marriage_target_year,
            'personality'          => $request->personality,
            'expectation'          => $request->expectation,
            'ideal_partner_criteria' => $request->ideal_partner_criteria,
            'visi_misi'            => $request->visi_misi,
            'kelebihan_kekurangan' => $request->kelebihan_kekurangan,
            'instagram'            => $request->instagram,
            'photo_url'            => $taarufProfile->photo_url,
        ]);

        return redirect()->route('taaruf.profile.edit')
            ->with('success', 'Profil Ta\'aruf berhasil diperbarui.');
    }

    /**
     * Toggle taaruf profile active status.
     */
    public function toggleActive()
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (! $taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        $taarufProfile->update(['is_active' => ! $taarufProfile->is_active]);

        $status = $taarufProfile->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('taaruf.index')
            ->with('success', "Profil Ta'aruf Anda berhasil {$status}.");
    }

    // =========================================================================
    // Questions
    // =========================================================================

    /**
     * Show questions form.
     */
    public function showQuestions()
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (! $taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        return view('taaruf.questions', compact('taarufProfile'));
    }

    /**
     * Save answers to questions.
     */
    public function saveQuestions(Request $request)
    {
        $request->validate([
            'is_in_taaruf_process' => 'required|boolean',
            'is_smoker'            => 'required|boolean',
            'is_polygamy_intended' => 'required|boolean',
            'has_debt'             => 'required|boolean',
            'has_dependents'       => 'required|boolean',
        ]);

        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (! $taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        $taarufProfile->update($request->only([
            'is_in_taaruf_process',
            'is_smoker',
            'is_polygamy_intended',
            'has_debt',
            'has_dependents',
        ]));

        return redirect()->route('taaruf.list')
            ->with('success', 'Jawaban berhasil disimpan.');
    }

    // =========================================================================
    // Browse & View Profiles
    // =========================================================================

    /**
     * Show list of alumni who are open for taaruf.
     */
    public function showList(Request $request)
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (! $taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        if (! $taarufProfile->is_active) {
            return redirect()->route('taaruf.index')
                ->with('error', 'Anda harus mengaktifkan profil Ta\'aruf terlebih dahulu.');
        }

        $perPage = $this->resolvePerPage($request);
        $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';

        $query = TaarufProfile::where('taaruf_profiles.gender', $oppositeGender)
            ->where('taaruf_profiles.is_active', true);

        // Search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('taaruf_profiles.full_name', 'like', '%' . $search . '%')
                    ->orWhere('taaruf_profiles.nickname', 'like', '%' . $search . '%');
            });
        }

        // Apply filters
        $filter = $request->get('filter', 'all');

        if ($filter === 'education') {
            $this->applyEducationFilter($query, $request);
        } elseif ($filter === 'location') {
            $this->applyLocationFilter($query, $request);
        } elseif ($filter === 'marriage_year' && $request->filled('marriage_year')) {
            $query->where('taaruf_profiles.marriage_target_year', $request->marriage_year);
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

        // Dynamic Sorting (Default: Recently Active / Baru Saja Aktif)
        $sort = $request->get('sort', 'recently_active');
        $query->with(['user', 'user.batchAlumni.activityBatch']);

        if ($sort === 'newest') {
            $query->orderBy('taaruf_profiles.created_at', 'desc');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('taaruf_profiles.full_name', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('taaruf_profiles.full_name', 'desc');
        } elseif ($sort === 'marriage_target') {
            $query->orderByRaw("CASE WHEN taaruf_profiles.marriage_target_year IS NULL OR taaruf_profiles.marriage_target_year = '' THEN 1 ELSE 0 END, taaruf_profiles.marriage_target_year ASC");
        } else {
            // 'recently_active' (Default) - prioritize users who logged in or updated their profile recently
            $query->leftJoin('users', 'taaruf_profiles.user_id', '=', 'users.id')
                ->select('taaruf_profiles.*')
                ->orderByRaw('COALESCE(users.last_login_at, taaruf_profiles.updated_at, taaruf_profiles.created_at) DESC');
        }

        $profiles = $query->paginate($perPage)
            ->appends($request->except('page'));

        $myProfile = $taarufProfile;
        $view = $request->get('view', 'card');

        return view('taaruf.list', compact(
            'profiles',
            'myProfile',
            'educations',
            'view',
            'sort'
        ));
    }

    /**
     * Show a specific taaruf profile.
     */
    public function showProfile($id)
    {
        $user = Auth::user();
        $userProfile = $user->taarufProfile;

        if (! $userProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        if (! $userProfile->is_active) {
            return redirect()->route('taaruf.index')
                ->with('error', 'Anda harus mengaktifkan profil Ta\'aruf terlebih dahulu.');
        }

        $profile = TaarufProfile::findOrFail($id);

        if ($profile->gender === $userProfile->gender) {
            return redirect()->route('taaruf.list')
                ->with('error', 'Anda hanya dapat melihat profil lawan jenis.');
        }

        if (! $profile->is_active) {
            return redirect()->route('taaruf.list')
                ->with('error', 'Profil yang Anda cari tidak aktif.');
        }

        return view('taaruf.profile.show', compact('profile'));
    }

    // =========================================================================
    // AJAX Endpoints
    // =========================================================================

    /**
     * Get unique education data for filter options.
     */
    public function getEducationFilterOptions()
    {
        $user = Auth::user();
        $taarufProfile = $user->taarufProfile;

        if (! $taarufProfile) {
            return response()->json(['levels' => [], 'universities' => [], 'majors' => []]);
        }

        $oppositeGender = $taarufProfile->gender === 'male' ? 'female' : 'male';
        $baseQuery = TaarufProfile::where('gender', $oppositeGender)->where('is_active', true);

        return response()->json([
            'levels' => (clone $baseQuery)->distinct()->pluck('education_level')->filter()->sort()->values(),
            'universities' => (clone $baseQuery)->get()->map(fn ($p) => $p->university ?: $p->custom_university)->filter()->unique()->sort()->values(),
            'majors' => (clone $baseQuery)->distinct()->pluck('major')->filter()->sort()->values(),
        ]);
    }

    // =========================================================================
    // Private Helpers
    // =========================================================================

    /**
     * Get list of missing profile fields.
     */
    private function getMissingFields(TaarufProfile $profile): array
    {
        $missingFields = [];

        $requiredFields = [
            'visi_misi'          => 'Kriteria Pasangan',
            'kelebihan_kekurangan' => 'Kelebihan & Kekurangan',
            'origin_province'    => 'Provinsi Asal',
            'origin_city'        => 'Kota/Kabupaten Asal',
            'origin_district'    => 'Kecamatan Asal',
            'origin_village'     => 'Kelurahan Asal',
            'residence_province' => 'Provinsi Domisili',
            'residence_city'     => 'Kota/Kabupaten Domisili',
            'residence_district' => 'Kecamatan Domisili',
            'residence_village'  => 'Kelurahan Domisili',
            'education_level'    => 'Strata Pendidikan Terakhir',
            'university'         => 'Nama Institusi/Kampus',
        ];

        foreach ($requiredFields as $field => $label) {
            if (empty($profile->$field)) {
                $missingFields[] = $label;
            }
        }

        // Birth date format check
        if (empty($profile->birth_place_date) || DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) === null) {
            $missingFields[] = 'Tempat & Tanggal Lahir (format: Kota, 4 Oktober 1995)';
        }

        // Custom university check
        if ($profile->university === 'Lainnya' && empty($profile->custom_university)) {
            $missingFields[] = 'Nama Kampus Lainnya (Custom)';
        }

        // Major required for higher education
        $highEducationLevels = ['D3', 'D4', 'S1', 'S2', 'S3'];
        if (! empty($profile->education_level) && in_array($profile->education_level, $highEducationLevels) && empty($profile->major)) {
            $missingFields[] = 'Jurusan/Program Studi';
        }

        return $missingFields;
    }

    /**
     * Get count of unread taaruf questions.
     */
    private function getUnreadQuestionsCount($user, ?TaarufProfile $profile): int
    {
        if (! $profile) {
            return 0;
        }

        $unreadCount = $user->unreadNotifications()
            ->where('type', 'App\Notifications\NewTaarufQuestion')
            ->count();

        $unansweredCount = TaarufQuestion::where('profile_id', $profile->id)
            ->where('is_answered', false)
            ->count();

        return ($unansweredCount > 0 && $unreadCount == 0) ? $unansweredCount : $unreadCount;
    }

    /**
     * Resolve per page value from request.
     */
    private function resolvePerPage(Request $request): int
    {
        $allowedPerPage = [10, 12, 25, 50, 100];
        $perPage = (int) $request->query('per_page', 12);

        return in_array($perPage, $allowedPerPage, true) ? $perPage : 12;
    }

    /**
     * Apply education filter to query.
     */
    private function applyEducationFilter($query, Request $request): void
    {
        $filterType = $request->get('education_filter_type', 'strata');

        // Apply education level filter when applicable
        $strataTypes = ['strata', 'strata_university', 'strata_major', 'full'];
        if (in_array($filterType, $strataTypes) && $request->filled('filter_education_level')) {
            $query->where('taaruf_profiles.education_level', $request->filter_education_level);
        }

        // Apply university filter when applicable
        $universityTypes = ['university', 'strata_university', 'full'];
        if (in_array($filterType, $universityTypes) && $request->filled('filter_university')) {
            $query->where(function ($q) use ($request) {
                $q->where('taaruf_profiles.university', $request->filter_university)
                    ->orWhere('taaruf_profiles.custom_university', $request->filter_university);
            });
        }

        // Apply major filter when applicable
        $majorTypes = ['major', 'strata_major', 'full'];
        if (in_array($filterType, $majorTypes) && $request->filled('filter_major')) {
            $query->where('taaruf_profiles.major', 'like', '%' . $request->filter_major . '%');
        }
    }

    /**
     * Apply location filter based on type and level.
     */
    private function applyLocationFilter($query, Request $request): void
    {
        $locationType = $request->get('location_type', 'origin');
        $locationLevel = $request->get('location_level', 'province');
        $prefix = $locationType === 'residence' ? 'residence_' : 'origin_';

        $levels = ['province', 'city', 'district'];
        $levelIndex = array_search($locationLevel, $levels);

        // Apply filters cascading: province → city → district
        foreach ($levels as $i => $level) {
            if ($i > $levelIndex) {
                break;
            }

            $paramName = 'location_' . $level;
            if ($request->filled($paramName)) {
                $query->where('taaruf_profiles.' . $prefix . $level, $request->get($paramName));
            }
        }
    }

    /**
     * Handle photo upload for new profile.
     */
    private function handlePhotoUpload(Request $request): ?string
    {
        if (! $request->hasFile('photo')) {
            return null;
        }

        $photoPath = UploadSanitizer::store($request->file('photo'), 'taaruf/photos');
        return Storage::disk('public')->url($photoPath);
    }

    /**
     * Handle informed consent upload for new profile. Returns false on failure.
     */
    private function handleConsentUpload(Request $request): string|false|null
    {
        if (! $request->hasFile('informed_consent')) {
            return null;
        }

        $allowedMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
        ];

        try {
            $consentPath = UploadSanitizer::store(
                $request->file('informed_consent'),
                'taaruf/consents',
                'public',
                $allowedMimes
            );
        } catch (\RuntimeException $exception) {
            return false;
        }

        return Storage::disk('public')->url($consentPath);
    }

    /**
     * Handle photo update/removal for existing profile.
     */
    private function handlePhotoUpdate(Request $request, TaarufProfile $profile): void
    {
        if ($request->hasFile('photo')) {
            $this->deleteOldFile($profile->photo_url);
            $photoPath = UploadSanitizer::store($request->file('photo'), 'taaruf/photos');
            $profile->photo_url = Storage::disk('public')->url($photoPath);
        } elseif ($request->has('remove_photo') && $request->remove_photo) {
            $this->deleteOldFile($profile->photo_url);
            $profile->photo_url = null;
        }
    }

    /**
     * Handle informed consent update for existing profile. Returns false on failure.
     */
    private function handleConsentUpdate(Request $request, TaarufProfile $profile): bool
    {
        if (! $request->hasFile('informed_consent')) {
            return true;
        }

        $this->deleteOldFile($profile->informed_consent_url);

        $allowedMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
        ];

        try {
            $consentPath = UploadSanitizer::store(
                $request->file('informed_consent'),
                'taaruf/consents',
                'public',
                $allowedMimes
            );
        } catch (\RuntimeException $exception) {
            return false;
        }

        $profile->informed_consent_url = Storage::disk('public')->url($consentPath);
        return true;
    }

    /**
     * Delete an old uploaded file by its public URL.
     */
    private function deleteOldFile(?string $url): void
    {
        if ($url) {
            $path = str_replace('/storage/', '', $url);
            Storage::disk('public')->delete($path);
        }
    }
}
