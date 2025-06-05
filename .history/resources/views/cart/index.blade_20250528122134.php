@extends('layouts.app')

@section('title', 'Shopping Cart - Faciona')

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
            <span class="text-slate-800 font-medium">Shopping Cart</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Shopping Cart</h1>
                <p class="text-lg text-slate-600">Review your selected items before checkout</p>
            </div>
            @if($cartItems->count() > 0)
            <div class="mt-6 lg:mt-0">
                <button onclick="clearCart()"
                    class="text-red-600 hover:text-red-700 px-4 py-2 rounded-xl border border-red-200 hover:border-red-300 transition-all duration-200 font-medium">
                    Clear Cart
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            @foreach($cartItems as $item)
            <div class="bg-white rounded-lg shadow-md p-6 cart-item" data-cart-id="{{ $item->id }}">
                <div class="flex items-center space-x-4">
                    <!-- Product Image -->
                    <div class="flex-shrink-0">
                        @if($item->product->images && count($item->product->images) > 0)
                        <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                            alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg"
                            onerror="this.src='https://via.placeholder.com/80x80?text=No+Image'">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 text-xs">No Image</span>
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-medium text-gray-900 truncate">
                            <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-blue-600">
                                {{ $item->product->name }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                        <p class="text-sm text-gray-500">by {{ $item->product->seller->name }}</p>

                        <!-- Variant Info -->
                        <div class="flex space-x-4 mt-2">
                            @if($item->size)
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                Ukuran: {{ $item->size }}
                            </span>
                            @endif
                            @if($item->color)
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                Warna: {{ $item->color }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Price & Quantity -->
                    <div class="flex flex-col items-end space-y-2">
                        <span class="text-lg font-bold text-blue-600">
                            Rp {{ number_format($item->product->price, 0, ',', '.') }}
                        </span>

                        <!-- Quantity Controls -->
                        <div class="flex items-center space-x-2">
                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                            </button>

                            <span class="w-12 text-center font-medium quantity-display">{{ $item->quantity }}</span>

                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 {{ $item->quantity >= $item->product->stock ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Subtotal -->
                        <span class="text-sm text-gray-600 subtotal">
                            Subtotal: Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </span>

                        <!-- Remove Button -->
                        <button onclick="removeItem({{ $item->id }})"
                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                        <span class="font-medium total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span class="font-medium">Gratis</span>
                    </div>

                    <hr class="my-4">

                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-blue-600 total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <a href="{{ route('checkout.index') }}"
                        class="w-full bg-blue-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors block">
                        Lanjut ke Checkout
                    </a>

                    <a href="{{ route('home') }}"
                        class="w-full bg-gray-100 text-gray-700 text-center py-3 px-4 rounded-lg font-medium hover:bg-gray-200 transition-colors block">
                        Lanjut Belanja
                    </a>
                </div>

                <!-- Promo Code -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Kode Promo</h3>
                    <div class="flex space-x-2">
                        <input type="text" placeholder="Masukkan kode promo"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200">
                            Terapkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-16">
        <div class="max-w-md mx-auto">
            <svg class="mx-auto h-24 w-24 text-gray-400 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6m0 0L4 5M7 13h10m0 0l1.5 6M17 13l1.5-6">
                </path>
            </svg>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">Keranjang Anda Kosong</h2>
            <p class="text-gray-600 mb-8">Belum ada produk yang ditambahkan ke keranjang. Yuk mulai belanja!</p>

            <a href="{{ route('home') }}"
                class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                Mulai Belanja
            </a>
        </div>
    </div>
    @endif
</div>

<script>
    function updateQuantity(cartId, newQuantity) {
        if (newQuantity < 1) return;

        fetch(`/cart/${cartId}/update`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: newQuantity })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload to update totals
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
    }

    function removeItem(cartId) {
        if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) return;

        fetch(`/cart/${cartId}/remove`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
    }

    function clearCart() {
        if (!confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) return;

        window.location.href = '/cart/clear';
    }
</script>
@endsection