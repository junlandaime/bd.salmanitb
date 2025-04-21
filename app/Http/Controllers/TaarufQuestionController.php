<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TaarufProfile;
use App\Models\TaarufQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Notifications\NewTaarufQuestion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TaarufQuestionAnswered;

class TaarufQuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Store a new question for a taaruf profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:500',
            'is_anonymous' => 'sometimes|boolean',
        ]);

        // Find the profile
        $profile = TaarufProfile::findOrFail($id);

        // Check if the user is trying to ask a question to their own profile
        if ($profile->user_id === Auth::id()) {
            return Redirect::back()->with('error', 'Anda tidak dapat mengajukan pertanyaan pada profil Anda sendiri.');
        }

        // Create the question
        $question = TaarufQuestion::create([
            'profile_id' => $profile->id,
            'asked_by_user_id' => Auth::id(),
            'question' => $request->question,
            'is_anonymous' => true,
            'is_answered' => false,
        ]);


        // Send notification to profile owner
        $profileOwner = User::findOrFail($profile->user_id);
        $profileOwner->notify(new NewTaarufQuestion($question));

        return Redirect::back()->with('success', 'Pertanyaan berhasil dikirim. Pemilik profil akan menjawab pertanyaan Anda jika berkenan.');
    }

    /**
     * Display a listing of the questions for the authenticated user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the authenticated user's profile
        $profile = TaarufProfile::query()->where('user_id', Auth::id())->first();

        if (!$profile) {
            return Redirect::route('taaruf.index')->with('error', 'Anda belum memiliki profil Ta\'aruf.');
        }

        // Get all questions for the profile (questions received)
        $questions = TaarufQuestion::query()->where('profile_id', $profile->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get all questions asked by the user (questions sent)
        $myQuestions = TaarufQuestion::query()->where('asked_by_user_id', Auth::id())
            ->with('profile.user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Mark notifications as read
        Auth::user()->unreadNotifications()
            ->where('type', 'App\Notifications\NewTaarufQuestion')
            ->get()
            ->each(function ($notification) use ($profile) {
                if ($notification->data['profile_id'] == $profile->id) {
                    $notification->markAsRead();
                }
            });


        return View::make('taaruf.questions.index', compact('questions', 'myQuestions'));
    }

    /**
     * Answer a question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'answer' => 'required|string|max:1000',
            'is_public' => 'sometimes|boolean',
        ]);

        // Find the question
        $question = TaarufQuestion::findOrFail($id);

        // Check if the user owns the profile
        $profile = TaarufProfile::findOrFail($question->profile_id);
        if ($profile->user_id !== Auth::id()) {
            return Redirect::route('taaruf.questions.index')->with('error', 'Anda tidak memiliki izin untuk menjawab pertanyaan ini.');
        }

        // Update the question
        $question->update([
            'answer' => $request->answer,
            'is_answered' => true,
            'is_public' => $request->has('is_public') ? true : false,
        ]);


        // Send notification to the user who asked the question
        // $asker = User::find($question->user_id);
        // $asker->notify(new TaarufQuestionAnswered($question));

        $asker = User::find($question->user_id);
        if ($asker) {
            $asker->notify(new TaarufQuestionAnswered($question));
        }
        return Redirect::route('taaruf.questions.index')->with('success', 'Pertanyaan berhasil dijawab.');
    }


    /**
     * Toggle the public status of a question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePublic($id)
    {
        // Find the question
        $question = TaarufQuestion::findOrFail($id);

        // Check if the user owns the profile
        $profile = TaarufProfile::findOrFail($question->profile_id);
        if ($profile->user_id !== Auth::id()) {
            return Redirect::route('taaruf.questions.index')->with('error', 'Anda tidak memiliki izin untuk mengubah status pertanyaan ini.');
        }

        // Toggle the public status
        $question->update([
            'is_public' => !$question->is_public,
        ]);

        return Redirect::route('taaruf.questions.index')->with('success', 'Status pertanyaan berhasil diubah.');
    }

    /**
     * Remove the specified question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the question
        $question = TaarufQuestion::findOrFail($id);

        // Check if the user owns the profile
        $profile = TaarufProfile::findOrFail($question->profile_id);
        if ($profile->user_id !== Auth::id()) {
            return Redirect::route('taaruf.questions.index')->with('error', 'Anda tidak memiliki izin untuk menghapus pertanyaan ini.');
        }

        // Delete the question
        $question->delete();

        return Redirect::back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
