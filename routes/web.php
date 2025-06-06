<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('products.index');
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

    // Checkout routes (available to all authenticated users)
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
        Route::get('/shipping', [App\Http\Controllers\CheckoutController::class, 'shipping'])->name('shipping');
        Route::post('/payment', [App\Http\Controllers\CheckoutController::class, 'payment'])->name('payment');
        Route::post('/review', [App\Http\Controllers\CheckoutController::class, 'review'])->name('review');
        Route::post('/place-order', [App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
        Route::get('/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('success');
    });

    // Orders routes (available to all authenticated users)
    Route::get('/orders', [App\Http\Controllers\Customer\OrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Customer\OrderController::class, 'show'])->name('customer.orders.show');
    Route::post('/orders/{order}/cancel', [App\Http\Controllers\Customer\OrderController::class, 'cancel'])->name('customer.orders.cancel');
    Route::post('/orders/{order}/reorder', [App\Http\Controllers\Customer\OrderController::class, 'reorder'])->name('customer.orders.reorder');
    Route::get('/orders/{order}/track', [App\Http\Controllers\Customer\OrderController::class, 'track'])->name('customer.orders.track');

    // Legacy route for backward compatibility
    Route::get('/customer/orders', function () {
        return redirect()->route('customer.orders.index');
    })->name('customer.orders');

    // Shipping routes (available to authenticated users)
    Route::prefix('shipping')->name('shipping.')->group(function () {
        Route::post('/calculate', [App\Http\Controllers\ShippingController::class, 'calculateShipping'])->name('calculate');
        Route::get('/track/{trackingNumber}', [App\Http\Controllers\ShippingController::class, 'trackShipment'])->name('track');
        Route::post('/orders/{order}/create-shipment', [App\Http\Controllers\ShippingController::class, 'createShipment'])->name('create-shipment');
        Route::post('/shipments/{shipment}/update-status', [App\Http\Controllers\ShippingController::class, 'updateShipmentStatus'])->name('update-status');
        Route::post('/shipments/{shipment}/simulate-progress', [App\Http\Controllers\ShippingController::class, 'simulateProgress'])->name('simulate-progress');
        Route::get('/shipments/{shipment}/label', [App\Http\Controllers\ShippingController::class, 'getShippingLabel'])->name('label');
    });

    // Customer-specific routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/profile', function () {
            return view('customer.profile');
        })->name('customer.profile');
    });

    // Seller routes
    Route::middleware('role:seller')->prefix('seller')->name('seller.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('dashboard');

        // Product Management
        Route::resource('products', App\Http\Controllers\Seller\ProductController::class);



        // Order Management
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [App\Http\Controllers\Seller\OrderController::class, 'index'])->name('index');
            Route::get('/{order}', [App\Http\Controllers\Seller\OrderController::class, 'show'])->name('show');
            Route::post('/{order}/update-status', [App\Http\Controllers\Seller\OrderController::class, 'updateStatus'])->name('update-status');
            Route::post('/bulk-update-status', [App\Http\Controllers\Seller\OrderController::class, 'bulkUpdateStatus'])->name('bulk-update-status');
            Route::get('/analytics/overview', [App\Http\Controllers\Seller\OrderController::class, 'analytics'])->name('analytics');
        });

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/stock', function () {
                return view('seller.reports.stock');
            })->name('stock');
            Route::get('/sales', function () {
                return view('seller.reports.sales');
            })->name('sales');
        });
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
            Route::get('/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
            Route::put('/{user}/role', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('update-role');
            Route::put('/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('toggle-status');
            Route::delete('/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        });

        // Product Management
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
            Route::get('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('show');
            Route::get('/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update');
            Route::put('/{product}/toggle-status', [App\Http\Controllers\Admin\ProductController::class, 'toggleStatus'])->name('toggle-status');
            Route::delete('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('destroy');
        });

        // Category Management
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('show');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');
            Route::put('/{category}/toggle-status', [App\Http\Controllers\Admin\CategoryController::class, 'toggleStatus'])->name('toggle-status');
            Route::delete('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('destroy');
        });

        // Review Management
        Route::prefix('reviews')->name('reviews.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('index');
            Route::get('/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'show'])->name('show');
            Route::put('/{review}/status', [App\Http\Controllers\Admin\ReviewController::class, 'updateStatus'])->name('update-status');
            Route::delete('/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('destroy');
        });

        // Order Management & Reports
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('index');
            Route::get('/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('show');
        });

        // Sales Reports
        Route::get('/reports/sales', [App\Http\Controllers\Admin\OrderController::class, 'salesReport'])->name('reports.sales');
    });
});
