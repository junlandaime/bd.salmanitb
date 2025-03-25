<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaarufQuestion;
use App\Models\TaarufProfile;
use Illuminate\Http\Request;
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

        $query = TaarufQuestion::with(['profile', 'profile.user', 'askedBy']);

        // Filter by profile if requested
        if ($request->has('profile_id')) {
            $query->where('profile_id', $request->profile_id);
        }

        // Filter by answered status if requested
        if ($request->has('answered')) {
            $isAnswered = $request->answered === '1';
            $query->where('is_answered', $isAnswered);
        }

        $questions = $query->latest()->paginate(15);

        return View::make('admin.taaruf.questions.index', compact('questions'));
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
