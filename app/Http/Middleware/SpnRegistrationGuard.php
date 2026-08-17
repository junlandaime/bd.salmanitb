<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpnRegistrationGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();
        
        // Extract step number from route name (e.g., spn.daftar.step2 -> 2)
        if (preg_match('/step(\d+)/', $routeName, $matches)) {
            $step = (int) $matches[1];
            
            // Step 1 is always accessible
            if ($step === 1) {
                return $next($request);
            }
            
            // For step 2-5, check if the previous step's session exists
            if ($step >= 2 && $step <= 5) {
                $requiredSession = 'spn_step' . ($step - 1);
                if (!$request->session()->has($requiredSession)) {
                    // Find the earliest incomplete step
                    for ($i = 1; $i < $step; $i++) {
                        if (!$request->session()->has('spn_step' . $i)) {
                            return redirect()->route('spn.daftar.step' . $i)
                                ->with('error', 'Silakan lengkapi langkah ' . $i . ' terlebih dahulu.');
                        }
                    }
                    
                    return redirect()->route('spn.daftar.step1')
                        ->with('error', 'Sesi pendaftaran tidak valid atau telah berakhir.');
                }
            }
            
            // Step 6 is success page, doesn't need session check (accessed via URL with code)
        }

        return $next($request);
    }
}
