<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product:slug}', [HomeController::class, 'show'])->name('products.show');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    // Cart routes (for all authenticated users)
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('index');
        Route::post('/add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
        Route::put('/{cart}/update', [App\Http\Controllers\CartController::class, 'update'])->name('update');
        Route::delete('/{cart}/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('remove');
        Route::get('/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
        Route::get('/count', [App\Http\Controllers\CartController::class, 'count'])->name('count');
    });

    // Customer routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/profile', function () {
            return view('customer.profile');
        })->name('customer.profile');

        // Checkout routes
        Route::prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/', [App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
        });

        // Orders routes
        Route::get('/orders', function () {
            $orders = App\Models\Order::with(['orderItems.product'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('customer.orders', compact('orders'));
        })->name('customer.orders');
    });

    // Seller routes
    Route::middleware('role:seller')->prefix('seller')->name('seller.')->group(function () {
        Route::get('/dashboard', function () {
            return view('seller.dashboard');
        })->name('dashboard');
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});
