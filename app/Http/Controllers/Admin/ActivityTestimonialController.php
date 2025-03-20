<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\ActivityTestimonial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ActivityTestimonialController extends Controller
{
    public function create(Request $request)
    {
        $activity = Activity::findOrFail($request->activity_id);
        return view('admin.activities.testimonials.create', compact('activity'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        ActivityTestimonial::create($validated);

        return redirect()
            ->route('admin.activities.edit', $request->activity_id)
            ->with('success', 'Testimonial added successfully.');
    }

    public function edit(ActivityTestimonial $activityTestimonial)
    {
        return view('admin.activities.testimonials.edit', [
            'testimonial' => $activityTestimonial,
            'activity' => $activityTestimonial->activity
        ]);
    }

    public function update(Request $request, ActivityTestimonial $activityTestimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($activityTestimonial->image) {
                Storage::disk('public')->delete($activityTestimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $activityTestimonial->update($validated);

        return redirect()
            ->route('admin.activities.edit', $activityTestimonial->activity_id)
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(ActivityTestimonial $activityTestimonial)
    {
        $activity_id = $activityTestimonial->activity_id;

        // Delete image if exists
        if ($activityTestimonial->image) {
            Storage::disk('public')->delete($activityTestimonial->image);
        }

        $activityTestimonial->delete();

        return redirect()
            ->route('admin.activities.edit', $activity_id)
            ->with('success', 'Testimonial deleted successfully.');
    }
}
