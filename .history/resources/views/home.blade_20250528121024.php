@extends('layouts.app')

@section('title', 'Faciona - Fashion for Gen Z')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="text-white space-y-8">
                <div class="space-y-6">
                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                        <span class="block">Redefining</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                            Fashion
                        </span>
                        <span class="block">for Today</span>
                    </h1>
                    <p class="text-xl text-slate-300 max-w-lg leading-relaxed">
                        Discover curated collections that speak to your style. Premium quality, contemporary designs,
                        and authentic expression for the modern generation.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}"
                        class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 text-center shadow-modern">
                        Shop Collection
                    </a>
                    <a href="#featured"
                        class="bg-white bg-opacity-10 backdrop-blur-sm text-white border border-white border-opacity-20 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-opacity-20 transition-all duration-300 text-center">
                        Explore Trends
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">10K+</div>
                        <div class="text-slate-300 text-sm">Premium Products</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">50K+</div>
                        <div class="text-slate-300 text-sm">Happy Customers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">1K+</div>
                        <div class="text-slate-300 text-sm">Brand Partners</div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual -->
            <div class="relative">
                <div
                    class="aspect-square bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-3xl backdrop-blur-sm border border-white/10 flex items-center justify-center">
                    <div class="text-center">
                        <div
                            class="w-32 h-32 mx-auto mb-6 bg-gradient-primary rounded-full flex items-center justify-center shadow-2xl">
                            <span class="text-white text-4xl font-bold">F</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Premium Fashion</h3>
                        <p class="text-slate-300">Curated for You</p>
                    </div>
                </div>

                <!-- Floating Elements -->
                <div
                    class="absolute -top-4 -right-4 w-16 h-16 bg-gradient-secondary rounded-full opacity-80 animate-pulse">
                </div>
                <div
                    class="absolute -bottom-4 -left-4 w-12 h-12 bg-gradient-accent rounded-full opacity-80 animate-pulse delay-1000">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Categories Section -->
<div id="featured" class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Shop by Category</h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Discover our curated collections designed for every
                style and occasion</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div
                class="group relative bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div
                    class="aspect-[4/3] bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-gradient-primary rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">{{ $category->name }}</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-slate-600 mb-4">Explore our premium {{ strtolower($category->name) }} collection</p>
                    <a href="{{ route('products.index', ['category' => $category->id]) }}"
                        class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-700 transition-colors duration-200">
                        Shop Now
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                View All Products
            </a>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @forelse($products as $product)
    <div
        class="group bg-white rounded-2xl shadow-modern overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-slate-200/50">
        <!-- Product Image -->
        <div class="relative aspect-square bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
            @if($product->images && count($product->images) > 0)
            <img src="{{ asset('storage/products/' . $product->images[0]) }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                onerror="this.src='https://via.placeholder.com/400x400?text=No+Image'">
            @else
            <div class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                <span class="text-6xl">👗</span>
            </div>
            @endif

            <!-- Overlay with Quick Actions -->
            <div
                class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                <div class="flex space-x-2">
                    <button
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Stock Badge -->
            @if($product->stock < 10) <div class="absolute top-3 left-3">
                <span class="bg-gradient-secondary text-white text-xs font-semibold px-2 py-1 rounded-full shadow-lg">
                    Stok Terbatas!
                </span>
        </div>
        @endif

        <!-- Category Badge -->
        <div class="absolute top-3 right-3">
            <span
                class="bg-white/90 backdrop-blur-sm text-slate-700 text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                {{ $product->category->name }}
            </span>
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-6 space-y-4">
        <div class="space-y-2">
            <h3
                class="text-lg font-bold text-slate-800 line-clamp-2 group-hover:text-purple-600 transition-colors duration-200">
                {{ $product->name }}
            </h3>
            <p class="text-sm text-slate-500 flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>{{ $product->seller->name }}</span>
            </p>
        </div>

        <div class="flex justify-between items-center">
            <div class="space-y-1">
                <span
                    class="text-2xl font-bold text-gradient bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                <div class="flex items-center space-x-1 text-xs text-slate-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>Stok: {{ $product->stock }}</span>
                </div>
            </div>

            <!-- Rating Stars (placeholder) -->
            <div class="flex items-center space-x-1">
                @for($i = 1; $i <= 5; $i++) <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    @endfor
                    <span class="text-xs text-slate-500 ml-1">(4.8)</span>
            </div>
        </div>

        <!-- Action Button -->
        <div class="pt-2">
            <a href="{{ route('products.show', $product->slug) }}"
                class="w-full gradient-primary text-white text-center py-3 px-4 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200 block shadow-modern">
                ✨ Lihat Detail
            </a>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-20">
    <div class="max-w-md mx-auto">
        <div
            class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
            <span class="text-6xl">🔍</span>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-2">Oops! Produk Tidak Ditemukan</h3>
        <p class="text-slate-600 mb-6">Coba ubah filter pencarian atau jelajahi kategori lainnya untuk menemukan
            fashion impianmu!</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}"
                class="gradient-primary text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">
                🔄 Reset Filter
            </a>
            <a href="#categories"
                class="border-2 border-purple-300 text-purple-600 px-6 py-3 rounded-full font-semibold hover:bg-purple-50 transition-all duration-200">
                📂 Jelajahi Kategori
            </a>
        </div>
    </div>
</div>
@endforelse
</div>

<!-- Pagination -->
@if($products->hasPages())
<div class="mt-12 flex justify-center">
    <div class="bg-white rounded-2xl shadow-modern p-4 border border-slate-200/50">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endif
</div>
@endsection