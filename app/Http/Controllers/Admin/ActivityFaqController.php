<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityFaq;
use Illuminate\Http\Request;

class ActivityFaqController extends Controller
{
    public function create(Request $request)
    {
        $activity = Activity::findOrFail($request->activity_id);
        return view('admin.activities.faqs.create', compact('activity'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0'
        ]);

        ActivityFaq::create($validated);

        return redirect()
            ->route('admin.activities.edit', $request->activity_id)
            ->with('success', 'FAQ added successfully.');
    }

    public function edit(ActivityFaq $activityFaq)
    {
        return view('admin.activities.faqs.edit', [
            'faq' => $activityFaq,
            'activity' => $activityFaq->activity
        ]);
    }

    public function update(Request $request, ActivityFaq $activityFaq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0'
        ]);

        $activityFaq->update($validated);

        return redirect()
            ->route('admin.activities.edit', $activityFaq->activity_id)
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(ActivityFaq $activityFaq)
    {
        $activity_id = $activityFaq->activity_id;
        $activityFaq->delete();

        return redirect()
            ->route('admin.activities.edit', $activity_id)
            ->with('success', 'FAQ deleted successfully.');
    }
}
