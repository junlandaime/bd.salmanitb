<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTaarufProfileActive
{
    /**
     * Ensure the authenticated user's taaruf profile is active.
     *
     * This middleware should be applied AFTER EnsureTaarufProfileExists.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user->taarufProfile->is_active) {
            return redirect()->route('taaruf.index')
                ->with('error', 'Anda harus mengaktifkan profil Ta\'aruf terlebih dahulu.');
        }

        return $next($request);
    }
}
