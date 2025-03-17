<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityGalleryController extends Controller
{
    public function create(Request $request)
    {
        $activity = Activity::findOrFail($request->activity_id);
        return view('admin.activities.gallery.create', compact('activity'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0'
        ]);

        $validated['image_url'] = $request->file('image')->store('gallery', 'public');

        ActivityGallery::create($validated);

        return redirect()
            ->route('admin.activities.edit', $request->activity_id)
            ->with('success', 'Image added successfully.');
    }

    public function edit(ActivityGallery $activityGallery)
    {
        return view('admin.activities.gallery.edit', [
            'gallery' => $activityGallery,
            'activity' => $activityGallery->activity
        ]);
    }

    public function update(Request $request, ActivityGallery $activityGallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'caption' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image only if it exists
            if (!empty($activityGallery->image)) {
                Storage::disk('public')->delete($activityGallery->image);
            }
            // Store the new image
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $activityGallery->update($validated);

        return redirect()
            ->route('admin.activities.edit', $activityGallery->activity_id)
            ->with('success', 'Image updated successfully.');
    }

    public function destroy(ActivityGallery $activityGallery)
    {
        $activity_id = $activityGallery->activity_id;

        // Delete image
        Storage::disk('public')->delete($activityGallery->image_url);

        $activityGallery->delete();

        return redirect()
            ->route('admin.activities.edit', $activity_id)
            ->with('success', 'Image deleted successfully.');
    }
}
