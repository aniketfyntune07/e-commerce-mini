<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StripeWebhookController;

/*
|--------------------------------------------------------------------------
| SHOP (PUBLIC)
|--------------------------------------------------------------------------
*/

// When admin hits '/', redirect to admin dashboard
Route::get('/', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // normal users and guests see the shop
    return app(ProductController::class)->shop();
})->name('shop.index');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('shop.show');

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])->prefix('admin')->group(function () {

    // Real Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin Product CRUD
    Route::resource('products', ProductController::class)->names('admin.products');

    // Admin Orders
    Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::get('/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'show'])
        ->name('admin.orders.show');
});

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER PROTECTED AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['user'])->group(function () {
    Route::get('/profile', function () {
        return view('user.dashboard');
    })->name('profile');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| STRIPE WEBHOOK (NO AUTH)
|--------------------------------------------------------------------------
*/

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
