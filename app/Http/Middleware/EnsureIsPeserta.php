<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsPeserta
{
    /**
     * Handle an incoming request.
     *
     * Peserta = any authenticated user (with or without role).
     * Alumni can also access peserta pages.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Any authenticated user can access peserta pages.
        // Admin and author roles are excluded — they have their own dashboards.
        if ($user->hasAnyRole(['superAdmin', 'admin', 'admin_spn', 'admin_taaruf', 'author'])) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
