<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTaarufEligible
{
    /**
     * Ensure the authenticated user is an alumni of Sekolah Pranikah (Online or Offline).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $batches = $user->batchesAsAlumni()->with('activity')->get();

        foreach ($batches as $batch) {
            if (Str::contains($batch->activity->title, ['Sekolah Pranikah Online', 'Sekolah Pranikah Offline'])) {
                return $next($request);
            }
        }

        return redirect()->route('alumni.dashboard')
            ->with('error', 'Anda tidak memiliki akses ke fitur Ta\'aruf. Fitur ini hanya tersedia untuk alumni Sekolah Pranikah Online dan Offline.');
    }
}
