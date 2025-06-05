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

        // Debug routes for testing image upload
        Route::get('/test-upload', function () {
            return view('test-upload');
        })->name('test-upload-form');

        Route::post('/test-upload', function (\Illuminate\Http\Request $request) {
            \Illuminate\Support\Facades\Log::info('Test upload request:', [
                'has_files' => $request->hasFile('images'),
                'files_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
                'all_files' => $request->allFiles(),
                'all_data' => $request->all()
            ]);

            return response()->json([
                'success' => true,
                'has_files' => $request->hasFile('images'),
                'files_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
                'php_settings' => [
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                    'post_max_size' => ini_get('post_max_size'),
                    'max_file_uploads' => ini_get('max_file_uploads'),
                    'file_uploads' => ini_get('file_uploads')
                ]
            ]);
        })->name('test-upload');

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
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});
