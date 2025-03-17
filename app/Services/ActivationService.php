<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ActivationService
{
    /**
     * Send activation email to user
     *
     * @param User $user
     * @return bool
     */
    public function sendActivationEmail(User $user)
    {
        // Generate new activation token if needed
        if (empty($user->activation_token)) {
            $user->activation_token = Str::random(60);
            $user->save();
        }
        
        // Send email with activation link
        try {
            Mail::send('emails.activation', [
                'user' => $user,
                'token' => $user->activation_token
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Aktivasi Akun Bidang Dakwah Masjid Salman ITB');
            });
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Activate user account and set password
     *
     * @param string $token
     * @param string $password
     * @return User|null
     */
    public function activateAccount($token, $password)
    {
        $user = User::where('activation_token', $token)->first();
        
        if (!$user) {
            return null;
        }
        
        $user->password = Hash::make($password);
        $user->is_active = true;
        $user->activation_token = null;
        $user->email_verified_at = now();
        $user->save();
        
        return $user;
    }
    
    /**
     * Check if email exists in the system
     *
     * @param string $email
     * @return User|null
     */
    public function checkEmailExists($email)
    {
        return User::where('email', $email)->first();
    }
}
