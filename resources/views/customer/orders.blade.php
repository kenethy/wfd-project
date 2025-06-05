@extends('layouts.app')

@section('title', 'Order History - Faciona')

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
            <span class="text-slate-800 font-medium">Order History</span>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Order History</h1>
                <p class="text-lg text-slate-600">Track and manage all your orders</p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Order Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $order->order_number }}</h3>
                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="mt-2 sm:mt-0 flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                            @if($order->status === 'pending') Menunggu Konfirmasi
                            @elseif($order->status === 'processing') Diproses
                            @elseif($order->status === 'shipped') Dikirim
                            @elseif($order->status === 'delivered') Selesai
                            @else Dibatalkan
                            @endif
                        </span>
                        <span class="text-lg font-bold text-blue-600">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="px-6 py-4">
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center space-x-4">
                        <!-- Product Image -->
                        <div class="flex-shrink-0">
                            @if($item->product->images && count($item->product->images) > 0)
                            <img src="{{ asset('storage/products/' . $item->product->images[0]) }}"
                                alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg"
                                onerror="this.src='https://via.placeholder.com/64x64?text=No+Image'">
                            @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400 text-xs">No Image</span>
                            </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 truncate">
                                <a href="{{ route('products.show', $item->product->slug) }}"
                                    class="hover:text-blue-600">
                                    {{ $item->product->name }}
                                </a>
                            </h4>
                            <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>

                            <!-- Variant Info -->
                            <div class="flex space-x-4 mt-1">
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

                        <!-- Quantity & Price -->
                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ $item->quantity }}x</p>
                            <p class="text-sm font-medium text-gray-900">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Subtotal: Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm text-gray-600">
                        <p><strong>Alamat Pengiriman:</strong></p>
                        <p>{{ $order->shipping_address }}</p>
                        <p class="mt-1"><strong>Metode Pembayaran:</strong>
                            @if($order->payment_method === 'cod') Cash on Delivery (COD)
                            @elseif($order->payment_method === 'transfer') Transfer Bank
                            @else E-Wallet
                            @endif
                        </p>
                    </div>

                    <div class="mt-4 sm:mt-0 flex space-x-3">
                        @if($order->status === 'delivered')
                        <button
                            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Beri Ulasan
                        </button>
                        @endif

                        @if($order->status === 'pending')
                        <button class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                            Batalkan
                        </button>
                        @endif

                        <button
                            class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="max-w-md mx-auto">
            <svg class="mx-auto h-24 w-24 text-gray-400 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Pesanan</h2>
            <p class="text-gray-600 mb-8">Anda belum pernah melakukan pemesanan. Yuk mulai belanja!</p>

            <a href="{{ route('home') }}"
                class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                Mulai Belanja
            </a>
        </div>
    </div>
    @endif
</div>
@endsection