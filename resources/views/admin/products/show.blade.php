@extends('layouts.app')

@section('title', 'Product Details - Admin')

@push('styles')
<style>
    /* Prevent image blinking and glitching */
    .product-image {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .product-image.loaded {
        opacity: 1;
    }

    .image-container {
        position: relative;
        background-color: #f1f5f9;
    }

    .image-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e2e8f0;
        transition: opacity 0.3s ease-in-out;
    }

    .image-placeholder.hidden {
        opacity: 0;
        pointer-events: none;
    }

    /* Prevent layout shift */
    .aspect-square {
        aspect-ratio: 1 / 1;
    }

    /* Smooth hover effects */
    .product-image:hover {
        transform: scale(1.02);
        transition: transform 0.2s ease-in-out, opacity 0.3s ease-in-out;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Product Details</h1>
                <p class="text-slate-300 mt-2">{{ $product->name }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    Edit Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    ← Back to Products
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Product Information -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Product Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $product->name }}</h2>
                        <p class="text-slate-600 mt-1">{{ $product->slug }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <!-- Product Images -->
                @if($product->images && count($product->images) > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-3">Product Images</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($product->images as $index => $image)
                        <div class="image-container aspect-square rounded-lg overflow-hidden">
                            <!-- Loading placeholder -->
                            <div class="image-placeholder" id="placeholder-{{ $index }}">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <!-- Actual image -->
                            <img src="{{ asset('storage/products/' . $image) }}"
                                 alt="{{ $product->name }}"
                                 class="product-image w-full h-full object-cover"
                                 data-index="{{ $index }}"
                                 onload="handleImageLoad(this)"
                                 onerror="handleImageError(this)">
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-3">Product Images</h3>
                    <div class="aspect-square bg-slate-100 rounded-lg overflow-hidden flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm text-slate-500">No images available</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-3">Description</h3>
                    <div class="prose prose-slate max-w-none">
                        <p class="text-slate-700">{{ $product->description }}</p>
                    </div>
                </div>

                <!-- Product Attributes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($product->sizes && count($product->sizes) > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-3">Available Sizes</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->sizes as $size)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $size }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($product->colors && count($product->colors) > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-3">Available Colors</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->colors as $color)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                {{ $color }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Reviews Section -->
            @if($product->reviews->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mt-8">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Recent Reviews ({{ $product->reviews->count() }})</h3>
                <div class="space-y-4">
                    @foreach($product->reviews->take(5) as $review)
                    <div class="border-b border-slate-200 pb-4 last:border-b-0">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-xs">{{ substr($review->user->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-slate-900">{{ $review->user->name }}</p>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs text-slate-500">{{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($review->title)
                        <h4 class="font-medium text-slate-900 mb-1">{{ $review->title }}</h4>
                        @endif
                        <p class="text-sm text-slate-700">{{ $review->comment }}</p>
                    </div>
                    @endforeach
                </div>
                @if($product->reviews->count() > 5)
                <div class="mt-4 pt-4 border-t border-slate-200">
                    <a href="{{ route('admin.reviews.index', ['search' => $product->name]) }}" class="text-sm text-purple-600 hover:text-purple-700 font-medium">
                        View all {{ $product->reviews->count() }} reviews →
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Product Info Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Product Information</h3>
                
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Price</dt>
                        <dd class="text-2xl font-bold text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Stock</dt>
                        <dd class="text-lg font-semibold {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $product->stock }} units
                        </dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Category</dt>
                        <dd class="text-sm text-slate-900">{{ $product->category->name }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Seller</dt>
                        <dd class="text-sm text-slate-900">{{ $product->seller->name }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Created</dt>
                        <dd class="text-sm text-slate-900">{{ $product->created_at->format('M d, Y') }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Last Updated</dt>
                        <dd class="text-sm text-slate-900">{{ $product->updated_at->format('M d, Y') }}</dd>
                    </div>
                </dl>

                <!-- Actions -->
                <div class="mt-6 pt-6 border-t border-slate-200 space-y-3">
                    <a href="{{ route('admin.products.edit', $product) }}" 
                       class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center block">
                        Edit Product
                    </a>
                    
                    <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="w-full px-4 py-2 {{ $product->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition-colors duration-200">
                            {{ $product->is_active ? 'Deactivate Product' : 'Activate Product' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sales Statistics -->
            @if($product->orderItems->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mt-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Sales Statistics</h3>
                
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-sm text-slate-500">Total Orders</dt>
                        <dd class="text-sm font-medium text-slate-900">{{ $product->orderItems->count() }}</dd>
                    </div>
                    
                    <div class="flex justify-between">
                        <dt class="text-sm text-slate-500">Total Sold</dt>
                        <dd class="text-sm font-medium text-slate-900">{{ $product->orderItems->sum('quantity') }} units</dd>
                    </div>
                    
                    <div class="flex justify-between">
                        <dt class="text-sm text-slate-500">Total Revenue</dt>
                        <dd class="text-sm font-medium text-slate-900">Rp {{ number_format($product->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}</dd>
                    </div>
                    
                    @if($product->reviews->count() > 0)
                    <div class="flex justify-between">
                        <dt class="text-sm text-slate-500">Average Rating</dt>
                        <dd class="text-sm font-medium text-slate-900">{{ number_format($product->reviews->avg('rating'), 1) }}/5</dd>
                    </div>
                    @endif
                </dl>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Handle image loading to prevent blinking/glitching
    function handleImageLoad(img) {
        const index = img.getAttribute('data-index');
        const placeholder = document.getElementById('placeholder-' + index);

        // Hide placeholder and show image smoothly
        if (placeholder) {
            placeholder.classList.add('hidden');
        }
        img.classList.add('loaded');
    }

    function handleImageError(img) {
        const index = img.getAttribute('data-index');
        const placeholder = document.getElementById('placeholder-' + index);

        // Show error state
        if (placeholder) {
            placeholder.innerHTML = `
                <div class="text-center">
                    <svg class="w-8 h-8 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <p class="text-xs text-red-500">Failed to load</p>
                </div>
            `;
        }

        // Hide the broken image
        img.style.display = 'none';
    }

    // Preload images to reduce blinking
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.product-image');

        images.forEach(function(img) {
            // If image is already cached, show it immediately
            if (img.complete && img.naturalHeight !== 0) {
                handleImageLoad(img);
            }
        });
    });
</script>
@endpush
