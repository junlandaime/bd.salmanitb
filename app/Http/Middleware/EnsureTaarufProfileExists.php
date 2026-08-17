<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTaarufProfileExists
{
    /**
     * Ensure the authenticated user has a taaruf profile.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user->taarufProfile) {
            return redirect()->route('taaruf.profile.create')
                ->with('error', 'Anda harus membuat profil Ta\'aruf terlebih dahulu.');
        }

        return $next($request);
    }
}
