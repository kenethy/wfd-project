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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-6">
            @foreach($cartItems as $item)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 cart-item hover:shadow-md transition-shadow duration-200"
                data-cart-id="{{ $item->id }}">
                <div class="flex items-start space-x-6">
                    <!-- Product Image -->
                    <div class="flex-shrink-0">
                        <div class="relative group">
                            @if($item->product->images && count($item->product->images) > 0)
                            <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                alt="{{ $item->product->name }}"
                                class="w-24 h-24 object-cover rounded-xl group-hover:scale-105 transition-transform duration-200"
                                onerror="this.src='https://via.placeholder.com/96x96?text=No+Image'">
                            @else
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex-1 min-w-0">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-slate-900 mb-2">
                                <a href="{{ route('products.show', $item->product->slug) }}"
                                    class="hover:text-purple-600 transition-colors duration-200">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
                            <div class="flex items-center space-x-4 text-sm text-slate-600">
                                <span class="bg-slate-100 px-2 py-1 rounded-full">{{ $item->product->category->name
                                    }}</span>
                                <span>by {{ $item->product->seller->name }}</span>
                            </div>
                        </div>

                        @if($item->size || $item->color)
                        <div class="flex flex-wrap gap-3 mb-4">
                            @if($item->size)
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-slate-700">Size:</span>
                                <span
                                    class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">{{
                                    $item->size }}</span>
                            </div>
                            @endif
                            @if($item->color)
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-slate-700">Color:</span>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">{{
                                    $item->color }}</span>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Price and Controls -->
                        <div class="flex items-center justify-between">
                            <div class="space-y-1">
                                <div class="text-2xl font-bold text-slate-900">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-slate-500">per item</div>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-3 bg-slate-50 rounded-xl p-2">
                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                        class="w-8 h-8 rounded-lg border border-slate-300 flex items-center justify-center hover:bg-white hover:border-purple-300 transition-all duration-200 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4"></path>
                                            </svg>
                                    </button>

                                    <span class="w-8 text-center font-bold text-slate-900 quantity-display">{{
                                        $item->quantity }}</span>

                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                        class="w-8 h-8 rounded-lg border border-slate-300 flex items-center justify-center hover:bg-white hover:border-purple-300 transition-all duration-200 {{ $item->quantity >= $item->product->stock ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Remove Button -->
                                <button onclick="removeItem({{ $item->id }})"
                                    class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subtotal -->
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-slate-700">Subtotal</span>
                        <span class="text-2xl font-bold text-slate-900 subtotal">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sticky top-4">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Summary</h2>

                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                        <span class="font-semibold text-slate-900 total-amount">Rp {{ number_format($total, 0, ',', '.')
                            }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Shipping</span>
                        <span class="font-semibold text-emerald-600">Free</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Tax</span>
                        <span class="font-semibold text-slate-900">Rp 0</span>
                    </div>

                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-slate-900">Total</span>
                            <span class="text-2xl font-bold text-slate-900 total-amount">Rp {{ number_format($total, 0,
                                ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Promo Code -->
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Promo Code</h3>
                    <div class="flex space-x-3">
                        <input type="text" placeholder="Enter promo code"
                            class="flex-1 px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                        <button
                            class="px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-semibold hover:bg-slate-800 transition-colors duration-200">
                            Apply
                        </button>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <a href="{{ route('checkout.index') }}"
                        class="w-full gradient-primary text-white text-center py-4 px-6 rounded-xl font-bold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 block shadow-modern">
                        Proceed to Checkout
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="w-full bg-slate-100 text-slate-700 text-center py-4 px-6 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 block">
                        Continue Shopping
                    </a>
                </div>

                <!-- Trust Signals -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="space-y-2">
                            <div class="w-8 h-8 mx-auto bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Secure Payment</p>
                        </div>
                        <div class="space-y-2">
                            <div class="w-8 h-8 mx-auto bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Fast Delivery</p>
                        </div>
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