@extends('layouts.app')

@section('title', 'Order History - Faciona')

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
            <span class="text-slate-800 font-medium">Order History</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Order History</h1>
                <p class="text-lg text-slate-600">Track and manage all your orders</p>
            </div>
            <div class="mt-6 lg:mt-0">
                <a href="{{ route('products.index') }}" 
                    class="gradient-primary text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Filter Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('customer.orders.index', ['status' => 'all']) }}" 
                class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status', 'all') === 'all' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                All Orders ({{ $statusCounts['all'] ?? 0 }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'pending']) }}" 
                class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'pending' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Confirmed ({{ $statusCounts['pending'] ?? 0 }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'processing']) }}" 
                class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'processing' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Processing ({{ $statusCounts['processing'] ?? 0 }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'shipped']) }}" 
                class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'shipped' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Shipped ({{ $statusCounts['shipped'] ?? 0 }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'delivered']) }}" 
                class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'delivered' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Delivered ({{ $statusCounts['delivered'] ?? 0 }})
            </a>
        </div>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <!-- Order Header -->
                    <div class="bg-slate-50 px-8 py-6 border-b border-slate-200">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <div class="mb-4 lg:mb-0">
                                <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $order->order_number }}</h3>
                                <p class="text-slate-600">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                                <span class="text-2xl font-bold text-slate-900">
                                    {{ $order->formatted_total }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Progress -->
                    <div class="px-8 py-4 bg-gradient-to-r from-slate-50 to-purple-50">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-slate-700">Order Progress</span>
                            <span class="text-sm text-slate-600">{{ $order->status_progress }}% Complete</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all duration-300" 
                                 style="width: {{ $order->status_progress }}%"></div>
                        </div>
                    </div>

                    <!-- Order Items Preview -->
                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($order->orderItems->take(3) as $item)
                            <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-xl">
                                <div class="flex-shrink-0">
                                    @if($item->product->images && count($item->product->images) > 0)
                                    <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                        alt="{{ $item->product->name }}" 
                                        class="w-12 h-12 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/48x48?text=No+Image'">
                                    @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ $item->product->name }}</p>
                                    <p class="text-xs text-slate-600">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($order->orderItems->count() > 3)
                            <div class="flex items-center justify-center p-3 bg-slate-50 rounded-xl border-2 border-dashed border-slate-300">
                                <span class="text-sm text-slate-600">+{{ $order->orderItems->count() - 3 }} more items</span>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('customer.orders.show', $order->id) }}" 
                                class="bg-slate-900 text-white px-4 py-2 rounded-xl font-medium hover:bg-slate-800 transition-colors duration-200">
                                View Details
                            </a>
                            
                            @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                            <a href="{{ route('customer.orders.track', $order->id) }}" 
                                class="bg-purple-100 text-purple-700 px-4 py-2 rounded-xl font-medium hover:bg-purple-200 transition-colors duration-200">
                                Track Order
                            </a>
                            @endif
                            
                            @if($order->canBeCancelled())
                            <form method="POST" action="{{ route('customer.orders.cancel', $order->id) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to cancel this order?')"
                                        class="bg-red-100 text-red-700 px-4 py-2 rounded-xl font-medium hover:bg-red-200 transition-colors duration-200">
                                    Cancel Order
                                </button>
                            </form>
                            @endif
                            
                            @if($order->canBeReordered())
                            <form method="POST" action="{{ route('customer.orders.reorder', $order->id) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-xl font-medium hover:bg-emerald-200 transition-colors duration-200">
                                    Reorder
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $orders->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="max-w-lg mx-auto">
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-slate-900 mb-4">No Orders Yet</h2>
                <p class="text-xl text-slate-600 mb-8">Start shopping to see your orders here.</p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}"
                        class="gradient-primary text-white py-4 px-8 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                        Start Shopping
                    </a>
                    <a href="{{ route('home') }}"
                        class="bg-slate-100 text-slate-700 py-4 px-8 rounded-xl font-semibold text-lg hover:bg-slate-200 transition-colors duration-200 inline-block">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
