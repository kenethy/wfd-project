@extends('layouts.app')

@section('title', 'Order Analytics - Faciona Seller')

@section('content')
<!-- Professional Header -->
<div class="bg-gradient-to-r from-slate-50 to-purple-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6" aria-label="Breadcrumb">
            <a href="{{ route('seller.dashboard') }}" class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Dashboard
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('seller.orders.index') }}" class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Orders
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">Analytics</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Order Analytics</h1>
                <p class="text-lg text-slate-600">Comprehensive insights into your order performance</p>
            </div>
            <div class="mt-6 lg:mt-0 flex items-center space-x-4">
                <a href="{{ route('seller.orders.index') }}" 
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold hover:bg-slate-800 transition-colors duration-200">
                    📋 Back to Orders
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Total Revenue -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-sm text-emerald-600">All time</p>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">This Month</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                    <p class="text-sm text-purple-600">{{ now()->format('F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalOrders }}</p>
                    <p class="text-sm text-blue-600">All time</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Pending Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $pendingOrders }}</p>
                    <p class="text-sm text-orange-600">Need attention</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Top Selling Products</h2>
        
        @if($topProducts->count() > 0)
        <div class="space-y-4">
            @foreach($topProducts as $index => $productData)
            <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-xl">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">#{{ $index + 1 }}</span>
                    </div>
                </div>
                
                <div class="flex-shrink-0">
                    @if($productData->product->images && count($productData->product->images) > 0)
                    <img src="{{ asset('storage/products/' . $productData->product->images[0]) }}"
                        alt="{{ $productData->product->name }}" 
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
                    <h3 class="font-semibold text-slate-900 truncate">{{ $productData->product->name }}</h3>
                    <p class="text-sm text-slate-600">{{ $productData->product->category->name ?? 'Uncategorized' }}</p>
                    <p class="text-sm text-slate-500">SKU: {{ $productData->product->sku ?? 'N/A' }}</p>
                </div>
                
                <div class="text-right">
                    <p class="text-lg font-bold text-slate-900">{{ $productData->total_sold }} sold</p>
                    <p class="text-sm text-slate-600">Rp {{ number_format($productData->product->price * $productData->total_sold, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No Sales Data Yet</h3>
            <p class="text-slate-600 mb-6">Start selling your products to see analytics here.</p>
            <a href="{{ route('seller.products.index') }}"
                class="gradient-primary text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                Manage Products
            </a>
        </div>
        @endif
    </div>

    <!-- Performance Insights -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Revenue Breakdown -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Revenue Insights</h2>
            
            <div class="space-y-6">
                <div class="flex items-center justify-between p-4 bg-emerald-50 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Total Revenue</p>
                            <p class="text-sm text-slate-600">All completed orders</p>
                        </div>
                    </div>
                    <p class="text-xl font-bold text-emerald-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>

                <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0v1a2 2 0 002 2h4a2 2 0 002-2V7m-6 0h6M5 21h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Monthly Revenue</p>
                            <p class="text-sm text-slate-600">{{ now()->format('F Y') }}</p>
                        </div>
                    </div>
                    <p class="text-xl font-bold text-purple-600">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                </div>

                @if($totalRevenue > 0)
                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Average Order Value</p>
                            <p class="text-sm text-slate-600">Per completed order</p>
                        </div>
                    </div>
                    <p class="text-xl font-bold text-blue-600">Rp {{ number_format($totalRevenue / max($totalOrders, 1), 0, ',', '.') }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Order Status Overview -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Status Overview</h2>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
                        <span class="text-slate-700">Pending Orders</span>
                    </div>
                    <span class="font-semibold text-slate-900">{{ $pendingOrders }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                        <span class="text-slate-700">Total Orders</span>
                    </div>
                    <span class="font-semibold text-slate-900">{{ $totalOrders }}</span>
                </div>

                @if($totalOrders > 0)
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-slate-600">Completion Rate</span>
                        <span class="text-sm font-semibold text-slate-900">{{ round((($totalOrders - $pendingOrders) / $totalOrders) * 100, 1) }}%</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-emerald-500 to-green-500 h-2 rounded-full transition-all duration-500" 
                             style="width: {{ round((($totalOrders - $pendingOrders) / $totalOrders) * 100, 1) }}%"></div>
                    </div>
                </div>
                @endif
            </div>

            @if($pendingOrders > 0)
            <div class="mt-6 pt-6 border-t border-slate-200">
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-orange-900">Action Required</p>
                            <p class="text-sm text-orange-700">You have {{ $pendingOrders }} pending orders that need processing.</p>
                        </div>
                    </div>
                    <a href="{{ route('seller.orders.index', ['status' => 'pending']) }}" 
                        class="mt-3 inline-block bg-orange-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-700 transition-colors duration-200">
                        Process Orders
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
