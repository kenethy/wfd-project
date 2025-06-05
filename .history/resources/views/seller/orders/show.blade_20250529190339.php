@extends('layouts.app')

@section('title', 'Order Details - Faciona Seller')

@section('content')
<!-- Professional Header -->
<div class="bg-gradient-to-r from-slate-50 to-purple-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6" aria-label="Breadcrumb">
            <a href="{{ route('seller.dashboard') }}"
                class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Dashboard
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('seller.orders.index') }}"
                class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Orders
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">Order Details</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Order Details</h1>
                <p class="text-lg text-slate-600">{{ $order->order_number }}</p>
            </div>
            <div class="mt-6 lg:mt-0 flex items-center space-x-4">
                <span
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $order->status_color }}">
                    {{ $order->status_label }}
                </span>
                @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                @if(!$order->shipment && $order->status === 'processing')
                <button onclick="openShippingModal({{ $order->id }})"
                    class="gradient-primary text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                    Create Shipment
                </button>
                @else
                <button onclick="openStatusModal({{ $order->id }}, '{{ $order->status }}')"
                    class="gradient-primary text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                    Update Status
                </button>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Order Information -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Status Timeline -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Progress</h2>

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
                            <div
                                class="w-16 h-16 {{ $order->status_progress >= 20 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                                @if($order->status_progress >= 20)
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                @else
                                <div class="w-4 h-4 bg-white rounded-full"></div>
                                @endif
                            </div>
                            <div class="text-center">
                                <h3 class="font-bold text-slate-900 mb-1">Confirmed</h3>
                                <p class="text-sm text-slate-600">{{ $order->created_at->format('M j, g:i A') }}</p>
                            </div>
                        </div>

                        <!-- Step 2: Processing -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-16 h-16 {{ $order->status_progress >= 40 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                                @if($order->status_progress >= 40)
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                @else
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                            <div
                                class="w-16 h-16 {{ $order->status_progress >= 60 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                                @if($order->status_progress >= 60)
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                @else
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                                    </path>
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

                        <!-- Step 4: Delivered -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-16 h-16 {{ $order->status_progress >= 100 ? 'bg-emerald-500' : 'bg-slate-300' }} rounded-full flex items-center justify-center mb-4 shadow-lg transition-all duration-300">
                                @if($order->status_progress >= 100)
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                @else
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
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
                                    Pending delivery
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            @if($order->shipment)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Shipping Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-slate-50 rounded-xl p-6">
                        <h3 class="font-semibold text-slate-900 mb-3">Courier Details</h3>
                        <div class="space-y-2 text-slate-600">
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl">{{ $order->shipment->courier_logo }}</span>
                                <span class="font-medium text-slate-900">{{ $order->shipment->courier_name }}</span>
                            </div>
                            <p>Service: {{ $order->shipment->service_type }}</p>
                            <p>Tracking: <span class="font-mono font-bold text-slate-900">{{
                                    $order->shipment->tracking_number }}</span></p>
                            <p>Cost: {{ $order->shipment->formatted_shipping_cost }}</p>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-6">
                        <h3 class="font-semibold text-slate-900 mb-3">Delivery Details</h3>
                        <div class="space-y-2 text-slate-600">
                            <p>Weight: {{ $order->shipment->weight }} kg</p>
                            <p>Origin: {{ $order->shipment->origin_city }}</p>
                            <p>Destination: {{ $order->shipment->destination_city }}</p>
                            <p>Est. Delivery: {{ $order->shipment->estimated_delivery_date->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tracking Progress -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-slate-900">Shipping Status</h3>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $order->shipment->status_color }}">
                            {{ $order->shipment->status_label }}
                        </span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-slate-200 rounded-full h-3 mb-4">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-1000"
                            style="width: {{ $order->shipment->status_progress }}%"></div>
                    </div>

                    <div class="flex justify-between items-center">
                        <button onclick="updateShippingStatus({{ $order->shipment->id }})"
                            class="bg-purple-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-purple-700 transition-colors duration-200">
                            Update Status
                        </button>
                        <button onclick="simulateProgress({{ $order->shipment->id }})"
                            class="bg-slate-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-slate-700 transition-colors duration-200">
                            Simulate Progress
                        </button>
                        <a href="{{ route('shipping.label', $order->shipment->id) }}" target="_blank"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-emerald-700 transition-colors duration-200">
                            Print Label
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Customer Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Customer Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-xl p-6">
                        <h3 class="font-semibold text-slate-900 mb-3">Customer Details</h3>
                        <div class="space-y-2 text-slate-600">
                            <p class="font-medium text-slate-900">{{ $order->user->name }}</p>
                            <p>{{ $order->user->email }}</p>
                            @if($order->user->phone)
                            <p>{{ $order->user->phone }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-6">
                        <h3 class="font-semibold text-slate-900 mb-3">Shipping Address</h3>
                        <div class="space-y-1 text-slate-600">
                            @php
                            $shippingAddress = json_decode($order->shipping_address, true);
                            @endphp
                            <p class="font-medium text-slate-900">{{ $shippingAddress['full_name'] }}</p>
                            <p>{{ $shippingAddress['address'] }}</p>
                            <p>{{ $shippingAddress['city'] }}, {{ $shippingAddress['postal_code'] }}</p>
                            <p>{{ $shippingAddress['country'] }}</p>
                            <p class="mt-2">{{ $shippingAddress['phone'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items (Seller's Products Only) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Your Products in This Order</h2>

                <div class="space-y-4">
                    @foreach($sellerOrderItems as $item)
                    <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-xl">
                        <div class="flex-shrink-0">
                            @if($item->product->images && count($item->product->images) > 0)
                            <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg"
                                onerror="this.src='https://via.placeholder.com/64x64?text=No+Image'">
                            @else
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-slate-900 truncate">{{ $item->product->name }}</h3>
                            <p class="text-sm text-slate-600">SKU: {{ $item->product->sku ?? 'N/A' }}</p>
                            @if($item->size || $item->color)
                            <div class="flex space-x-2 mt-1">
                                @if($item->size)
                                <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded">{{ $item->size
                                    }}</span>
                                @endif
                                @if($item->color)
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ $item->color
                                    }}</span>
                                @endif
                            </div>
                            @endif
                        </div>

                        <div class="text-right">
                            <p class="font-semibold text-slate-900">Qty: {{ $item->quantity }}</p>
                            <p class="text-sm text-slate-600">Unit: Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                            <p class="text-lg font-bold text-slate-900">Rp {{ number_format($item->price *
                                $item->quantity, 0, ',', '.') }}</p>
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

                <!-- Order Details -->
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Order Number</span>
                        <span class="font-semibold text-slate-900">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Order Date</span>
                        <span class="font-semibold text-slate-900">{{ $order->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Payment Method</span>
                        <span class="font-semibold text-slate-900">Cash on Delivery</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Total Items</span>
                        <span class="font-semibold text-slate-900">{{ $sellerOrderItems->sum('quantity') }}</span>
                    </div>

                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-slate-900">Your Revenue</span>
                            <span class="text-2xl font-bold text-slate-900">
                                Rp {{ number_format($sellerOrderItems->sum(function($item) { return $item->price *
                                $item->quantity; }), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                    @if(!$order->shipment && $order->status === 'processing')
                    <button onclick="openShippingModal({{ $order->id }})"
                        class="w-full gradient-primary text-white text-center py-3 px-6 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300">
                        Create Shipment
                    </button>
                    @else
                    <button onclick="openStatusModal({{ $order->id }}, '{{ $order->status }}')"
                        class="w-full gradient-primary text-white text-center py-3 px-6 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300">
                        Update Order Status
                    </button>
                    @endif
                    @endif

                    <a href="{{ route('seller.orders.index') }}"
                        class="w-full bg-slate-100 text-slate-700 text-center py-3 px-6 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 block">
                        Back to Orders
                    </a>
                </div>

                <!-- Contact Customer -->
                <div class="mt-8 pt-6 border-t border-slate-200 text-center">
                    <p class="text-sm text-slate-600 mb-2">Need to contact customer?</p>
                    <a href="mailto:{{ $order->user->email }}"
                        class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                        Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold text-slate-900 mb-4">Update Order Status</h3>
            <form id="statusForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">New Status</label>
                        <select name="status" id="statusSelect"
                            class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="pending">Order Confirmed</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="out_for_delivery">Out for Delivery</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tracking Number (Optional)</label>
                        <input type="text" name="tracking_number"
                            class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="Enter tracking number">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Notes (Optional)</label>
                        <textarea name="notes" rows="3"
                            class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="Add any notes about this status update"></textarea>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6">
                    <button type="submit"
                        class="flex-1 gradient-primary text-white py-2 px-4 rounded-xl font-medium hover:shadow-lg transition-all duration-200">
                        Update Status
                    </button>
                    <button type="button" onclick="closeStatusModal()"
                        class="flex-1 bg-slate-100 text-slate-700 py-2 px-4 rounded-xl font-medium hover:bg-slate-200 transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Shipment Modal -->
<div id="shippingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6">
            <h3 class="text-xl font-bold text-slate-900 mb-4">Create Shipment</h3>
            <form id="shippingForm" onsubmit="createShipment(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Courier Service</label>
                        <select id="courierSelect" onchange="updateShippingCost()"
                            class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Select Courier</option>
                            <option value="jne|REG">🚚 JNE Regular (2-3 days)</option>
                            <option value="jne|YES">🚚 JNE YES (1 day)</option>
                            <option value="jnt|REG">📦 J&T Regular (2-3 days)</option>
                            <option value="sicepat|REG">⚡ SiCepat Regular (2-3 days)</option>
                            <option value="pos|REG">📮 Pos Regular (3-5 days)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Package Weight (kg)</label>
                        <input type="number" id="weightInput" step="0.1" min="0.1" value="1"
                            onchange="updateShippingCost()"
                            class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Shipping Cost</label>
                        <div id="shippingCost"
                            class="w-full px-4 py-2 bg-slate-100 border border-slate-300 rounded-xl text-slate-700">
                            Select courier to calculate cost
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6">
                    <button type="submit"
                        class="flex-1 gradient-primary text-white py-2 px-4 rounded-xl font-medium hover:shadow-lg transition-all duration-200">
                        Create Shipment
                    </button>
                    <button type="button" onclick="closeShippingModal()"
                        class="flex-1 bg-slate-100 text-slate-700 py-2 px-4 rounded-xl font-medium hover:bg-slate-200 transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentOrderId = null;
    let currentShipmentId = null;
    let shippingCostData = {};

    function openStatusModal(orderId, currentStatus) {
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusForm').action = `/seller/orders/${orderId}/update-status`;
        document.getElementById('statusSelect').value = currentStatus;
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function openShippingModal(orderId) {
        currentOrderId = orderId;
        document.getElementById('shippingModal').classList.remove('hidden');
    }

    function closeShippingModal() {
        document.getElementById('shippingModal').classList.add('hidden');
        currentOrderId = null;
    }

    function updateShippingCost() {
        const courierSelect = document.getElementById('courierSelect');
        const weightInput = document.getElementById('weightInput');
        const shippingCostDiv = document.getElementById('shippingCost');

        if (!courierSelect.value || !weightInput.value) {
            shippingCostDiv.textContent = 'Select courier and enter weight';
            return;
        }

        const [courierCode, serviceCode] = courierSelect.value.split('|');
        const weight = parseFloat(weightInput.value);

        // Mock shipping cost calculation
        const costs = {
            'jne|REG': 9000,
            'jne|YES': 15000,
            'jnt|REG': 8500,
            'sicepat|REG': 8000,
            'pos|REG': 7500
        };

        const baseCost = costs[courierSelect.value] || 8000;
        const totalCost = baseCost * Math.max(weight, 1) * 1.2; // Distance multiplier

        shippingCostData = {
            courier_code: courierCode,
            service_code: serviceCode,
            shipping_cost: totalCost,
            weight: weight
        };

        shippingCostDiv.textContent = `Rp ${totalCost.toLocaleString('id-ID')}`;
    }

    async function createShipment(event) {
        event.preventDefault();

        if (!currentOrderId || !shippingCostData.courier_code) {
            alert('Please select a courier service');
            return;
        }

        try {
            const response = await fetch(`/shipping/orders/${currentOrderId}/create-shipment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(shippingCostData)
            });

            const result = await response.json();

            if (result.success) {
                alert('Shipment created successfully!');
                location.reload();
            } else {
                alert('Error creating shipment: ' + (result.error || 'Unknown error'));
            }
        } catch (error) {
            alert('Error creating shipment: ' + error.message);
        }
    }

    async function updateShippingStatus(shipmentId) {
        try {
            const response = await fetch(`/shipping/shipments/${shipmentId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: 'in_transit',
                    description: 'Package status updated by seller',
                    location: 'Sorting Center'
                })
            });

            const result = await response.json();

            if (result.success) {
                alert('Shipping status updated successfully!');
                location.reload();
            } else {
                alert('Error updating status: ' + (result.error || 'Unknown error'));
            }
        } catch (error) {
            alert('Error updating status: ' + error.message);
        }
    }

    async function simulateProgress(shipmentId) {
        try {
            const response = await fetch(`/shipping/shipments/${shipmentId}/simulate-progress`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                alert('Shipping progress simulated!');
                location.reload();
            } else {
                alert('Error simulating progress: ' + (result.error || 'Unknown error'));
            }
        } catch (error) {
            alert('Error simulating progress: ' + error.message);
        }
    }
</script>
@endsection