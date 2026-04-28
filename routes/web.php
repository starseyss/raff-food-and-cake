<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Landing\CheckoutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| LANDING & USER
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/otp', 'auth.otp')->name('otp');

Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/cart', fn() => view('landing.cart'))->name('landing.cart');
Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('landing.checkout.store');
Route::get('/payment', fn() => view('landing.payment'))->name('landing.payment');
Route::view('/account', 'landing.profil')->name('landing.profil');

Route::get('/landing/details/{id}', [HomeController::class, 'details'])->name('landing.details');
Route::post('/bayar', [PaymentController::class, 'bayar']);
Route::get('/checkout', fn() => view('landing.checkout'));
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('landing.checkout');
Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment.success');

Route::view('/syarat-ketentuan', 'landing.syarat_ketentuan')->name('syarat.ketentuan');
Route::view('/kebijakan-privasi', 'landing.kebijakan_privasi')->name('kebijakan.privasi');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| SOCIAL LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
Route::match(['get', 'post'], '/midtrans/callback', [PaymentController::class, 'callback']);
Route::match(['get', 'post'], '/notification/midtrans', [PaymentController::class, 'notification'])->name('midtrans.notification');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.store');

Route::get('/admin/register', [AdminRegisterController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.register.store');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['isAdmin'])->prefix('admin')->group(function () {

    // ✅ DASHBOARD (beda halaman)
Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

    // ✅ PRODUK
    Route::get('/product', [ProdukController::class, 'index'])->name('admin.product');

    // MENU LAIN
Route::get('/pesanan', [OrderController::class, 'index'])
    ->name('admin.list-order');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.cancel');
    Route::get('/keuangan', [OrderController::class, 'paymentList'])->name('admin.payment-list');
    Route::get('/pengiriman', [OrderController::class, 'shipping'])->name('admin.shipping');
    Route::post('/orders/{id}/assign-driver', [OrderController::class, 'assignDriver'])->name('admin.assign-driver');
    Route::post('/orders/{id}/start-delivery', [OrderController::class, 'startDelivery'])->name('admin.start-delivery');
    Route::post('/orders/{id}/mark-delivered', [OrderController::class, 'markDelivered'])->name('admin.mark-delivered');
    Route::get('/analisis', fn() => view('admin.analisis'))->name('admin.analisis');
    Route::get('/profil', fn() => view('admin.profil'))->name('admin.profil');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.updateStatus');

    // ✅ NOTIFICATIONS
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');
    Route::post('/notifications/{id}/read', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/notifications/read-all', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.read-all');
    Route::get('/notifications/unread-count', [AdminNotificationController::class, 'unreadCount'])->name('admin.notifications.unread-count');
    Route::get('/notifications/latest', [AdminNotificationController::class, 'latest'])->name('admin.notifications.latest');

// 🔥 HALAMAN SUCCESS (PUBLIC, JANGAN DI ADMIN)
});

/*
|--------------------------------------------------------------------------
| PRODUK ACTION
|--------------------------------------------------------------------------
*/
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::middleware('auth')->group(function () {
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.detail');
    Route::post('/pesanan/{id}/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');
    Route::post('/pesanan/{id}/terima', [PesananController::class, 'terima'])->name('pesanan.terima');
    Route::post('/pesanan/{id}/rating', [PesananController::class, 'rating'])->name('pesanan.rating');
        // ================= ALAMAT =================
Route::get('/alamat', [AddressController::class, 'index']);
Route::post('/alamat', [AddressController::class, 'store']);
Route::put('/alamat/{id}', [AddressController::class, 'update']);
Route::delete('/alamat/{id}', [AddressController::class, 'destroy']);
Route::post('/alamat/{id}/main', [AddressController::class, 'setMain']);
});
