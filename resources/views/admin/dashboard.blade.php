@extends('layouts.app')

@section('title', 'Admin Dashboard - Faciona')

@section('content')
<!-- Admin Dashboard Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Admin Dashboard</h1>
                <p class="text-slate-300 mt-2">Manage your platform with comprehensive admin tools</p>
            </div>
            <div class="text-right">
                <div class="text-sm text-slate-300">Welcome back,</div>
                <div class="text-lg font-semibold">{{ auth()->user()->name }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Users</p>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_users']) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Products</p>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_products']) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_orders']) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Management Links -->
        <div class="lg:col-span-2">
            <h2 class="text-xl font-bold text-slate-900 mb-4">Quick Management</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-purple-300 transition-all duration-200 group">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-slate-900">Manage Users</h3>
                            <p class="text-sm text-slate-600">{{ $stats['active_users'] }} active users</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.products.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-purple-300 transition-all duration-200 group">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-slate-900">Manage Products</h3>
                            <p class="text-sm text-slate-600">{{ $stats['total_products'] }} products</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-purple-300 transition-all duration-200 group">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-slate-900">Manage Categories</h3>
                            <p class="text-sm text-slate-600">{{ $stats['total_categories'] }} categories</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-purple-300 transition-all duration-200 group">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-slate-900">View Orders</h3>
                            <p class="text-sm text-slate-600">{{ $stats['pending_orders'] }} pending</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-4">Recent Activity</h2>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="space-y-4">
                    @foreach($recent_orders->take(3) as $order)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-900 truncate">
                                Order #{{ $order->order_number }}
                            </p>
                            <p class="text-sm text-slate-500">
                                {{ $order->user->name }} - Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200">
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-purple-600 hover:text-purple-700 font-medium">
                        View all orders →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
