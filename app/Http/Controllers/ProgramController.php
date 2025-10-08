<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('activities')->get();
        $featuredActivities = Activity::with('program')
            ->where('is_featured', true)
            ->where('status', 'published')
            ->take(6)
            ->get();

        return view('programs.index', compact('programs', 'featuredActivities'));
    }

    public function show($slug)
    {
        $program = Program::with([
            'topics',
            'schedules',
            'activities' => fn($q) => $q->where('status', 'published')->latest(),
        ])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('programs.show', compact('program'));
    }
}
