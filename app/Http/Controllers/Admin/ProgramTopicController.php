<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramTopic;
use Illuminate\Http\Request;

class ProgramTopicController extends Controller
{
    public function create(Request $request)
    {
        $program = Program::findOrFail($request->program_id);
        return view('admin.programs.topics.create', compact('program'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        ProgramTopic::create($validated);

        return redirect()
            ->route('admin.programs.edit', $request->program_id)
            ->with('success', 'Topic created successfully.');
    }

    public function edit(ProgramTopic $programTopic)
    {
        $program = $programTopic->program;
        return view('admin.programs.topics.edit', compact('programTopic', 'program'));
    }

    public function update(Request $request, ProgramTopic $programTopic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        $programTopic->update($validated);

        return redirect()
            ->route('admin.programs.edit', $programTopic->program_id)
            ->with('success', 'Topic updated successfully.');
    }

    public function destroy(ProgramTopic $programTopic)
    {
        $program_id = $programTopic->program_id;
        $programTopic->delete();

        return redirect()
            ->route('admin.programs.edit', $program_id)
            ->with('success', 'Topic deleted successfully.');
    }
}
