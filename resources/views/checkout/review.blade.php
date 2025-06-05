@extends('layouts.app')

@section('title', 'Review Order - Faciona')

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
            <a href="{{ route('cart.index') }}" class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Cart
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">Review Order</span>
        </nav>

        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Review Your Order</h1>
            <p class="text-xl text-slate-600">Double-check everything before placing your order</p>
        </div>
    </div>
</div>

<!-- Progress Indicator -->
<div class="bg-white border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <!-- Step 1: Cart Review -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-emerald-600">Cart Review</p>
                    <p class="text-xs text-slate-500">Completed</p>
                </div>
            </div>
            
            <div class="flex-1 mx-4">
                <div class="h-1 bg-emerald-600 rounded-full"></div>
            </div>

            <!-- Step 2: Shipping -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-emerald-600">Shipping</p>
                    <p class="text-xs text-slate-500">Completed</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-emerald-600 rounded-full"></div>
            </div>

            <!-- Step 3: Payment -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-emerald-600">Payment</p>
                    <p class="text-xs text-slate-500">Completed</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-emerald-600 rounded-full"></div>
            </div>

            <!-- Step 4: Confirmation -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    4
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-purple-600">Review</p>
                    <p class="text-xs text-slate-500">Final step</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Shipping Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Shipping Information</h2>
                    <a href="{{ route('checkout.shipping') }}" class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                        Edit
                    </a>
                </div>
                
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $shippingInfo['full_name'] }}</h3>
                            <p class="text-slate-600 mb-1">{{ $shippingInfo['email'] }}</p>
                            <p class="text-slate-600">{{ $shippingInfo['phone'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 mb-2">Delivery Address</h4>
                            <p class="text-slate-600">{{ $shippingInfo['address'] }}</p>
                            <p class="text-slate-600">{{ $shippingInfo['city'] }}, {{ $shippingInfo['postal_code'] }}</p>
                            <p class="text-slate-600">{{ $shippingInfo['country'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Payment Method</h2>
                    <a href="{{ route('checkout.payment') }}" class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                        Change
                    </a>
                </div>
                
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="flex items-center space-x-4">
                        @if($paymentMethod === 'cod')
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Cash on Delivery (COD)</h3>
                            <p class="text-slate-600">Pay when your order arrives at your doorstep</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Items</h2>
                
                <div class="space-y-6">
                    @foreach($cartItems as $item)
                    <div class="flex items-start space-x-4 p-4 bg-slate-50 rounded-xl">
                        <!-- Product Image -->
                        <div class="flex-shrink-0">
                            @if($item->product->images && count($item->product->images) > 0)
                            <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                alt="{{ $item->product->name }}" 
                                class="w-20 h-20 object-cover rounded-lg"
                                onerror="this.src='https://via.placeholder.com/80x80?text=No+Image'">
                            @else
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-slate-900 mb-1">{{ $item->product->name }}</h3>
                            <p class="text-sm text-slate-600 mb-2">by {{ $item->product->seller->name }}</p>
                            
                            @if($item->size || $item->color)
                            <div class="flex flex-wrap gap-2 mb-2">
                                @if($item->size)
                                <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs font-medium">
                                    Size: {{ $item->size }}
                                </span>
                                @endif
                                @if($item->color)
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                                    Color: {{ $item->color }}
                                </span>
                                @endif
                            </div>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Quantity: {{ $item->quantity }}</span>
                                <span class="text-lg font-bold text-slate-900">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary & Place Order -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sticky top-4">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Summary</h2>

                <!-- Totals -->
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                        <span class="font-semibold text-slate-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Shipping</span>
                        <span class="font-semibold text-emerald-600">Free</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Tax</span>
                        <span class="font-semibold text-slate-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-slate-900">Total</span>
                            <span class="text-2xl font-bold text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Place Order Button -->
                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full gradient-primary text-white py-4 px-6 rounded-xl font-bold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 shadow-modern mb-4">
                        Place Order
                        <svg class="w-5 h-5 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>
                </form>

                <a href="{{ route('checkout.payment') }}" 
                    class="w-full bg-slate-100 text-slate-700 text-center py-3 px-6 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 block">
                    Back to Payment
                </a>

                <!-- Trust Signals -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="space-y-2">
                            <div class="w-8 h-8 mx-auto bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Secure Order</p>
                        </div>
                        <div class="space-y-2">
                            <div class="w-8 h-8 mx-auto bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Fast Delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
