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
                            @for($i = 1; $i <= 5; $i++) @if($i <=floor($product->average_rating))
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @else
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
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
                <span
                    class="text-sm {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
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
                            <span
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors size-option">
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
                            <span
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors color-option">
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
                        <button type="button" onclick="decreaseQuantity()"
                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                </path>
                            </svg>
                        </button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                            class="w-16 text-center border border-gray-300 rounded-md py-1">
                        <button type="button" onclick="increaseQuantity()"
                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0L4 5M7 13h10m0 0l1.5 6M17 13l1.5-6">
                            </path>
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