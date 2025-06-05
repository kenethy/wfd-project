@extends('layouts.app')

@section('title', 'Order Details - Faciona')

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
            <a href="{{ route('customer.orders.index') }}" class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Order History
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">{{ $order->order_number }}</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Order Details</h1>
                <p class="text-lg text-slate-600">{{ $order->order_number }}</p>
            </div>
            <div class="mt-6 lg:mt-0 flex items-center space-x-4">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $order->status_color }}">
                    {{ $order->status_label }}
                </span>
                @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                <a href="{{ route('customer.orders.track', $order->id) }}" 
                    class="gradient-primary text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                    Track Order
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Status & Progress -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Status</h2>
                
                <!-- Progress Bar -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">Progress</span>
                        <span class="text-sm text-slate-600">{{ $order->status_progress }}% Complete</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-300" 
                             style="width: {{ $order->status_progress }}%"></div>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 {{ $order->status_progress >= 20 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center flex-shrink-0">
                            @if($order->status_progress >= 20)
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Order Confirmed</h3>
                            <p class="text-sm text-slate-600">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 {{ $order->status_progress >= 40 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center flex-shrink-0">
                            @if($order->status_progress >= 40)
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Processing</h3>
                            <p class="text-sm text-slate-600">
                                @if($order->status_progress >= 40)
                                    Order is being prepared
                                @else
                                    Waiting to be processed
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 {{ $order->status_progress >= 60 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center flex-shrink-0">
                            @if($order->status_progress >= 60)
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Shipped</h3>
                            <p class="text-sm text-slate-600">
                                @if($order->shipped_at)
                                    {{ $order->shipped_at->format('F j, Y \a\t g:i A') }}
                                @elseif($order->status_progress >= 60)
                                    Order has been shipped
                                @else
                                    Waiting to be shipped
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 {{ $order->status_progress >= 100 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center flex-shrink-0">
                            @if($order->status_progress >= 100)
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Delivered</h3>
                            <p class="text-sm text-slate-600">
                                @if($order->delivered_at)
                                    {{ $order->delivered_at->format('F j, Y \a\t g:i A') }}
                                @elseif($order->status_progress >= 100)
                                    Order has been delivered
                                @else
                                    Estimated: {{ $order->estimated_delivery->format('F j, Y') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Shipping Information</h2>
                
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $order->shipping_address_array['full_name'] }}</h3>
                            <p class="text-slate-600 mb-1">{{ $order->shipping_address_array['email'] }}</p>
                            <p class="text-slate-600">{{ $order->shipping_address_array['phone'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 mb-2">Delivery Address</h4>
                            <p class="text-slate-600">{{ $order->shipping_address_array['address'] }}</p>
                            <p class="text-slate-600">{{ $order->shipping_address_array['city'] }}, {{ $order->shipping_address_array['postal_code'] }}</p>
                            <p class="text-slate-600">{{ $order->shipping_address_array['country'] }}</p>
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
                            <h3 class="text-lg font-semibold text-slate-900 mb-1">
                                <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-purple-600 transition-colors duration-200">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
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
                        <span class="font-semibold text-slate-900">{{ $order->formatted_total }}</span>
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
                            <span class="text-2xl font-bold text-slate-900">{{ $order->formatted_total }}</span>
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
                    @if($order->canBeCancelled())
                    <form method="POST" action="{{ route('customer.orders.cancel', $order->id) }}">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to cancel this order?')"
                                class="w-full bg-red-600 text-white text-center py-3 px-6 rounded-xl font-bold hover:bg-red-700 transition-colors duration-200">
                            Cancel Order
                        </button>
                    </form>
                    @endif
                    
                    @if($order->canBeReordered())
                    <form method="POST" action="{{ route('customer.orders.reorder', $order->id) }}">
                        @csrf
                        <button type="submit" 
                                class="w-full gradient-primary text-white text-center py-3 px-6 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300">
                            Reorder Items
                        </button>
                    </form>
                    @endif
                    
                    <a href="{{ route('customer.orders.index') }}" 
                        class="w-full bg-slate-100 text-slate-700 text-center py-3 px-6 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 block">
                        Back to Orders
                    </a>
                </div>

                <!-- Support -->
                <div class="mt-8 pt-6 border-t border-slate-200 text-center">
                    <p class="text-sm text-slate-600 mb-2">Need help with this order?</p>
                    <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
