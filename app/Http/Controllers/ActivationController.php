<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ActivationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    protected $activationService;

    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    /**
     * Show the email verification form
     */
    public function showEmailForm()
    {
        return view('auth.activation.email');
    }

    /**
     * Verify email and send activation link
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = $this->activationService->checkEmailExists($request->email);

        if (!$user) {
            return back()->with('error', 'Email tidak terdaftar dalam sistem kami. Silakan periksa kembali email Anda.');
        }

        // Send activation email
        $emailSent = $this->activationService->sendActivationEmail($user);

        if ($emailSent) {
            return redirect()->route('activation.email.success');
        } else {
            return back()->with('error', 'Gagal mengirim email aktivasi. Silakan coba lagi nanti.');
        }
    }

    /**
     * Show email sent success page
     */
    public function emailSuccess()
    {
        return view('auth.activation.email-success');
    }

    /**
     * Show the activation form
     */
    public function showActivationForm($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect()->route('activation.invalid');
        }

        return view('auth.activation.activate', compact('token'));
    }

    /**
     * Activate account and set password
     */
    // public function activate(Request $request, $token)
    // {
    //     $request->validate([
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     try {
    //         $user = $this->activationService->activateAccount($token, $request->password);
    //         // if (!$user) {
    //         //     return redirect()->route('activation.invalid');
    //         // }

    //         $user->assignRole('alumni');
    //         Auth::logout();
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();
    //         Auth::login($user, true);

    //         return redirect()->route('activation.success');
    //     } catch (\Exception $e) {
    //         \Log::error('Activation error: ' . $e->getMessage());
    //         return back()->withErrors(['error' => 'Terjadi kesalahan saat aktivasi. Silakan coba lagi.']);
    //     }
    //     // Pastikan logout dulu jika ada session lain
    //     // Auth::logout();

    //     // // Regenerate session untuk keamanan
    //     // $request->session()->invalidate();
    //     // $request->session()->regenerateToken();

    //     // // Login dengan remember me
    //     // Auth::login($user, true);

    //     // return redirect()->route('activation.success');
    // }
    public function activate(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = $this->activationService->activateAccount($token, $request->password);

        // if (!$user) {
        //     return redirect()->route('activation.invalid');
        // }

        $user->assignRole('alumni');

        // Tidak perlu login, langsung tampilkan halaman sukses statis
        return view('auth.activation.success', ['email' => $user->email]);
    }

    /**
     * Show invalid token page
     */
    public function invalid()
    {
        return view('auth.activation.invalid');
    }

    /**
     * Show activation success page
     */
    public function success()
    {
        return view('auth.activation.success');
    }
}
