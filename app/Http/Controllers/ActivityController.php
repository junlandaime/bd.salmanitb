<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['program', 'learningPath', 'highlights'])
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('activities.index', compact('activities'));
    }

    public function show($slug)
    {
        $activity = Activity::with(['program', 'learningPath', 'highlights', 'testimonials', 'gallery', 'faqs'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $activeBatch = $activity->getActiveBatch();
        $upcomingBatches = $activity->getUpcomingBatches();

        return view('activities.show', compact('activity', 'activeBatch', 'upcomingBatches'));
    }
}
