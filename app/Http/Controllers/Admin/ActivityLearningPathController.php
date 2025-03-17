<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityLearningPath;
use Illuminate\Http\Request;

class ActivityLearningPathController extends Controller
{
    public function create(Request $request)
    {
        $activity = Activity::findOrFail($request->activity_id);
        return view('admin.activities.learning-paths.create', compact('activity'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mentors' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0'
        ]);

        ActivityLearningPath::create($validated);

        return redirect()
            ->route('admin.activities.edit', $request->activity_id)
            ->with('success', 'Learning path added successfully.');
    }

    public function edit(ActivityLearningPath $activityLearningPath)
    {
        return view('admin.activities.learning-paths.edit', [
            'learningPath' => $activityLearningPath,
            'activity' => $activityLearningPath->activity
        ]);
    }

    public function update(Request $request, ActivityLearningPath $activityLearningPath)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mentors' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0'
        ]);

        $activityLearningPath->update($validated);

        return redirect()
            ->route('admin.activities.edit', $activityLearningPath->activity_id)
            ->with('success', 'Learning path updated successfully.');
    }

    public function destroy(ActivityLearningPath $activityLearningPath)
    {
        $activity_id = $activityLearningPath->activity_id;
        $activityLearningPath->delete();

        return redirect()
            ->route('admin.activities.edit', $activity_id)
            ->with('success', 'Learning path deleted successfully.');
    }
}
