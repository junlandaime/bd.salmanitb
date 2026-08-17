<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FeedbackReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class FeedbackController extends Controller
{
    /**
     * Determine layout context based on route prefix (peserta or alumni).
     */
    private function getContext(): string
    {
        $routePrefix = request()->route()->getPrefix();
        return str_contains($routePrefix, 'alumni') ? 'alumni' : 'peserta';
    }

    /**
     * List feedback for the authenticated user.
     */
    public function index()
    {
        $feedbacks = Feedback::byUser(Auth::id())
            ->latest()
            ->paginate(15);

        $context = $this->getContext();

        return view("{$context}.feedback.index", compact('feedbacks', 'context'));
    }

    /**
     * Show create feedback form.
     */
    public function create()
    {
        $categories = Feedback::CATEGORIES;
        $context = $this->getContext();

        return view("{$context}.feedback.create", compact('categories', 'context'));
    }

    /**
     * Store a new feedback.
     */
    public function store(Request $request)
    {
        // Rate limit: max 5 feedback per hour per user
        $key = 'feedback-create:' . Auth::id();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withInput()->withErrors([
                'message' => "Anda terlalu sering mengirim feedback. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Feedback::CATEGORIES)),
            'subject'  => 'required|string|max:255',
            'message'  => 'required|string|max:5000',
        ]);

        // Sanitize
        $validated['subject'] = strip_tags($validated['subject']);
        $validated['message'] = strip_tags($validated['message']);
        $validated['user_id'] = Auth::id();

        Feedback::create($validated);

        RateLimiter::hit($key, 3600);

        $context = $this->getContext();

        return redirect()->route("{$context}.feedback.index")
            ->with('success', 'Feedback berhasil dikirim. Terima kasih atas masukan Anda!');
    }

    /**
     * Show feedback detail with discussion thread.
     */
    public function show($id)
    {
        $feedback = Feedback::with(['replies.user', 'user', 'closedBy'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $context = $this->getContext();

        return view("{$context}.feedback.show", compact('feedback', 'context'));
    }

    /**
     * Reply to a feedback (by the user/peserta/alumni).
     */
    public function reply(Request $request, $id)
    {
        $feedback = Feedback::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($feedback->status === 'closed') {
            return back()->with('error', 'Diskusi ini telah ditutup oleh admin. Silakan buat feedback baru jika diperlukan.');
        }

        // Rate limit: max 20 replies per hour
        $key = 'feedback-reply:' . Auth::id();
        if (RateLimiter::tooManyAttempts($key, 20)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'message' => "Terlalu banyak balasan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        FeedbackReply::create([
            'feedback_id' => $feedback->id,
            'user_id'     => Auth::id(),
            'message'     => strip_tags($validated['message']),
            'is_admin'    => false,
        ]);

        // Setiap user membalas, status feedback menjadi 'open' (menunggu jawaban admin)
        $feedback->update(['status' => 'open']);

        RateLimiter::hit($key, 3600);

        $context = $this->getContext();

        return redirect()->route("{$context}.feedback.show", $id)
            ->with('success', 'Balasan berhasil dikirim.');
    }
}
