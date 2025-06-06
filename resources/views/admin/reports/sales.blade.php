@extends('layouts.app')

@section('title', 'Sales Report - Admin')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Sales Report</h1>
                <p class="text-slate-300 mt-2">Comprehensive sales analytics and insights</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Summary Statistics -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalOrders) }}</p>
                </div>
            </div>
        </div>

        <!-- Average Order Value -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Average Order Value</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($averageOrderValue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales by Category -->
    @if($salesByCategory->count() > 0)
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Sales by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($salesByCategory as $category)
            <div class="bg-slate-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-slate-900">{{ $category->name }}</h3>
                        <p class="text-sm text-slate-600">Category Sales</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-slate-900">Rp {{ number_format($category->total_sales, 0, ',', '.') }}</p>
                        <p class="text-sm text-slate-500">{{ number_format(($category->total_sales / $totalRevenue) * 100, 1) }}%</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Filters -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-8">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Filter Sales Data</h2>
        <form method="GET" action="{{ route('admin.reports.sales') }}" class="flex flex-wrap items-center gap-4">
            <!-- Date Range -->
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">From:</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                    class="px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">To:</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                    class="px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Category Filter -->
            <select name="category" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <!-- Amount Range -->
            <input type="number" name="min_amount" value="{{ request('min_amount') }}" placeholder="Min Amount"
                class="w-32 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            <input type="number" name="max_amount" value="{{ request('max_amount') }}" placeholder="Max Amount"
                class="w-32 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">

            <!-- Filter Button -->
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                Apply Filters
            </button>

            <!-- Clear Filters -->
            @if(request()->hasAny(['date_from', 'date_to', 'category', 'min_amount', 'max_amount']))
            <a href="{{ route('admin.reports.sales') }}" class="text-slate-600 hover:text-purple-600 px-4 py-2 border border-slate-300 rounded-lg hover:border-purple-300 transition-colors duration-200">
                Clear
            </a>
            @endif
        </form>
    </div>

    <!-- Sales Data Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Sales Transactions</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-slate-900">#{{ $order->order_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-slate-900">{{ $order->user->name }}</div>
                            <div class="text-sm text-slate-500">{{ $order->user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-slate-900">
                                @foreach($order->orderItems->take(2) as $item)
                                <div>{{ $item->product->name }} ({{ $item->quantity }}x)</div>
                                @endforeach
                                @if($order->orderItems->count() > 2)
                                <div class="text-slate-500">+{{ $order->orderItems->count() - 2 }} more items</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                            {{ $order->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No sales data found</p>
                                <p class="text-sm">Try adjusting your filter criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="bg-white px-4 py-3 border-t border-slate-200 sm:px-6">
            {{ $orders->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
