@extends('layouts.app')

@section('title', $product->name . ' - Faciona')

@section('content')
<!-- Modern Breadcrumb -->
<div class="bg-gradient-to-r from-purple-50 via-blue-50 to-indigo-50 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="flex items-center space-x-2 text-sm" aria-label="Breadcrumb">
            <a href="{{ route('home') }}"
                class="flex items-center space-x-1 text-slate-600 hover:text-purple-600 transition-colors duration-200 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="font-medium">Home</span>
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-500">{{ $product->category->name }}</span>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-semibold">{{ Str::limit($product->name, 30) }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Product Images Gallery -->
        <div class="space-y-6">
            <!-- Main Image Container -->
            <div class="relative group">
                <div
                    class="aspect-square bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl overflow-hidden shadow-modern border border-slate-200/50">
                    @if($product->images && count($product->images) > 0)
                    <img id="mainImage" src="{{ asset('storage/products/' . $product->images[0]) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        onerror="this.src='https://via.placeholder.com/600x600?text=No+Image'">
                    @else
                    <div
                        class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                        <div class="text-center space-y-4">
                            <span class="text-8xl">👗</span>
                            <p class="text-slate-500 font-medium">No Image Available</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Image Actions Overlay -->
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 rounded-3xl flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <div class="flex space-x-3">
                        <button
                            class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <button
                            class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Badge for New/Sale -->
                <div class="absolute top-4 left-4">
                    <span
                        class="bg-gradient-secondary text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg">
                        ✨ New Arrival
                    </span>
                </div>
            </div>

            <!-- Thumbnail Gallery -->
            @if($product->images && count($product->images) > 1)
            <div class="flex space-x-3 overflow-x-auto pb-2">
                @foreach($product->images as $index => $image)
                <div class="flex-shrink-0">
                    <img src="{{ asset('storage/products/' . $image) }}" alt="{{ $product->name }}"
                        class="w-20 h-20 object-cover rounded-xl cursor-pointer border-2 transition-all duration-200 hover:scale-105 shadow-hover {{ $index === 0 ? 'border-purple-500 ring-2 ring-purple-200' : 'border-slate-200 hover:border-purple-300' }}"
                        onclick="changeMainImage('{{ asset('storage/products/' . $image) }}', this)"
                        onerror="this.src='https://via.placeholder.com/80x80?text=No+Image'">
                </div>
                @endforeach
            </div>
            @endif

            <!-- Product Features -->
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl p-6 border border-slate-200/50">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center space-x-2">
                    <span class="text-2xl">✨</span>
                    <span>Kenapa Pilih Produk Ini?</span>
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Kualitas Premium</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Pengiriman Cepat</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Garansi Resmi</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Trending Style</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="space-y-8">
            <!-- Product Title & Category -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="bg-purple-100 text-purple-700 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ $product->category->name }}
                    </span>
                    <span class="bg-emerald-100 text-emerald-700 text-sm font-semibold px-3 py-1 rounded-full">
                        ⚡ Fast Shipping
                    </span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-bold text-slate-800 leading-tight">{{ $product->name }}</h1>

                <!-- Rating & Reviews -->
                @if($product->reviews_count > 0)
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-1">
                        @for($i = 1; $i <= 5; $i++) <svg
                            class="w-5 h-5 {{ $i <= floor($product->average_rating) ? 'text-yellow-400 fill-current' : 'text-slate-300 fill-current' }}"
                            viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                    </div>
                    <span class="text-slate-600 font-medium">
                        {{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }} ulasan)
                    </span>
                </div>
                @else
                <div class="flex items-center space-x-1">
                    @for($i = 1; $i <= 5; $i++) <svg class="w-5 h-5 text-slate-300 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @endfor
                        <span class="text-slate-500 ml-2">Belum ada ulasan</span>
                </div>
                @endif
            </div>

            <!-- Price Section -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-200/50">
                <div class="flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-slate-600">Harga Spesial</p>
                        <div class="flex items-center space-x-3">
                            <span
                                class="text-4xl font-bold text-gradient bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <span class="text-lg text-slate-500 line-through">
                                Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}
                            </span>
                        </div>
                        <p class="text-sm text-emerald-600 font-semibold">💰 Hemat 20% dari harga normal!</p>
                    </div>
                    <div class="text-right">
                        <div
                            class="bg-gradient-secondary text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            🔥 Hot Deal
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seller Info -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/50 shadow-modern">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 gradient-primary rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">{{ substr($product->seller->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-lg">{{ $product->seller->name }}</p>
                            <p class="text-slate-600">Verified Seller ✅</p>
                            <div class="flex items-center space-x-4 mt-1">
                                <span class="text-sm text-emerald-600 font-medium">⭐ 4.8 Rating</span>
                                <span class="text-sm text-slate-500">📦 1.2K Produk</span>
                            </div>
                        </div>
                    </div>
                    <button
                        class="gradient-accent text-white px-4 py-2 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">
                        💬 Chat Seller
                    </button>
                </div>
            </div>

            <!-- Stock & Availability -->
            <div class="flex items-center justify-between bg-slate-50 rounded-2xl p-4 border border-slate-200/50">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 {{ $product->stock > 10 ? 'bg-emerald-100' : ($product->stock > 0 ? 'bg-yellow-100' : 'bg-red-100') }} rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 {{ $product->stock > 10 ? 'text-emerald-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">
                            {{ $product->stock > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                        </p>
                        <p
                            class="text-sm {{ $product->stock > 10 ? 'text-emerald-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $product->stock > 0 ? $product->stock . ' unit tersisa' : 'Segera restock' }}
                        </p>
                    </div>
                </div>
                @if($product->stock > 0 && $product->stock <= 10) <span
                    class="bg-gradient-secondary text-white text-sm font-semibold px-3 py-1 rounded-full animate-pulse">
                    ⚡ Stok Terbatas!
                    </span>
                    @endif
            </div>

            @if($product->stock > 0)
            <!-- Add to Cart Form -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/50 shadow-modern">
                <form id="addToCartForm" class="space-y-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Size Selection -->
                    @if($product->sizes && count($product->sizes) > 0)
                    <div class="space-y-4">
                        <label class="flex items-center space-x-2 text-lg font-bold text-slate-800">
                            <span class="text-2xl">📏</span>
                            <span>Pilih Ukuran</span>
                        </label>
                        <div class="grid grid-cols-4 gap-3">
                            @foreach($product->sizes as $size)
                            <label class="cursor-pointer group">
                                <input type="radio" name="size" value="{{ $size }}" class="sr-only" required>
                                <div
                                    class="size-option px-4 py-3 border-2 border-slate-200 rounded-xl text-center font-semibold hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 group-hover:scale-105">
                                    {{ $size }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Color Selection -->
                    @if($product->colors && count($product->colors) > 0)
                    <div class="space-y-4">
                        <label class="flex items-center space-x-2 text-lg font-bold text-slate-800">
                            <span class="text-2xl">🎨</span>
                            <span>Pilih Warna</span>
                        </label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($product->colors as $color)
                            <label class="cursor-pointer group">
                                <input type="radio" name="color" value="{{ $color }}" class="sr-only" required>
                                <div
                                    class="color-option px-6 py-3 border-2 border-slate-200 rounded-xl font-semibold hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 group-hover:scale-105">
                                    {{ $color }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Quantity Selection -->
                    <div class="space-y-4">
                        <label class="flex items-center space-x-2 text-lg font-bold text-slate-800">
                            <span class="text-2xl">🔢</span>
                            <span>Jumlah</span>
                        </label>
                        <div class="flex items-center space-x-4">
                            <button type="button" onclick="decreaseQuantity()"
                                class="w-12 h-12 rounded-xl border-2 border-slate-200 flex items-center justify-center hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 hover:scale-105">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                    </path>
                                </svg>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1"
                                max="{{ $product->stock }}"
                                class="w-20 text-center text-xl font-bold border-2 border-slate-200 rounded-xl py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <button type="button" onclick="increaseQuantity()"
                                class="w-12 h-12 rounded-xl border-2 border-slate-200 flex items-center justify-center hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 hover:scale-105">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <span class="text-slate-500 font-medium">Max: {{ $product->stock }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @auth
                    <div class="space-y-4 pt-4">
                        <button type="submit"
                            class="w-full gradient-primary text-white py-4 px-8 rounded-2xl font-bold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-2 shadow-modern">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0L4 5M7 13h10m0 0l1.5 6M17 13l1.5-6">
                                </path>
                            </svg>
                            <span>🛒 Tambah ke Keranjang</span>
                        </button>
                        <button type="button" onclick="buyNow()"
                            class="w-full gradient-secondary text-white py-4 px-8 rounded-2xl font-bold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-2 shadow-modern">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>⚡ Beli Sekarang</span>
                        </button>

                        <!-- Additional Actions -->
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <button type="button"
                                class="flex items-center justify-center space-x-2 py-3 px-4 border-2 border-slate-200 rounded-xl hover:border-purple-300 hover:bg-purple-50 transition-all duration-200">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                                <span class="font-semibold text-slate-700">Wishlist</span>
                            </button>
                            <button type="button"
                                class="flex items-center justify-center space-x-2 py-3 px-4 border-2 border-slate-200 rounded-xl hover:border-purple-300 hover:bg-purple-50 transition-all duration-200">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                    </path>
                                </svg>
                                <span class="font-semibold text-slate-700">Share</span>
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="text-center pt-4">
                        <a href="{{ route('login') }}"
                            class="inline-block gradient-primary text-white py-4 px-8 rounded-2xl font-bold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 shadow-modern">
                            🔐 Login untuk Membeli
                        </a>
                    </div>
                    @endauth
                </form>
            </div>
            @else
            <div class="bg-gradient-to-r from-red-50 to-orange-50 border-2 border-red-200 rounded-2xl p-6">
                <div class="text-center space-y-3">
                    <div class="text-6xl">😔</div>
                    <h3 class="text-xl font-bold text-red-800">Oops! Stok Habis</h3>
                    <p class="text-red-600">Produk ini sedang habis stok, tapi jangan khawatir!</p>
                    <button
                        class="gradient-accent text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">
                        🔔 Notify Me When Available
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Product Description & Details -->
    <div class="mt-16 space-y-8">
        <!-- Description -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200/50 shadow-modern">
            <h2 class="text-3xl font-bold text-slate-800 mb-6 flex items-center space-x-3">
                <span class="text-4xl">📝</span>
                <span>Deskripsi Produk</span>
            </h2>
            <div class="prose max-w-none">
                <p class="text-slate-700 leading-relaxed text-lg">{{ $product->description }}</p>
            </div>
        </div>

        <!-- Product Specifications -->
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-3xl p-8 border border-slate-200/50">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center space-x-3">
                <span class="text-3xl">📋</span>
                <span>Spesifikasi</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-slate-200">
                        <span class="font-semibold text-slate-700">Kategori</span>
                        <span class="text-slate-600">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-slate-200">
                        <span class="font-semibold text-slate-700">Brand</span>
                        <span class="text-slate-600">{{ $product->seller->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-slate-200">
                        <span class="font-semibold text-slate-700">Kondisi</span>
                        <span class="text-emerald-600 font-semibold">✨ Baru</span>
                    </div>
                </div>
                <div class="space-y-4">
                    @if($product->sizes && count($product->sizes) > 0)
                    <div class="flex justify-between items-center py-3 border-b border-slate-200">
                        <span class="font-semibold text-slate-700">Ukuran Tersedia</span>
                        <span class="text-slate-600">{{ implode(', ', $product->sizes) }}</span>
                    </div>
                    @endif
                    @if($product->colors && count($product->colors) > 0)
                    <div class="flex justify-between items-center py-3 border-b border-slate-200">
                        <span class="font-semibold text-slate-700">Warna Tersedia</span>
                        <span class="text-slate-600">{{ implode(', ', $product->colors) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between items-center py-3 border-b border-slate-200">
                        <span class="font-semibold text-slate-700">Berat</span>
                        <span class="text-slate-600">~500g</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200/50 shadow-modern">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center space-x-3">
                <span class="text-3xl">⭐</span>
                <span>Ulasan Pembeli</span>
            </h3>

            @if($product->reviews_count > 0)
            <div class="space-y-6">
                <!-- Rating Summary -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200/50">
                    <div class="flex items-center justify-between">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-slate-800">{{ number_format($product->average_rating, 1)
                                }}</div>
                            <div class="flex items-center justify-center space-x-1 mt-2">
                                @for($i = 1; $i <= 5; $i++) <svg
                                    class="w-5 h-5 {{ $i <= floor($product->average_rating) ? 'text-yellow-400 fill-current' : 'text-slate-300 fill-current' }}"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                            </div>
                            <div class="text-slate-600 mt-1">{{ $product->reviews_count }} ulasan</div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-emerald-600">95%</div>
                            <div class="text-slate-600">Pembeli Puas</div>
                        </div>
                    </div>
                </div>

                <!-- Sample Reviews -->
                <div class="space-y-4">
                    <div class="bg-slate-50 rounded-2xl p-6">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-primary rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">A</span>
                            </div>
                            <div>
                                <div class="font-semibold text-slate-800">Anonymous User</div>
                                <div class="flex items-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++) <svg class="w-4 h-4 text-yellow-400 fill-current"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-700">"Produk sangat bagus! Kualitas premium dan sesuai dengan foto.
                            Pengiriman juga cepat. Recommended banget! 👍"</p>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">💬</div>
                <h4 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Ulasan</h4>
                <p class="text-slate-600">Jadilah yang pertama memberikan ulasan untuk produk ini!</p>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    function changeMainImage(src, element) {
        document.getElementById('mainImage').src = src;

        // Remove active class from all thumbnails
        document.querySelectorAll('.aspect-w-1 + div img').forEach(img => {
            img.classList.remove('border-blue-500');
            img.classList.add('border-transparent');
        });

        // Add active class to clicked thumbnail
        element.classList.remove('border-transparent');
        element.classList.add('border-blue-500');
    }

    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        const current = parseInt(input.value);
        if (current > 1) {
            input.value = current - 1;
        }
    }

    // Handle size and color selection
    document.addEventListener('DOMContentLoaded', function () {
        // Size selection
        document.querySelectorAll('input[name="size"]').forEach(input => {
            input.addEventListener('change', function () {
                document.querySelectorAll('.size-option').forEach(span => {
                    span.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    span.classList.add('border-gray-300');
                });
                this.nextElementSibling.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                this.nextElementSibling.classList.remove('border-gray-300');
            });
        });

        // Color selection
        document.querySelectorAll('input[name="color"]').forEach(input => {
            input.addEventListener('change', function () {
                document.querySelectorAll('.color-option').forEach(span => {
                    span.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    span.classList.add('border-gray-300');
                });
                this.nextElementSibling.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                this.nextElementSibling.classList.remove('border-gray-300');
            });
        });
    });

    // Handle add to cart form submission
    document.getElementById('addToCartForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/cart/add', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert(data.message);
                    // Update cart count if function exists
                    if (typeof updateCartCount === 'function') {
                        updateCartCount();
                    }
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
    });

    function buyNow() {
        // Add to cart first, then redirect to checkout
        const form = document.getElementById('addToCartForm');
        const formData = new FormData(form);

        fetch('/cart/add', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/checkout';
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
    }
</script>
@endsection