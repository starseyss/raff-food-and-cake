<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)
                ->stateless()
                ->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login gagal: ' . $e->getMessage());
        }

        $email = $socialUser->getEmail();

        if (!$email) {
            return redirect('/login')->with('error', 'Email tidak tersedia dari Google.');
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $socialUser->getName() ?? 'User',
                'password' => bcrypt(Str::random(24)),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);
        request()->session()->regenerate();

        return redirect('/')->with('success', 'Login berhasil!');
    }
}