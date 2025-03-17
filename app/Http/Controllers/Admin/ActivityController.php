<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Middleware\RoleMiddleware;

class ActivityController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(new RoleMiddleware('admin'));
    // }

    public function index()
    {
        $activities = Activity::with(['program', 'learningPath', 'highlights', 'testimonials', 'gallery', 'faqs', 'batches'])
            ->latest()
            ->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        $activity->load('batches');
        return view('admin.activities.show', compact('activity'));
    }


    public function create()
    {
        $programs = Program::all();
        return view('admin.activities.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'overview' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',

            // Learning Path
            'learning_paths' => 'array',
            'learning_paths.*.title' => 'required|string',
            'learning_paths.*.description' => 'required|string',
            'learning_paths.*.mentors' => 'required|string',
            'learning_paths.*.order' => 'required|integer',

            // Highlights
            'highlights' => 'array',
            'highlights.*.title' => 'required|string',
            'highlights.*.description' => 'required|string',
            'highlights.*.icon' => 'required|string',

            // FAQs
            'faqs' => 'array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
            'faqs.*.order' => 'required|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('activities', 'public');
            $validated['featured_image'] = $path;
        }

        $activity = Activity::create($validated);

        // Create Learning Paths
        if (isset($validated['learning_paths'])) {
            foreach ($validated['learning_paths'] as $path) {
                $activity->learningPath()->create($path);
            }
        }

        // Create Highlights
        if (isset($validated['highlights'])) {
            foreach ($validated['highlights'] as $highlight) {
                $activity->highlights()->create($highlight);
            }
        }

        // Create FAQs
        if (isset($validated['faqs'])) {
            foreach ($validated['faqs'] as $faq) {
                $activity->faqs()->create($faq);
            }
        }

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity)
    {
        $activity->load(['program', 'learningPath', 'highlights', 'testimonials', 'gallery', 'faqs']);
        $programs = Program::all();
        return view('admin.activities.edit', compact('activity', 'programs'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'overview' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',

            // Learning Path
            'learning_paths' => 'array',
            'learning_paths.*.title' => 'required|string',
            'learning_paths.*.description' => 'required|string',
            'learning_paths.*.mentors' => 'required|string',
            'learning_paths.*.order' => 'required|integer',

            // Highlights
            'highlights' => 'array',
            'highlights.*.title' => 'required|string',
            'highlights.*.description' => 'required|string',
            'highlights.*.icon' => 'required|string',

            // FAQs
            'faqs' => 'array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
            'faqs.*.order' => 'required|integer',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('activities', 'public');
            $validated['featured_image'] = $path;
        }

        $activity->update($validated);

        // Update Learning Paths
        if (isset($validated['learning_paths'])) {
            $activity->learningPath()->delete();
            foreach ($validated['learning_paths'] as $path) {
                $activity->learningPath()->create($path);
            }
        }

        // Update Highlights
        if (isset($validated['highlights'])) {
            $activity->highlights()->delete();
            foreach ($validated['highlights'] as $highlight) {
                $activity->highlights()->create($highlight);
            }
        }

        // Update FAQs
        if (isset($validated['faqs'])) {
            $activity->faqs()->delete();
            foreach ($validated['faqs'] as $faq) {
                $activity->faqs()->create($faq);
            }
        }

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully.');
    }
}
