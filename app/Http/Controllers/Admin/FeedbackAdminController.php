<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\FeedbackReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackAdminController extends Controller
{
    /**
     * List all feedbacks with filtering.
     */
    public function index(Request $request)
    {
        $query = Feedback::with('user')->latest();

        // Filter by status
        if ($request->filled('status') && in_array($request->status, ['open', 'answered', 'closed'])) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category') && array_key_exists($request->category, Feedback::CATEGORIES)) {
            $query->where('category', $request->category);
        }

        // Search by user name or subject
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $feedbacks = $query->paginate(20)->withQueryString();

        $openCount = Feedback::where('status', 'open')->count();

        $categories = Feedback::CATEGORIES;

        return view('admin.feedback.index', compact('feedbacks', 'openCount', 'categories'));
    }

    /**
     * Show feedback detail with sender info and discussion thread.
     */
    public function show($id)
    {
        $feedback = Feedback::with(['user', 'closedBy', 'replies.user'])
            ->findOrFail($id);

        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Admin replies to a feedback.
     */
    public function reply(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->status === 'closed') {
            return back()->with('error', 'Diskusi ini sudah ditutup. Buka kembali jika ingin membalas.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        FeedbackReply::create([
            'feedback_id' => $feedback->id,
            'user_id'     => Auth::id(),
            'message'     => strip_tags($validated['message']),
            'is_admin'    => true,
        ]);

        $feedback->update(['status' => 'answered']);

        return redirect()->route('admin.feedback.show', $id)
            ->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Close a feedback discussion.
     */
    public function close($id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->update([
            'status'    => 'closed',
            'closed_by' => Auth::id(),
            'closed_at' => now(),
        ]);

        return redirect()->route('admin.feedback.show', $id)
            ->with('success', 'Diskusi feedback berhasil ditutup.');
    }

    /**
     * Reopen a closed feedback.
     */
    public function reopen($id)
    {
        $feedback = Feedback::findOrFail($id);

        // Tentukan status berdasarkan pengirim pesan terakhir:
        // Jika balasan terakhir dari admin -> 'answered'
        // Jika belum pernah dibalas atau balasan terakhir dari user -> 'open'
        $lastReply = $feedback->replies()->latest()->first();
        $newStatus = ($lastReply && $lastReply->is_admin) ? 'answered' : 'open';

        $feedback->update([
            'status'    => $newStatus,
            'closed_by' => null,
            'closed_at' => null,
        ]);

        return redirect()->route('admin.feedback.show', $id)
            ->with('success', 'Diskusi feedback dibuka kembali.');
    }

    /**
     * Soft delete a feedback.
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete(); // soft delete

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }
}
