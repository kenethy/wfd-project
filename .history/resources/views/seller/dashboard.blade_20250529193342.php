@extends('layouts.app')

@section('title', 'Seller Dashboard - Faciona')

@section('content')
<!-- Hero Header -->
<div class="bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="text-white space-y-4 mb-8 lg:mb-0">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold">Dashboard Seller</h1>
                        <p class="text-purple-200">Kelola bisnis fashion Anda dengan mudah</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2 text-purple-100">
                    <span class="text-2xl">👋</span>
                    <span class="text-lg">Selamat datang kembali, <span class="font-semibold text-white">{{
                            auth()->user()->name }}</span>!</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('seller.products.create') }}"
                    class="gradient-secondary text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center space-x-2 shadow-modern">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>✨ Tambah Produk</span>
                </a>
                <a href="{{ route('seller.products.index') }}"
                    class="border-2 border-white/30 text-white px-6 py-3 rounded-full font-semibold hover:bg-white/10 transition-all duration-200 flex items-center space-x-2 backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                    </svg>
                    <span>📦 Kelola Produk</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                fill="white" />
        </svg>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <!-- Total Products -->
        <div
            class="group bg-white rounded-2xl shadow-modern p-6 border border-slate-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-2xl">📦</span>
                        <p class="text-slate-600 text-sm font-semibold">Total Produk</p>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalProducts }}</p>
                    <p class="text-sm text-emerald-600 font-medium">{{ $activeProducts }} produk aktif</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div
            class="group bg-white rounded-2xl shadow-modern p-6 border border-slate-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-2xl">🛒</span>
                        <p class="text-slate-600 text-sm font-semibold">Total Pesanan</p>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalOrders }}</p>
                    <p class="text-sm text-emerald-600 font-medium">Semua waktu</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-green-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div
            class="group bg-white rounded-2xl shadow-modern p-6 border border-slate-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-2xl">💰</span>
                        <p class="text-slate-600 text-sm font-semibold">Total Pendapatan</p>
                    </div>
                    <p
                        class="text-2xl font-bold text-gradient bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-emerald-600 font-medium">Semua waktu</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div
            class="group bg-white rounded-2xl shadow-modern p-6 border border-slate-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-2xl">⚠️</span>
                        <p class="text-slate-600 text-sm font-semibold">Stok Rendah</p>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $lowStockProducts }}</p>
                    <p class="text-sm text-red-500 font-medium">Perlu perhatian</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-red-100 to-orange-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sales Chart -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Penjualan 6 Bulan Terakhir</h2>
                <div class="flex space-x-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Trend Positif
                    </span>
                </div>
            </div>

            <!-- Simple Chart Visualization -->
            <div class="space-y-4">
                @foreach($monthlySales as $index => $monthData)
                <div class="flex items-center space-x-4">
                    <div class="w-16 text-sm text-gray-600 font-medium">{{ $monthData['month'] }}</div>
                    <div class="flex-1 bg-gray-200 rounded-full h-6 relative">
                        @php
                        $maxSales = collect($monthlySales)->max('sales');
                        $percentage = $maxSales > 0 ? ($monthData['sales'] / $maxSales) * 100 : 0;
                        @endphp
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-6 rounded-full transition-all duration-500 ease-out flex items-center justify-end pr-2"
                            style="width: {{ $percentage }}%">
                            @if($monthData['sales'] > 0)
                            <span class="text-white text-xs font-medium">Rp {{ number_format($monthData['sales'] / 1000,
                                0) }}K</span>
                            @endif
                        </div>
                    </div>
                    <div class="w-24 text-right text-sm text-gray-900 font-medium">
                        Rp {{ number_format($monthData['sales'], 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Aktivitas Terbaru</h2>
            <div class="space-y-4">
                @forelse($recentActivity as $activity)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                                @if($activity['color'] === 'green') bg-green-100
                                @elseif($activity['color'] === 'red') bg-red-100
                                @else bg-blue-100
                                @endif">
                            @if($activity['icon'] === 'shopping-cart')
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6m0 0L4 5M7 13h10m0 0l1.5 6M17 13l1.5-6">
                                </path>
                            </svg>
                            @else
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900">{{ $activity['message'] }}</p>
                        <p class="text-xs text-gray-500">{{ $activity['time']->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m13-8V4a1 1 0 00-1-1H7a1 1 0 00-1 1v1m8 0V4a1 1 0 00-1-1H9a1 1 0 00-1 1v1">
                        </path>
                    </svg>
                    <p class="text-gray-500 text-sm mt-2">Belum ada aktivitas</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Top Products & Low Stock Alert -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        <!-- Top Selling Products -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Produk Terlaris</h2>
            <div class="space-y-4">
                @forelse($topProducts as $index => $product)
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 flex items-center justify-center">
                            <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $product->product->name }}</p>
                        <p class="text-xs text-gray-500">{{ $product->total_sold }} terjual</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">Rp {{ number_format($product->total_revenue, 0,
                            ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                    </svg>
                    <p class="text-gray-500 text-sm mt-2">Belum ada penjualan</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Peringatan Stok Rendah</h2>
            <div class="space-y-4">
                @forelse($lowStockAlert as $product)
                <div class="flex items-center space-x-4 p-3 bg-red-50 rounded-lg border border-red-200">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                        <p class="text-xs text-red-600">Stok tersisa: {{ $product->stock }}</p>
                    </div>
                    <div>
                        <a href="{{ route('seller.products.edit', $product->id) }}"
                            class="text-xs bg-red-600 text-white px-3 py-1 rounded-full hover:bg-red-700">
                            Update
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-600 text-sm mt-2">Semua stok aman!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 rounded-2xl shadow-xl p-8">
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white">Quick Actions</h2>
            </div>
            <p class="text-white/80 text-lg">Manage your store efficiently</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Manage Products -->
            <div class="group">
                <a href="{{ route('seller.products.index') }}"
                    class="flex flex-col items-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl text-white no-underline">
                    <div
                        class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-white/30 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 text-center">Manage Products</h3>
                    <p class="text-white/80 text-sm text-center leading-relaxed">Manage your product catalog</p>
                </a>
            </div>

            <!-- Manage Orders -->
            <div class="group">
                <a href="{{ route('seller.orders.index') }}"
                    class="flex flex-col items-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl text-white no-underline">
                    <div
                        class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-white/30 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 text-center">Manage Orders</h3>
                    <p class="text-white/80 text-sm text-center leading-relaxed">Process customer orders</p>
                </a>
            </div>

            <!-- Analytics -->
            <div class="group">
                <a href="{{ route('seller.orders.analytics') }}"
                    class="flex flex-col items-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl text-white no-underline">
                    <div
                        class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-white/30 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 text-center">Analytics</h3>
                    <p class="text-white/80 text-sm text-center leading-relaxed">View sales performance</p>
                </a>
            </div>

            <!-- Add Product -->
            <div class="group">
                <a href="{{ route('seller.products.create') }}"
                    class="flex flex-col items-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl text-white no-underline">
                    <div
                        class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-white/30 transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 text-center">Add Product</h3>
                    <p class="text-white/80 text-sm text-center leading-relaxed">Create new listing</p>
                </a>
            </div>
        </div>

        <!-- Additional Quick Stats -->
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-white">{{ $totalProducts ?? 0 }}</div>
                <div class="text-white/70 text-sm">Total Products</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-white">{{ $pendingOrders ?? 0 }}</div>
                <div class="text-white/70 text-sm">Pending Orders</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-white">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}
                </div>
                <div class="text-white/70 text-sm">Monthly Revenue</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-white">{{ $totalOrders ?? 0 }}</div>
                <div class="text-white/70 text-sm">Total Orders</div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all Quick Action links
        const quickActionLinks = document.querySelectorAll('a[href*="seller/"]');

        console.log('Found Quick Action links:', quickActionLinks.length);

        quickActionLinks.forEach((link, index) => {
            console.log(`Link ${index + 1}:`, link.href);

            // Ensure links are clickable
            link.style.cursor = 'pointer';
            link.style.pointerEvents = 'auto';

            // Add click event listener
            link.addEventListener('click', function (e) {
                console.log('Link clicked:', this.href);

                // Add visual feedback
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);

                // Force navigation if needed
                setTimeout(() => {
                    window.location.href = this.href;
                }, 200);
            });

            // Add hover effects
            link.addEventListener('mouseenter', function () {
                this.style.transform = 'scale(1.02)';
            });

            link.addEventListener('mouseleave', function () {
                this.style.transform = '';
            });
        });

        // Alternative: Add direct click handlers to the grid items
        const gridItems = document.querySelectorAll('.grid .group');
        gridItems.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                item.style.cursor = 'pointer';
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Grid item clicked, navigating to:', link.href);
                    window.location.href = link.href;
                });
            }
        });
    });
</script>
@endsection