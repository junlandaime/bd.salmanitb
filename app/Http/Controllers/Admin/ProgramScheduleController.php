<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramSchedule;
use Illuminate\Http\Request;

class ProgramScheduleController extends Controller
{
    public function create(Request $request)
    {
        $program = Program::findOrFail($request->program_id);
        return view('admin.programs.schedules.create', compact('program'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'day' => 'required|string|max:20',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'type' => 'required|in:regular,special',
        ]);

        ProgramSchedule::create($validated);

        return redirect()
            ->route('admin.programs.edit', $request->program_id)
            ->with('success', 'Schedule created successfully.');
    }

    public function edit(ProgramSchedule $programSchedule)
    {
        $program = $programSchedule->program;
        return view('admin.programs.schedules.edit', compact('programSchedule', 'program'));
    }

    public function update(Request $request, ProgramSchedule $programSchedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'day' => 'required|string|max:20',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'type' => 'required|in:regular,special',
        ]);

        $programSchedule->update($validated);

        return redirect()
            ->route('admin.programs.edit', $programSchedule->program_id)
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(ProgramSchedule $programSchedule)
    {
        $program_id = $programSchedule->program_id;
        $programSchedule->delete();

        return redirect()
            ->route('admin.programs.edit', $program_id)
            ->with('success', 'Schedule deleted successfully.');
    }
}
