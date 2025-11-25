<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use App\Support\UploadSanitizer;

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
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0'
        ]);

        $validated['image'] = $request->file('image')->store('gallery', 'public');

        // $validated['image_url'] = UploadSanitizer::store($request->file('image'), 'gallery');
        // unset($validated['image']);

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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image only if it exists
            if (!empty($activityGallery->image)) {
                Storage::disk('public')->delete($activityGallery->image);
                // if (!empty($activityGallery->image_url)) {
                //     Storage::disk('public')->delete($activityGallery->image_url);
            }
            // Store the new image
            $validated['image'] = $request->file('image')->store('gallery', 'public');

            // $validated['image_url'] = UploadSanitizer::store($request->file('image'), 'gallery');
        }

        // unset($validated['image']);

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
