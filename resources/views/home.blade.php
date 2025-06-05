@extends('layouts.app')

@section('title', 'Faciona - Fashion for Gen Z')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20 parallax" data-speed="0.3"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="text-white space-y-8 fade-in">
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
                        class="bg-white bg-opacity-90 backdrop-blur-sm text-slate-900 border border-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:shadow-lg transition-all duration-300 text-center">
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
            <div class="relative fade-in">
                <!-- Main Image Container -->
                <div
                    class="relative aspect-square rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-500 group hero-image-container">
                    <!-- Background Image -->
                    <img src="{{ asset('storage/images/secondoption.jpeg') }}" alt="Premium Fashion Collection"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                    <!-- Fallback if image fails to load -->
                    <div class="w-full h-full bg-gradient-to-br from-purple-500/20 to-pink-500/20 backdrop-blur-sm border border-white/10 flex items-center justify-center"
                        style="display: none;">
                        <div class="text-center">
                            <div
                                class="w-32 h-32 mx-auto mb-6 bg-gradient-primary rounded-full flex items-center justify-center shadow-2xl">
                                <span class="text-white text-4xl font-bold">E</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Premium Fashion</h3>
                            <p class="text-slate-300">Curated for You</p>
                        </div>
                    </div>

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8 text-white">
                        <div class="text-center">
                            <!-- Brand Badge -->
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-primary rounded-full shadow-lg mb-3 sm:mb-4 hover:scale-110 transition-transform duration-300">
                                <span class="text-white text-lg sm:text-2xl font-bold drop-shadow-lg">F</span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold mb-1 sm:mb-2 drop-shadow-lg">Premium Fashion</h3>
                            <p class="text-slate-200 text-base sm:text-lg drop-shadow-md">Curated for You</p>

                            <!-- Quality Indicators -->

                        </div>
                    </div>

                    <!-- Shimmer Effect on Hover -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>
                </div>

                <!-- Floating Decorative Elements -->
                <div
                    class="absolute -top-2 -right-2 sm:-top-4 sm:-right-4 w-12 h-12 sm:w-16 sm:h-16 bg-gradient-secondary rounded-full opacity-80 animate-float-slow shadow-lg">
                </div>
                <div
                    class="absolute -bottom-2 -left-2 sm:-bottom-4 sm:-left-4 w-8 h-8 sm:w-12 sm:h-12 bg-gradient-accent rounded-full opacity-80 animate-float shadow-lg">
                </div>
                <div
                    class="absolute top-1/2 -left-4 sm:-left-8 w-6 h-6 sm:w-8 sm:h-8 bg-gradient-primary rounded-full opacity-60 animate-float-slow shadow-lg">
                </div>
                <div
                    class="absolute bottom-1/4 -right-3 sm:-right-6 w-4 h-4 sm:w-6 sm:h-6 bg-gradient-secondary rounded-full opacity-70 animate-float shadow-lg">
                </div>

                <!-- Additional Floating Elements for More Dynamic Look -->
                <div
                    class="hidden sm:block absolute top-1/4 right-1/4 w-4 h-4 bg-white rounded-full opacity-50 animate-float">
                </div>
                <div
                    class="hidden sm:block absolute bottom-1/3 left-1/3 w-3 h-3 bg-purple-300 rounded-full opacity-60 animate-float-slow">
                </div>

                <!-- Mobile-specific smaller floating elements -->
                <div
                    class="sm:hidden absolute top-1/3 right-1/3 w-2 h-2 bg-white rounded-full opacity-40 animate-float">
                </div>
                <div
                    class="sm:hidden absolute bottom-1/2 left-1/4 w-2 h-2 bg-pink-300 rounded-full opacity-50 animate-float-slow">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Categories Section -->
