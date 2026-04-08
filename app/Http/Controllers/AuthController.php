<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function storeRegister(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:100'],
            'last_name' => ['nullable','string','max:100'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $name = trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? ''));

$user = User::create([
    'name' => $name,
    'email' => $data['email'],
    'password' => Hash::make($data['password']),
]);

        Auth::login($user);
        return redirect()->intended('/');
    }

    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

public function destroy(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Kirim flag ke landing untuk reset popup
    return redirect('/')->with('resetPopup', true);
}
}
