<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityBatch;
use App\Models\BatchAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class BatchAlumniController extends Controller
{
    /**
     * Constructor
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:admin']);
    // }

    /**
     * Display a listing of batch alumni.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BatchAlumni::with(['user', 'activityBatch.activity']);

        // Filter by batch if provided
        if ($request->has('batch_id') && $request->batch_id) {
            $query->where('activity_batch_id', $request->batch_id);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'name_asc':
                    $query->join('users', 'batch_alumni.user_id', '=', 'users.id')
                        ->orderBy('users.name', 'asc')
                        ->select('batch_alumni.*');
                    break;
                case 'name_desc':
                    $query->join('users', 'batch_alumni.user_id', '=', 'users.id')
                        ->orderBy('users.name', 'desc')
                        ->select('batch_alumni.*');
                    break;
                case 'batch_asc':
                    $query->join('activity_batches', 'batch_alumni.activity_batch_id', '=', 'activity_batches.id')
                        ->orderBy('activity_batches.created_at', 'asc')
                        ->select('batch_alumni.*');
                    break;
                case 'batch_desc':
                    $query->join('activity_batches', 'batch_alumni.activity_batch_id', '=', 'activity_batches.id')
                        ->orderBy('activity_batches.created_at', 'desc')
                        ->select('batch_alumni.*');
                    break;
                case 'created_at_asc':
                    $query->orderBy('batch_alumni.created_at', 'asc');
                    break;
                case 'created_at_desc':
                default:
                    $query->orderBy('batch_alumni.created_at', 'desc');
                    break;
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $batchAlumni = $query->paginate(15);
        $batches = ActivityBatch::with('activity')->orderBy('created_at', 'desc')->get();

        // Preserve query parameters in pagination links
        $batchAlumni->appends($request->except('page'));

        return view('admin.batch-alumni.index', compact('batchAlumni', 'batches'));
    }

    /**
     * Show the form for creating a new batch alumni.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage alumni')) {
        //     throw UnauthorizedException::forPermissions(['manage alumni']);
        // }

        $users = User::orderBy('name')->get();
        $batches = ActivityBatch::with('activity')->orderBy('created_at', 'desc')->get();

        return view('admin.batch-alumni.create', compact('users', 'batches'));
    }

    /**
     * Store a newly created batch alumni in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage alumni')) {
        //     throw UnauthorizedException::forPermissions(['manage alumni']);
        // }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_batch_id' => 'required|exists:activity_batches,id',
            'instagram_account' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female,Laki-laki,Perempuan',
            'notes' => 'nullable|string',
        ]);

        // Check if the user is already an alumni of this batch
        $existingAlumni = BatchAlumni::where('user_id', $request->user_id)
            ->where('activity_batch_id', $request->activity_batch_id)
            ->first();

        if ($existingAlumni) {
            return redirect()->route('admin.batch-alumni.index')
                ->with('error', 'User is already an alumni of this batch.');
        }

        BatchAlumni::create([
            'user_id' => $request->user_id,
            'activity_batch_id' => $request->activity_batch_id,
            'instagram_account' => $request->instagram_account,
            'gender' => $request->gender,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.batch-alumni.index')
            ->with('success', 'Batch alumni created successfully.');
    }

    /**
     * Show the form for editing the specified batch alumni.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage alumni')) {
        //     throw UnauthorizedException::forPermissions(['manage alumni']);
        // }

        $batchAlumni = BatchAlumni::with(['user', 'activityBatch.activity'])->findOrFail($id);
        $users = User::orderBy('name')->get();
        $batches = ActivityBatch::with('activity')->orderBy('created_at', 'desc')->get();

        return view('admin.batch-alumni.edit', compact('batchAlumni', 'users', 'batches'));
    }

    /**
     * Update the specified batch alumni in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage alumni')) {
        //     throw UnauthorizedException::forPermissions(['manage alumni']);
        // }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_batch_id' => 'required|exists:activity_batches,id',
            'instagram_account' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female,Laki-laki,Perempuan',
            'notes' => 'nullable|string',
        ]);

        $batchAlumni = BatchAlumni::findOrFail($id);

        // Check if changing user_id or activity_batch_id would create a duplicate
        if ($batchAlumni->user_id != $request->user_id || $batchAlumni->activity_batch_id != $request->activity_batch_id) {
            $existingAlumni = BatchAlumni::where('user_id', $request->user_id)
                ->where('activity_batch_id', $request->activity_batch_id)
                ->where('id', '!=', $id)
                ->first();

            if ($existingAlumni) {
                return redirect()->route('admin.batch-alumni.edit', $id)
                    ->with('error', 'User is already an alumni of this batch.');
            }
        }

        $batchAlumni->update([
            'user_id' => $request->user_id,
            'activity_batch_id' => $request->activity_batch_id,
            'instagram_account' => $request->instagram_account,
            'gender' => $request->gender,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.batch-alumni.index')
            ->with('success', 'Batch alumni updated successfully.');
    }

    /**
     * Remove the specified batch alumni from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Permission check handled by middleware
        // if (Auth::user()->cannot('manage alumni')) {
        //     throw UnauthorizedException::forPermissions(['manage alumni']);
        // }

        $batchAlumni = BatchAlumni::findOrFail($id);
        $batchAlumni->delete();

        return redirect()->route('admin.batch-alumni.index')
            ->with('success', 'Batch alumni deleted successfully.');
    }
}
