@extends('layouts.app')

@section('title', 'Order Management - Faciona Seller')

@section('content')
<!-- Professional Header -->
<div class="bg-gradient-to-r from-slate-50 to-purple-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Order Management</h1>
                <p class="text-lg text-slate-600">Manage and track all orders for your products</p>
            </div>
            <div class="mt-6 lg:mt-0 flex items-center space-x-4">
                <a href="{{ route('seller.orders.analytics') }}"
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold hover:bg-slate-800 transition-colors duration-200">
                    📊 Analytics
                </a>
                <div class="text-right">
                    <p class="text-sm text-slate-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $statusCounts['all'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Pending Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $statusCounts['pending'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Processing</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $statusCounts['processing'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Monthly Revenue</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
        <form method="GET" action="{{ route('seller.orders.index') }}" class="space-y-4">
            <!-- Filter Tabs -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('seller.orders.index', ['status' => 'all']) }}"
                    class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status', 'all') === 'all' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    All Orders ({{ $statusCounts['all'] }})
                </a>
                <a href="{{ route('seller.orders.index', ['status' => 'pending']) }}"
                    class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'pending' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Pending ({{ $statusCounts['pending'] }})
                </a>
                <a href="{{ route('seller.orders.index', ['status' => 'processing']) }}"
                    class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'processing' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Processing ({{ $statusCounts['processing'] }})
                </a>
                <a href="{{ route('seller.orders.index', ['status' => 'shipped']) }}"
                    class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'shipped' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Shipped ({{ $statusCounts['shipped'] }})
                </a>
                <a href="{{ route('seller.orders.index', ['status' => 'delivered']) }}"
                    class="px-4 py-2 rounded-xl font-medium transition-colors duration-200 {{ request('status') === 'delivered' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Delivered ({{ $statusCounts['delivered'] }})
                </a>
            </div>

            <!-- Search and Date Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Order number or customer name"
                        class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full gradient-primary text-white py-2 px-4 rounded-xl font-medium hover:shadow-lg transition-all duration-200">
                        Filter Orders
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    @if($orders->count() > 0)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
        <form id="bulkActionForm" method="POST" action="{{ route('seller.orders.bulk-update-status') }}">
            @csrf
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-slate-700">Bulk Actions:</label>
                    <select name="status"
                        class="px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">Select Action</option>
                        <option value="processing">Mark as Processing</option>
                        <option value="shipped">Mark as Shipped</option>
                        <option value="out_for_delivery">Mark as Out for Delivery</option>
                        <option value="delivered">Mark as Delivered</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-slate-900 text-white px-6 py-2 rounded-xl font-medium hover:bg-slate-800 transition-colors duration-200"
                    onclick="return confirm('Are you sure you want to update the selected orders?')">
                    Apply to Selected
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Orders List -->
    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
            <!-- Order Header -->
            <div class="bg-slate-50 px-8 py-6 border-b border-slate-200">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center space-x-4 mb-4 lg:mb-0">
                        <input type="checkbox" name="order_ids[]" value="{{ $order->id }}" form="bulkActionForm"
                            class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $order->order_number }}</h3>
                            <p class="text-slate-600">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                            <p class="text-sm text-slate-500">Customer: {{ $order->user->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                        <span class="text-2xl font-bold text-slate-900">
                            {{ $order->formatted_total }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items Preview -->
            <div class="px-8 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    @foreach($order->orderItems->take(3) as $item)
                    @if(auth()->user()->products->contains($item->product_id))
                    <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-xl">
                        <div class="flex-shrink-0">
                            @if($item->product->images && count($item->product->images) > 0)
                            <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg"
                                onerror="this.src='https://via.placeholder.com/48x48?text=No+Image'">
                            @else
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
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
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $item->product->name }}</p>
                            <p class="text-xs text-slate-600">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('seller.orders.show', $order->id) }}"
                        class="bg-slate-900 text-white px-4 py-2 rounded-xl font-medium hover:bg-slate-800 transition-colors duration-200">
                        View Details
                    </a>

                    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                    <button onclick="openStatusModal({{ $order->id }}, '{{ $order->status }}')"
                        class="bg-purple-100 text-purple-700 px-4 py-2 rounded-xl font-medium hover:bg-purple-200 transition-colors duration-200">
                        Update Status
                    </button>
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
            <div
                class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-slate-900 mb-4">No Orders Yet</h2>
            <p class="text-xl text-slate-600 mb-8">Orders for your products will appear here once customers start
                purchasing.</p>

            <a href="{{ route('seller.products.index') }}"
                class="gradient-primary text-white py-4 px-8 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                Manage Products
            </a>
        </div>
    </div>
    @endif
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

<script>
    function openStatusModal(orderId, currentStatus) {
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusForm').action = `/seller/orders/${orderId}/update-status`;
        document.getElementById('statusSelect').value = currentStatus;
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }
</script>
@endsection