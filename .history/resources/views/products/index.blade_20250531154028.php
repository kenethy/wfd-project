@extends('layouts.app')

@section('title', 'Products - Faciona')

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
            <span class="text-slate-800 font-medium">Products</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Discover Fashion</h1>
                <p class="text-lg text-slate-600">Curated collection of premium fashion for the modern generation</p>
            </div>
            <div class="mt-6 lg:mt-0">
                <div class="bg-white rounded-xl px-6 py-3 shadow-sm border border-slate-200">
                    <span class="text-sm text-slate-600">{{ $products->total() }} Products Available</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search Section -->
<div class="bg-white border-b border-slate-200 sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" action="{{ route('products.index') }}"
            class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0 lg:space-x-6">

            <!-- Search Bar -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                        class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filters Row -->
            <div class="flex flex-wrap items-center space-x-4">
                <!-- Category Filter -->
                <select name="category"
                    class="px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                <!-- Price Range -->
                <div class="flex items-center space-x-2">
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price"
                        class="w-24 px-3 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <span class="text-slate-400">-</span>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price"
                        class="w-24 px-3 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <!-- Sort -->
                <select name="sort"
                    class="px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                    <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="price_low" {{ request('sort')=='price_low' ? 'selected' : '' }}>Price: Low to High
                    </option>
                    <option value="price_high" {{ request('sort')=='price_high' ? 'selected' : '' }}>Price: High to Low
                    </option>
                    <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Name A-Z</option>
                </select>

                <!-- Filter Button -->
                <button type="submit"
                    class="gradient-primary text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-200">
                    Apply Filters
                </button>

                <!-- Clear Filters -->
                @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                <a href="{{ route('products.index') }}"
                    class="text-slate-600 hover:text-purple-600 px-4 py-3 border border-slate-300 rounded-xl hover:border-purple-300 transition-colors duration-200">
                    Clear All
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Products Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div
            class="group bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-slate-100 flex flex-col h-full">
            <!-- Product Image -->
            <div class="relative aspect-square bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                @if($product->images && count($product->images) > 0)
                <img src="{{ asset('storage/products/' . $product->images[0]) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    onerror="this.src='https://via.placeholder.com/400x400?text=No+Image'">
                @else
                <div
                    class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                @endif

                <!-- Quick Actions Overlay -->
                <div
                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <a href="{{ route('products.show', $product->slug) }}"
                        class="bg-white text-slate-900 px-6 py-2 rounded-full font-medium hover:bg-slate-100 transition-colors duration-200 transform translate-y-4 group-hover:translate-y-0">
                        View Details
                    </a>
                </div>

                <!-- Category Badge -->
                <div class="absolute top-3 left-3">
                    <span class="bg-white bg-opacity-90 text-slate-700 text-xs font-medium px-2 py-1 rounded-full">
                        {{ $product->category->name }}
                    </span>
                </div>

                <!-- Stock Status -->
                @if($product->stock <= 5) <div class="absolute top-3 right-3">
                    <span class="bg-red-500 text-white text-xs font-medium px-2 py-1 rounded-full">
                        Low Stock
                    </span>
            </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="p-6">
            <div class="mb-3">
                <h3 class="text-lg font-semibold text-slate-900 mb-1 line-clamp-2">{{ $product->name }}</h3>
                <p class="text-sm text-slate-600">by {{ $product->seller->name }}</p>
            </div>

            <!-- Price -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-slate-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>
                <div class="text-sm text-slate-500">
                    {{ $product->stock }} in stock
                </div>
            </div>

            <!-- Action Button -->
            <a href="{{ route('products.show', $product->slug) }}"
                class="w-full bg-slate-900 text-white text-center py-3 px-4 rounded-xl font-medium hover:bg-slate-800 transition-colors duration-200 block">
                View Product
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
@if($products->hasPages())
<div class="mt-16 flex justify-center">
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endif

@else
<!-- Empty State -->
<div class="text-center py-20">
    <div class="max-w-md mx-auto">
        <div
            class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
            <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-2">No Products Found</h3>
        <p class="text-slate-600 mb-6">Try adjusting your search criteria or browse our categories to find what you're
            looking for.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-200">
                View All Products
            </a>
            <a href="{{ route('home') }}"
                class="border border-slate-300 text-slate-700 px-6 py-3 rounded-xl font-medium hover:border-purple-300 hover:text-purple-600 transition-all duration-200">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endif
</div>
@endsection