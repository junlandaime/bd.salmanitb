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

        if (auth()->user()->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif (auth()->user()->hasRole('alumni')) {
            return redirect()->intended(route('alumni.dashboard', absolute: false));
        } else {
            return redirect()->intended(route('author.dashboard', absolute: false));
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
