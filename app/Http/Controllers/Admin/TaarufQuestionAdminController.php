<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaarufQuestion;
use App\Models\TaarufProfile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Exceptions\UnauthorizedException;

class TaarufQuestionAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'permission:manage taaruf']);
    // }

    /**
     * Display a listing of all questions.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage taaruf')) {
        //     throw UnauthorizedException::forPermissions(['manage taaruf']);
        // }

        // $query = TaarufQuestion::with(['profile', 'profile.user', 'askedBy']);

        $baseQuestionQuery = TaarufQuestion::query();

        $profileIds = (clone $baseQuestionQuery)->select('profile_id')->distinct()->pluck('profile_id');
        $profiles = $profileIds->isNotEmpty()
            ? TaarufProfile::whereIn('id', $profileIds)->orderBy('full_name')->get(['id', 'full_name'])
            : collect();

        $askerIds = (clone $baseQuestionQuery)->whereNotNull('asked_by_user_id')->select('asked_by_user_id')->distinct()->pluck('asked_by_user_id');
        $askers = $askerIds->isNotEmpty()
            ? User::whereIn('id', $askerIds)
            ->with('taarufProfile')
            ->orderBy('name')
            ->get()
            : collect();

        $query = TaarufQuestion::with(['profile', 'profile.user', 'askedBy', 'askedBy.taarufProfile']);

        // Filter by profile if requested
        // if ($request->has('profile_id')) {
        if ($request->filled('profile_id')) {
            $query->where('profile_id', $request->profile_id);
        }

        // Filter by asker if requested
        if ($request->filled('asked_by_user_id')) {
            $query->where('asked_by_user_id', $request->asked_by_user_id);
        }


        // Filter by answered status if requested
        // if ($request->has('answered')) {
        if ($request->filled('answered') && in_array($request->answered, ['0', '1'], true)) {
            $isAnswered = $request->answered === '1';
            $query->where('is_answered', $isAnswered);
        }

        // $questions = $query->latest()->paginate(15);
        $perPage = (int) $request->input('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100], true) ? $perPage : 10;

        $questions = $query->latest()->paginate($perPage)->appends($request->query());

        // return View::make('admin.taaruf.questions.index', compact('questions'));
        return View::make('admin.taaruf.questions.index', compact('questions', 'profiles', 'askers', 'perPage'));
    }

    /**
     * Show a specific question.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage taaruf')) {
        //     throw UnauthorizedException::forPermissions(['manage taaruf']);
        // }

        $question = TaarufQuestion::with(['profile', 'profile.user', 'askedBy'])->findOrFail($id);

        return View::make('admin.taaruf.questions.show', compact('question'));
    }

    /**
     * Delete a question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage taaruf')) {
        //     throw UnauthorizedException::forPermissions(['manage taaruf']);
        // }

        $question = TaarufQuestion::findOrFail($id);
        $question->delete();

        return Redirect::route('admin.taaruf.questions.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
