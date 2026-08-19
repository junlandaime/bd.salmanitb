<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    /**
     * Display the admin login view.
     */
    public function createAdmin(): View
    {
        session(['role' => 'admin']);
        return view('auth.login', [
            'role' => 'admin',
            'title' => 'Login Admin'
        ]);
    }

    public function createAlumni(): View
    {
        session(['role' => 'alumni']);
        return view('auth.login', [
            'role' => 'alumni',
            'title' => 'Login Alumni'
        ]);
    }

    public function createAuthor(): View
    {
        session(['role' => 'author']);
        return view('auth.login', [
            'role' => 'author',
            'title' => 'Login Penulis'
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        if ($user) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'last_login_at')) {
                    $user->updateQuietly(['last_login_at' => \Illuminate\Support\Carbon::now()]);
                }
            } catch (\Throwable $e) {
                // Ignore if migration is not yet run
            }
        }

        if ($user->hasAnyRole(['superAdmin', 'admin', 'admin_spn', 'admin_taaruf'])) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif ($user->hasRole('alumni')) {
            return redirect()->intended(route('alumni.dashboard', absolute: false));
        } elseif ($user->hasRole('author')) {
            return redirect()->intended(route('author.dashboard', absolute: false));
        } else {
            // Semua pengguna tanpa role administratif diarahkan ke dashboard peserta
            return redirect()->intended(route('peserta.dashboard', absolute: false));
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
