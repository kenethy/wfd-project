@extends('layouts.app')

@section('title', 'Order Confirmed - Faciona')

@section('content')
<!-- Success Header -->
<div class="bg-gradient-to-r from-emerald-50 to-green-50 border-b border-emerald-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <!-- Success Icon -->
            <div class="w-24 h-24 mx-auto mb-6 bg-emerald-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Order Confirmed!</h1>
            <p class="text-xl text-slate-600 mb-6">Thank you for your purchase. Your order has been successfully placed.</p>
            
            <!-- Order Number -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-200 p-6 max-w-md mx-auto">
                <p class="text-sm text-slate-600 mb-2">Order Number</p>
                <p class="text-2xl font-bold text-slate-900">#{{ $order->order_number }}</p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Status -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Status</h2>
                
                <div class="flex items-center space-x-4 p-6 bg-emerald-50 rounded-xl border border-emerald-200">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-900">Order Confirmed</h3>
                        <p class="text-emerald-700">Your order is being prepared for shipment</p>
                        <p class="text-sm text-emerald-600 mt-1">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="mt-6 space-y-4">
                    <h3 class="text-lg font-semibold text-slate-900">What happens next?</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-xs font-bold text-purple-600">1</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Order Processing</p>
                                <p class="text-sm text-slate-600">We'll prepare your items for shipment (1-2 business days)</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-xs font-bold text-purple-600">2</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Shipping</p>
                                <p class="text-sm text-slate-600">Your order will be shipped to your address (3-5 business days)</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-xs font-bold text-purple-600">3</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Delivery</p>
                                <p class="text-sm text-slate-600">Receive your order and pay on delivery (COD)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Shipping Information</h2>
                
                @php
                    $shippingAddress = json_decode($order->shipping_address, true);
                @endphp
                
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $shippingAddress['full_name'] }}</h3>
                            <p class="text-slate-600 mb-1">{{ $shippingAddress['email'] }}</p>
                            <p class="text-slate-600">{{ $shippingAddress['phone'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 mb-2">Delivery Address</h4>
                            <p class="text-slate-600">{{ $shippingAddress['address'] }}</p>
                            <p class="text-slate-600">{{ $shippingAddress['city'] }}, {{ $shippingAddress['postal_code'] }}</p>
                            <p class="text-slate-600">{{ $shippingAddress['country'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Items</h2>
                
                <div class="space-y-6">
                    @foreach($order->orderItems as $item)
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
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary & Actions -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sticky top-4">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Summary</h2>

                <!-- Totals -->
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Subtotal ({{ $order->orderItems->sum('quantity') }} items)</span>
                        <span class="font-semibold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Shipping</span>
                        <span class="font-semibold text-emerald-600">Free</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Tax</span>
                        <span class="font-semibold text-slate-900">Rp 0</span>
                    </div>

                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-slate-900">Total</span>
                            <span class="text-2xl font-bold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-8 p-4 bg-slate-50 rounded-xl">
                    <h3 class="font-semibold text-slate-900 mb-2">Payment Method</h3>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-slate-700">Cash on Delivery (COD)</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <a href="{{ route('customer.orders') }}" 
                        class="w-full gradient-primary text-white text-center py-3 px-6 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300 block shadow-modern">
                        View Order Details
                    </a>
                    
                    <a href="{{ route('products.index') }}" 
                        class="w-full bg-slate-100 text-slate-700 text-center py-3 px-6 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 block">
                        Continue Shopping
                    </a>
                </div>

                <!-- Support -->
                <div class="mt-8 pt-6 border-t border-slate-200 text-center">
                    <p class="text-sm text-slate-600 mb-2">Need help with your order?</p>
                    <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