<div id="featured" class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-animate">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Shop by Category</h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Discover our curated collections designed for every
                style and occasion</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div
                class="group relative bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 scroll-animate-scale hover-lift stagger-animate stagger-{{ $loop->index + 1 }}">
                <div
                    class="aspect-[4/3] bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>
                    <div class="text-center relative z-10">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-gradient-primary rounded-full flex items-center justify-center shadow-lg hover-scale animate-pulse-glow">
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
                        class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-700 transition-colors duration-200 btn-animate">
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

        <div class="text-center mt-12 scroll-animate">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block btn-animate btn-ripple hover-glow">
                View All Products
            </a>
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<div class="bg-gradient-to-br from-slate-50 to-purple-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-animate">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Featured Products</h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Handpicked selections from our latest collections</p>
        </div>

        @if($featuredProducts->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
            <div
                class="group bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-slate-100 scroll-animate-scale hover-lift stagger-animate stagger-{{ $loop->index + 1 }} flex flex-col h-full">
                <!-- Product Image -->
                <div class="relative aspect-square bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                    @if($product->images && count($product->images) > 0)
                    <img src="{{ asset('storage/products/' . $product->images[0]) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                        onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center\'><svg class=\'w-16 h-16 text-slate-400 animate-float\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>';">
                    @else
                    <div
                        class="w-full h-full bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                        <svg class="w-16 h-16 text-slate-400 animate-float" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    @endif

                    <!-- Shimmer Effect -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>

                    <!-- Quick View Overlay -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="bg-white text-slate-900 px-6 py-2 rounded-full font-medium hover:bg-slate-100 transition-colors duration-200 transform translate-y-4 group-hover:translate-y-0 btn-animate btn-ripple">
                            Quick View
                        </a>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-3 left-3">
                        <span
                            class="bg-white bg-opacity-90 text-slate-700 text-xs font-medium px-2 py-1 rounded-full animate-fade-in-up">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Floating Price Badge -->
                    <div
                        class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span
                            class="bg-gradient-primary text-white text-xs font-bold px-2 py-1 rounded-full animate-pulse-glow">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Product Details - Top Section -->
                    <div class="flex-grow">
                        <div class="mb-3">
                            <h3
                                class="text-lg font-semibold text-slate-900 mb-1 line-clamp-2 group-hover:text-purple-600 transition-colors duration-200">
                                {{ $product->name }}</h3>
                            <p class="text-sm text-slate-600 line-clamp-1">by {{ $product->seller->name }}</p>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xl font-bold text-slate-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <div class="text-sm text-slate-500">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $product->stock }} in stock
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button - Bottom Section -->
                    <div class="mt-auto">
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="w-full bg-slate-900 text-white text-center py-3 px-4 rounded-xl font-medium hover:bg-slate-800 transition-colors duration-200 block btn-animate btn-ripple hover-glow">
                            View Product
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="text-center mt-12 scroll-animate">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 inline-block btn-animate btn-ripple hover-glow">
                Explore All Products
            </a>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 py-20 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-20 h-20 bg-gradient-secondary rounded-full opacity-20 animate-float-slow">
        </div>
        <div class="absolute top-1/2 right-20 w-16 h-16 bg-gradient-accent rounded-full opacity-30 animate-float"></div>
        <div
            class="absolute bottom-20 left-1/4 w-12 h-12 bg-gradient-primary rounded-full opacity-25 animate-float-slow">
        </div>
        <div class="absolute top-1/4 right-1/3 w-8 h-8 bg-gradient-secondary rounded-full opacity-40 animate-float">
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="scroll-animate">
            <h2 class="text-4xl font-bold text-white mb-6 animate-fade-in-up">Ready to Elevate Your Style?</h2>
            <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto animate-fade-in-up stagger-2">
                Join thousands of fashion enthusiasts who trust Faciona for their style needs. Discover premium quality,
                contemporary designs, and authentic expression.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center scroll-animate stagger-3">
            <a href="{{ route('products.index') }}"
                class="gradient-primary text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 btn-animate btn-ripple hover-glow animate-pulse-glow">
                Start Shopping
            </a>
            <a href="#featured"
                class="bg-white bg-opacity-90 backdrop-blur-sm text-slate-900 border border-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:shadow-lg transition-all duration-300 btn-animate hover-lift">
                Learn More
            </a>
        </div>

        <!-- Premium Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-16 scroll-animate stagger-4">
            <!-- Premium Quality -->
            <div class="text-center group">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-purple-500/20 to-pink-500/20 backdrop-blur-sm border border-white/20 rounded-2xl mb-4 group-hover:scale-110 group-hover:bg-gradient-to-br group-hover:from-purple-500/30 group-hover:to-pink-500/30 transition-all duration-300 animate-float">
                    <!-- Crown/Premium Icon -->
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-yellow-400 group-hover:text-yellow-300 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                </div>
                <h4 class="text-base sm:text-lg font-semibold text-white mb-1 drop-shadow-md">Premium Quality</h4>
                <p class="text-xs sm:text-sm text-slate-300 drop-shadow-sm">Curated luxury fashion</p>
            </div>

            <!-- Fast Delivery -->
            <div class="text-center group">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-purple-500/20 to-pink-500/20 backdrop-blur-sm border border-white/20 rounded-2xl mb-4 group-hover:scale-110 group-hover:bg-gradient-to-br group-hover:from-purple-500/30 group-hover:to-pink-500/30 transition-all duration-300 animate-float-slow">
                    <!-- Lightning/Speed Icon -->
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-400 group-hover:text-blue-300 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                </div>
                <h4 class="text-base sm:text-lg font-semibold text-white mb-1 drop-shadow-md">Fast Delivery</h4>
                <p class="text-xs sm:text-sm text-slate-300 drop-shadow-sm">Express shipping nationwide</p>
            </div>

            <!-- Authentic Brands -->
            <div class="text-center group">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-purple-500/20 to-pink-500/20 backdrop-blur-sm border border-white/20 rounded-2xl mb-4 group-hover:scale-110 group-hover:bg-gradient-to-br group-hover:from-purple-500/30 group-hover:to-pink-500/30 transition-all duration-300 animate-float">
                    <!-- Shield/Verification Icon -->
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-400 group-hover:text-green-300 transition-colors duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <h4 class="text-base sm:text-lg font-semibold text-white mb-1 drop-shadow-md">Authentic Brands</h4>
                <p class="text-xs sm:text-sm text-slate-300 drop-shadow-sm">Verified original products</p>
            </div>
        </div>
    </div>
</div>
@endsection