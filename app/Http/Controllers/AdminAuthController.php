<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validasi dulu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            // Cek apakah admin
            if ($user->role !== 'admin') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Bukan akun admin.'
                ]);
            }

            // Kalau admin → redirect ke dashboard
            return redirect('/admin/dashboard');
            // atau kalau pakai route name:
            // return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

public function logout()
{
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/admin/login');
}
}