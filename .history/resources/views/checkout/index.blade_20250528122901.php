@extends('layouts.app')

@section('title', 'Checkout - Faciona')

@section('content')
<!-- Professional Header -->
<div class="bg-gradient-to-r from-slate-50 to-purple-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Home
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('cart.index') }}"
                class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Cart
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">Checkout</span>
        </nav>

        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Secure Checkout</h1>
            <p class="text-xl text-slate-600">Complete your order with confidence</p>
        </div>
    </div>
</div>

<!-- Progress Indicator -->
<div class="bg-white border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <!-- Step 1: Cart Review -->
            <div class="flex items-center">
                <div
                    class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    1
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-purple-600">Cart Review</p>
                    <p class="text-xs text-slate-500">Review your items</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-slate-200 rounded-full">
                    <div class="h-1 bg-slate-300 rounded-full w-0"></div>
                </div>
            </div>

            <!-- Step 2: Shipping -->
            <div class="flex items-center">
                <div
                    class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                    2
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-500">Shipping</p>
                    <p class="text-xs text-slate-400">Delivery details</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-slate-200 rounded-full"></div>
            </div>

            <!-- Step 3: Payment -->
            <div class="flex items-center">
                <div
                    class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                    3
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-500">Payment</p>
                    <p class="text-xs text-slate-400">Payment method</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-slate-200 rounded-full"></div>
            </div>

            <!-- Step 4: Confirmation -->
            <div class="flex items-center">
                <div
                    class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                    4
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-500">Review</p>
                    <p class="text-xs text-slate-400">Final confirmation</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('checkout.store') }}" class="space-y-6">
                @csrf

                <!-- Shipping Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pengiriman</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="name" value="{{ auth()->user()->name }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-600">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" value="{{ auth()->user()->email }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-600">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Telepon</label>
                            <input type="tel" id="phone" value="{{ auth()->user()->phone }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-600">
                        </div>

                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                Pengiriman *</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('shipping_address') border-red-500 @enderror"
                                placeholder="Masukkan alamat lengkap untuk pengiriman">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Metode Pembayaran</h2>

                    <div class="space-y-3">
                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="cod" class="mr-3" checked>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium">Cash on Delivery (COD)</p>
                                    <p class="text-sm text-gray-600">Bayar saat barang diterima</p>
                                </div>
                            </div>
                        </label>

                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 opacity-50">
                            <input type="radio" name="payment_method" value="transfer" class="mr-3" disabled>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium">Transfer Bank</p>
                                    <p class="text-sm text-gray-600">Segera hadir (Coming Soon)</p>
                                </div>
                            </div>
                        </label>

                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 opacity-50">
                            <input type="radio" name="payment_method" value="ewallet" class="mr-3" disabled>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium">E-Wallet</p>
                                    <p class="text-sm text-gray-600">OVO, GoPay, DANA (Coming Soon)</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Buat Pesanan
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                <!-- Cart Items -->
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            @if($item->product->images && count($item->product->images) > 0)
                            <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded"
                                onerror="this.src='https://via.placeholder.com/48x48?text=No+Image'">
                            @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-400 text-xs">No Image</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</p>
                            <div class="flex text-xs text-gray-500 space-x-2">
                                @if($item->size)
                                <span>{{ $item->size }}</span>
                                @endif
                                @if($item->color)
                                <span>{{ $item->color }}</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">{{ $item->quantity }}x</p>
                        </div>

                        <div class="text-sm font-medium text-gray-900">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="border-t border-gray-200 pt-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                        <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span class="font-medium text-green-600">Gratis</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Biaya Admin</span>
                        <span class="font-medium text-green-600">Gratis</span>
                    </div>

                    <hr class="my-4">

                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Back to Cart -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('cart.index') }}"
                        class="w-full bg-gray-100 text-gray-700 text-center py-2 px-4 rounded-lg font-medium hover:bg-gray-200 transition-colors block">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection