@extends('layouts.app')

@section('title', 'Track Order - Faciona')

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
            <span class="text-slate-800 font-medium">Track Order</span>
        </nav>

        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Track Your Order</h1>
            <p class="text-xl text-slate-600 mb-4">{{ $order->order_number }}</p>
            <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-semibold {{ $order->status_color }}">
                {{ $order->status_label }}
            </span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Order Progress Visualization -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-8 text-center">Order Progress</h2>
        
        <!-- Progress Steps -->
        <div class="relative">
            <!-- Progress Line -->
            <div class="absolute top-8 left-0 w-full h-1 bg-slate-200 rounded-full">
                <div class="h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-1000" 
                     style="width: {{ $order->status_progress }}%"></div>
            </div>
            
            <!-- Steps -->
            <div class="relative flex justify-between">
                <!-- Step 1: Order Confirmed -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 {{ $order->status_progress >= 20 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                        @if($order->status_progress >= 20)
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        @else
                        <div class="w-4 h-4 bg-white rounded-full"></div>
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-slate-900 mb-1">Order Confirmed</h3>
                        <p class="text-sm text-slate-600">{{ $order->created_at->format('M j, g:i A') }}</p>
                    </div>
                </div>

                <!-- Step 2: Processing -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 {{ $order->status_progress >= 40 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                        @if($order->status_progress >= 40)
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-slate-900 mb-1">Processing</h3>
                        <p class="text-sm text-slate-600">
                            @if($order->status_progress >= 40)
                                Being prepared
                            @else
                                Waiting to process
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Step 3: Shipped -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 {{ $order->status_progress >= 60 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                        @if($order->status_progress >= 60)
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-slate-900 mb-1">Shipped</h3>
                        <p class="text-sm text-slate-600">
                            @if($order->shipped_at)
                                {{ $order->shipped_at->format('M j, g:i A') }}
                            @elseif($order->status_progress >= 60)
                                On the way
                            @else
                                Not shipped yet
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Step 4: Out for Delivery -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 {{ $order->status_progress >= 80 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                        @if($order->status_progress >= 80)
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-slate-900 mb-1">Out for Delivery</h3>
                        <p class="text-sm text-slate-600">
                            @if($order->status_progress >= 80)
                                Almost there!
                            @else
                                Pending delivery
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Step 5: Delivered -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 {{ $order->status_progress >= 100 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                        @if($order->status_progress >= 100)
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="font-bold text-slate-900 mb-1">Delivered</h3>
                        <p class="text-sm text-slate-600">
                            @if($order->delivered_at)
                                {{ $order->delivered_at->format('M j, g:i A') }}
                            @elseif($order->status_progress >= 100)
                                Completed
                            @else
                                Est: {{ $order->estimated_delivery->format('M j') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Status Details -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Current Status</h2>
        
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-xl p-6">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $order->status_label }}</h3>
                    <p class="text-slate-700 mb-4">
                        @if($order->status === 'pending')
                            Your order has been confirmed and is waiting to be processed. We'll start preparing your items soon.
                        @elseif($order->status === 'processing')
                            Your order is currently being prepared by our team. This usually takes 1-2 business days.
                        @elseif($order->status === 'shipped')
                            Your order has been shipped and is on its way to you. You should receive it within 3-5 business days.
                        @elseif($order->status === 'out_for_delivery')
                            Your order is out for delivery and should arrive today. Please be available to receive your package.
                        @elseif($order->status === 'delivered')
                            Your order has been successfully delivered. We hope you enjoy your purchase!
                        @elseif($order->status === 'cancelled')
                            This order has been cancelled. If you have any questions, please contact our support team.
                        @endif
                    </p>
                    
                    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                    <div class="flex items-center space-x-2 text-sm text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Estimated delivery: {{ $order->estimated_delivery->format('F j, Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Information -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Shipping Information</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-slate-50 rounded-xl p-6">
                <h3 class="font-semibold text-slate-900 mb-3">Delivery Address</h3>
                <div class="space-y-1 text-slate-600">
                    <p class="font-medium text-slate-900">{{ $order->shipping_address_array['full_name'] }}</p>
                    <p>{{ $order->shipping_address_array['address'] }}</p>
                    <p>{{ $order->shipping_address_array['city'] }}, {{ $order->shipping_address_array['postal_code'] }}</p>
                    <p>{{ $order->shipping_address_array['country'] }}</p>
                    <p class="mt-2">{{ $order->shipping_address_array['phone'] }}</p>
                </div>
            </div>
            
            <div class="bg-slate-50 rounded-xl p-6">
                <h3 class="font-semibold text-slate-900 mb-3">Order Details</h3>
                <div class="space-y-2 text-slate-600">
                    <div class="flex justify-between">
                        <span>Order Number:</span>
                        <span class="font-medium text-slate-900">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Order Date:</span>
                        <span class="font-medium text-slate-900">{{ $order->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Amount:</span>
                        <span class="font-bold text-slate-900">{{ $order->formatted_total }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Payment Method:</span>
                        <span class="font-medium text-slate-900">Cash on Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Items in This Order</h2>
        
        <div class="space-y-4">
            @foreach($order->orderItems as $item)
            <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-xl">
                <div class="flex-shrink-0">
                    @if($item->product->images && count($item->product->images) > 0)
                    <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                        alt="{{ $item->product->name }}" 
                        class="w-16 h-16 object-cover rounded-lg"
                        onerror="this.src='https://via.placeholder.com/64x64?text=No+Image'">
                    @else
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
                
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-slate-900 truncate">{{ $item->product->name }}</h3>
                    <p class="text-sm text-slate-600">by {{ $item->product->seller->name }}</p>
                    @if($item->size || $item->color)
                    <div class="flex space-x-2 mt-1">
                        @if($item->size)
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded">{{ $item->size }}</span>
                        @endif
                        @if($item->color)
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ $item->color }}</span>
                        @endif
                    </div>
                    @endif
                </div>
                
                <div class="text-right">
                    <p class="font-semibold text-slate-900">Qty: {{ $item->quantity }}</p>
                    <p class="text-sm text-slate-600">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center space-y-4">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('customer.orders.show', $order->id) }}" 
                class="gradient-primary text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                View Full Details
            </a>
            <a href="{{ route('customer.orders.index') }}" 
                class="bg-slate-100 text-slate-700 px-8 py-3 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 inline-block">
                Back to Orders
            </a>
        </div>
        
        <p class="text-sm text-slate-600">
            Need help? <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">Contact Support</a>
        </p>
    </div>
</div>
@endsection
