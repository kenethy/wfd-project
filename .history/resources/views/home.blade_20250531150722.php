@extends('layouts.app')

@section('title', 'Faciona - Fashion for Gen Z')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20 parallax" data-speed="0.3"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="text-white space-y-8 scroll-animate-left">
                <div class="space-y-6">
                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight hero-animate">
                        <span class="block stagger-1">Redefining</span>
                        <span
                            class="block text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400 stagger-2 animate-shimmer">
                            Fashion
                        </span>
                        <span class="block stagger-3">for Today</span>
                    </h1>
                    <p class="text-xl text-slate-300 max-w-lg leading-relaxed hero-animate stagger-4">
                        Discover curated collections that speak to your style. Premium quality, contemporary designs,
                        and authentic expression for the modern generation.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 hero-animate stagger-5">
                    <a href="{{ route('products.index') }}"
                        class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 text-center shadow-modern btn-animate btn-ripple hover-glow">
                        Shop Collection
                    </a>
                    <a href="#featured"
                        class="bg-white bg-opacity-10 backdrop-blur-sm text-white border border-white border-opacity-20 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-opacity-20 transition-all duration-300 text-center btn-animate">
                        Explore Trends
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 hero-animate stagger-6">
                    <div class="text-center scroll-animate stagger-1">
                        <div class="text-3xl font-bold text-white counter" data-target="10000">0</div>
                        <div class="text-slate-300 text-sm">Premium Products</div>
                    </div>
                    <div class="text-center scroll-animate stagger-2">
                        <div class="text-3xl font-bold text-white counter" data-target="50000">0</div>
                        <div class="text-slate-300 text-sm">Happy Customers</div>
                    </div>
                    <div class="text-center scroll-animate stagger-3">
                        <div class="text-3xl font-bold text-white counter" data-target="1000">0</div>
                        <div class="text-slate-300 text-sm">Brand Partners</div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual -->
            <div class="relative scroll-animate-right">
                <div
                    class="aspect-square bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-3xl backdrop-blur-sm border border-white/10 flex items-center justify-center hover-lift animate-pulse-glow">
                    <div class="text-center">
                        <div
                            class="w-32 h-32 mx-auto mb-6 bg-gradient-primary rounded-full flex items-center justify-center shadow-2xl animate-float hover-scale">
                            <span class="text-white text-4xl font-bold">F</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Premium Fashion</h3>
                        <p class="text-slate-300">Curated for You</p>
                    </div>
                </div>

                <!-- Floating Elements -->
                <div
                    class="absolute -top-4 -right-4 w-16 h-16 bg-gradient-secondary rounded-full opacity-80 animate-float-slow">
                </div>
                <div
                    class="absolute -bottom-4 -left-4 w-12 h-12 bg-gradient-accent rounded-full opacity-80 animate-float">
                </div>
                <div
                    class="absolute top-1/2 -left-8 w-8 h-8 bg-gradient-primary rounded-full opacity-60 animate-float-slow">
                </div>
                <div
                    class="absolute bottom-1/4 -right-6 w-6 h-6 bg-gradient-secondary rounded-full opacity-70 animate-float">
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

<!-- Featured Products Section -->
<div class="bg-gradient-to-br from-slate-50 to-purple-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Featured Products</h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Handpicked selections from our latest collections</p>
        </div>

        @if($featuredProducts->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
            <div
                class="group bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-slate-100">
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

                    <!-- Quick View Overlay -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="bg-white text-slate-900 px-6 py-2 rounded-full font-medium hover:bg-slate-100 transition-colors duration-200 transform translate-y-4 group-hover:translate-y-0">
                            Quick View
                        </a>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-3 left-3">
                        <span class="bg-white bg-opacity-90 text-slate-700 text-xs font-medium px-2 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-6">
                    <div class="mb-3">
                        <h3 class="text-lg font-semibold text-slate-900 mb-1 line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-sm text-slate-600">by {{ $product->seller->name }}</p>
                    </div>

                    <!-- Price -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xl font-bold text-slate-900">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
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
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block">
                Explore All Products
            </a>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to Elevate Your Style?</h2>
        <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
            Join thousands of fashion enthusiasts who trust Faciona for their style needs. Discover premium quality,
            contemporary designs, and authentic expression.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                Start Shopping
            </a>
            <a href="#featured"
                class="bg-white bg-opacity-10 backdrop-blur-sm text-white border border-white border-opacity-20 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-opacity-20 transition-all duration-300">
                Learn More
            </a>
        </div>
    </div>
</div>
@endsection