<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityHighlight;
use Illuminate\Http\Request;

class ActivityHighlightController extends Controller
{
    public function create(Request $request)
    {
        $activity = Activity::findOrFail($request->activity_id);
        return view('admin.activities.highlights.create', compact('activity'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer|min:0'
        ]);

        ActivityHighlight::create($validated);

        return redirect()
            ->route('admin.activities.edit', $request->activity_id)
            ->with('success', 'Highlight added successfully.');
    }

    public function edit(ActivityHighlight $activityHighlight)
    {
        return view('admin.activities.highlights.edit', [
            'highlight' => $activityHighlight,
            'activity' => $activityHighlight->activity
        ]);
    }

    public function update(Request $request, ActivityHighlight $activityHighlight)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer|min:0'
        ]);

        $activityHighlight->update($validated);

        return redirect()
            ->route('admin.activities.edit', $activityHighlight->activity_id)
            ->with('success', 'Highlight updated successfully.');
    }

    public function destroy(ActivityHighlight $activityHighlight)
    {
        $activity_id = $activityHighlight->activity_id;
        $activityHighlight->delete();

        return redirect()
            ->route('admin.activities.edit', $activity_id)
            ->with('success', 'Highlight deleted successfully.');
    }
}
