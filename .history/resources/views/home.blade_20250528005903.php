@extends('layouts.app')

@section('title', 'Faciona - Fashion for Gen Z')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="text-white space-y-8">
                <div class="space-y-4">
                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                        <span class="block">Fashion</span>
                        <span
                            class="block text-gradient bg-gradient-to-r from-pink-400 to-purple-400 bg-clip-text text-transparent">untuk
                            Gen Z</span>
                    </h1>
                    <p class="text-xl lg:text-2xl text-purple-100 max-w-lg">
                        Ekspresikan style unikmu dengan koleksi fashion terdepan. Dari streetwear hingga formal, semua
                        ada di Faciona! ✨
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#products"
                        class="gradient-primary text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 text-center shadow-modern">
                        🛍️ Mulai Belanja
                    </a>
                    <a href="#categories"
                        class="border-2 border-white/30 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/10 transition-all duration-300 text-center backdrop-blur-sm">
                        📱 Jelajahi Kategori
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">10K+</div>
                        <div class="text-purple-200 text-sm">Produk Fashion</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">50K+</div>
                        <div class="text-purple-200 text-sm">Happy Customers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">1K+</div>
                        <div class="text-purple-200 text-sm">Brand Partners</div>
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="relative">
                <div class="relative z-10">
                    <div
                        class="bg-gradient-to-br from-pink-400 to-purple-600 rounded-3xl p-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                        <div class="bg-white rounded-2xl p-6 space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">F</span>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800">Faciona App</div>
                                    <div class="text-sm text-gray-500">Virtual Try-On Ready</div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div
                                    class="h-32 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center">
                                    <span class="text-4xl">👗</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-3 bg-gray-200 rounded-full"></div>
                                    <div class="h-3 bg-gray-200 rounded-full w-3/4"></div>
                                </div>
                                <div class="flex space-x-2">
                                    <div class="flex-1 h-8 gradient-secondary rounded-lg"></div>
                                    <div class="w-8 h-8 border-2 border-purple-300 rounded-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Floating Elements -->
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-pink-400 rounded-full opacity-60 animate-pulse"></div>
                <div class="absolute -bottom-6 -left-6 w-16 h-16 bg-purple-400 rounded-full opacity-40 animate-bounce">
                </div>
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

    <!-- Search and Filter Section -->
    <div id="products" class="bg-white rounded-2xl shadow-modern p-8 mb-12 border border-slate-200/50">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-800 mb-2">🔍 Temukan Fashion Impianmu</h2>
            <p class="text-slate-600">Filter dan cari produk sesuai style dan budgetmu</p>
        </div>

        <form method="GET" action="{{ route('home') }}" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search -->
                <div class="space-y-2">
                    <label for="search" class="block text-sm font-semibold text-slate-700">🔎 Cari Produk</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Cari fashion favoritmu..."
                            class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="space-y-2">
                    <label for="category" class="block text-sm font-semibold text-slate-700">📂 Kategori</label>
                    <select name="category" id="category"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div class="space-y-2">
                    <label for="min_price" class="block text-sm font-semibold text-slate-700">💰 Harga Min</label>
                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}"
                        placeholder="Rp 0"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                </div>

                <div class="space-y-2">
                    <label for="max_price" class="block text-sm font-semibold text-slate-700">💎 Harga Max</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}"
                        placeholder="Rp 1.000.000"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
                <button type="submit"
                    class="gradient-primary text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200 shadow-modern">
                    🚀 Cari Sekarang
                </button>
                <a href="{{ route('home') }}"
                    class="text-slate-600 hover:text-purple-600 font-medium transition-colors duration-200 flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    <span>Reset Filter</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <!-- Product Image -->
            <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                @if($product->images && count($product->images) > 0)
                <img src="{{ asset('storage/products/' . $product->images[0]) }}" alt="{{ $product->name }}"
                    class="w-full h-48 object-cover"
                    onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No Image</span>
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ $product->category->name }}</p>
                <p class="text-sm text-gray-500 mb-3">by {{ $product->seller->name }}</p>

                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-blue-600">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-gray-500">
                        Stok: {{ $product->stock }}
                    </span>
                </div>

                <!-- Action Button -->
                <div class="mt-4">
                    <a href="{{ route('products.show', $product->slug) }}"
                        class="w-full bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200 block">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-400 text-lg">
                <svg class="mx-auto h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m13-8V4a1 1 0 00-1-1H7a1 1 0 00-1 1v1m8 0V4a1 1 0 00-1-1H9a1 1 0 00-1 1v1">
                    </path>
                </svg>
                <p>Tidak ada produk yang ditemukan</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-8">
        {{ $products->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection