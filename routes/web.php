<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\SocialAuthController;

Route::view('/', 'landing.home')->name('landing.home');
Route::view('/otp', 'auth.otp')->name('otp');
Route::get('/menu', function () {return view('landing.menu');})->name('landing.menu');
Route::get('/cart', function () {return view('landing.cart');})->name('landing.cart');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::get('/details', function () {return view('landing.details');})->name('landing.details');
Route::get('/checkout', function () {return view('landing.checkout');})->name('landing.checkout');
Route::view('/account', 'landing.profil')->name('landing.profil');
Route::get('/payment', function () {return view('landing.payment');})->name('landing.payment');
Route::get('/admin/dashboard', function () {return view('admin.dashboard');});
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.store');
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
Route::get('/admin/register', [AdminRegisterController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.register.store');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

