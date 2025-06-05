@extends('layouts.app')

@section('title', $product->name . ' - WFD Marketplace')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-500 ml-1 md:ml-2">{{ $product->category->name }}</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-500 ml-1 md:ml-2 font-medium">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Product Images -->
        <div class="space-y-4">
            <!-- Main Image -->
            <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                @if($product->images && count($product->images) > 0)
                    <img id="mainImage" src="{{ asset('storage/products/' . $product->images[0]) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-96 object-cover rounded-lg shadow-lg"
                         onerror="this.src='https://via.placeholder.com/500x500?text=No+Image'">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400 text-lg">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Images -->
            @if($product->images && count($product->images) > 1)
                <div class="flex space-x-2 overflow-x-auto">
                    @foreach($product->images as $index => $image)
                        <img src="{{ asset('storage/products/' . $image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-20 h-20 object-cover rounded-md cursor-pointer border-2 border-transparent hover:border-blue-500 transition-colors {{ $index === 0 ? 'border-blue-500' : '' }}"
                             onclick="changeMainImage('{{ asset('storage/products/' . $image) }}', this)"
                             onerror="this.src='https://via.placeholder.com/80x80?text=No+Image'">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <!-- Product Title & Price -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center space-x-4 mb-4">
                    <span class="text-3xl font-bold text-blue-600">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    @if($product->reviews_count > 0)
                        <div class="flex items-center">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->average_rating))
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600 ml-2">
                                ({{ number_format($product->average_rating, 1) }}) {{ $product->reviews_count }} ulasan
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Seller Info -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">{{ substr($product->seller->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $product->seller->name }}</p>
                        <p class="text-sm text-gray-600">Penjual</p>
                    </div>
                </div>
            </div>

            <!-- Stock Info -->
            <div class="flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-700">Stok:</span>
                <span class="text-sm {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}
                </span>
            </div>

            @if($product->stock > 0)
                <!-- Add to Cart Form -->
                <form id="addToCartForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <!-- Size Selection -->
                    @if($product->sizes && count($product->sizes) > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ukuran</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($product->sizes as $size)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="size" value="{{ $size }}" class="sr-only" required>
                                        <span class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors size-option">
                                            {{ $size }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Color Selection -->
                    @if($product->colors && count($product->colors) > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($product->colors as $color)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="color" value="{{ $color }}" class="sr-only" required>
                                        <span class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors color-option">
                                            {{ $color }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quantity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="decreaseQuantity()" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="w-16 text-center border border-gray-300 rounded-md py-1">
                            <button type="button" onclick="increaseQuantity()" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @auth
                        <div class="flex space-x-4">
                            <button type="submit" 
                                    class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0L4 5M7 13h10m0 0l1.5 6M17 13l1.5-6"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <button type="button" onclick="buyNow()" 
                                    class="flex-1 bg-green-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-green-700 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500">
                                Beli Sekarang
                            </button>
                        </div>
                    @else
                        <div class="text-center">
                            <a href="{{ route('login') }}" 
                               class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Login untuk Membeli
                            </a>
                        </div>
                    @endauth
                </form>
            @else
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-800 font-medium">Produk ini sedang habis stok</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Product Description -->
    <div class="mt-12 bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi Produk</h2>
        <div class="prose max-w-none">
            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
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
document.addEventListener('DOMContentLoaded', function() {
    // Size selection
    document.querySelectorAll('input[name="size"]').forEach(input => {
        input.addEventListener('change', function() {
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
        input.addEventListener('change', function() {
            document.querySelectorAll('.color-option').forEach(span => {
                span.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                span.classList.add('border-gray-300');
            });
            this.nextElementSibling.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
            this.nextElementSibling.classList.remove('border-gray-300');
        });
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
