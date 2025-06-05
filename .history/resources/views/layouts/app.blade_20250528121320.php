<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Faciona - Fashion for Gen Z')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Faciona - Platform fashion terdepan untuk generasi muda. Temukan style terbaru dengan harga terjangkau.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-accent {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shadow-modern {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .shadow-hover {
            transition: all 0.3s ease;
        }

        .shadow-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen antialiased">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md shadow-modern sticky top-0 z-50 border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                        <div
                            class="w-8 h-8 gradient-primary rounded-lg flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white font-bold text-sm">F</span>
                        </div>
                        <span class="text-2xl font-bold text-gradient">Faciona</span>
                    </a>

                    <!-- Search Bar -->
                    <div class="hidden md:flex items-center flex-1 max-w-lg">
                        <div class="relative w-full">
                            <input type="text" placeholder="Cari produk fashion terbaru..."
                                class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}"
                        class="text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50 {{ request()->routeIs('home') ? 'text-purple-600 bg-purple-50' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}"
                        class="text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50 {{ request()->routeIs('products.*') ? 'text-purple-600 bg-purple-50' : '' }}">
                        Products
                    </a>

                    @auth
                    @if(auth()->user()->role === 'customer')
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}"
                        class="relative text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-purple-50 group">
                        <div class="flex items-center space-x-1">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6m0 0L4 5M7 13h10m0 0l1.5 6M17 13l1.5-6">
                                </path>
                            </svg>
                            <span class="hidden lg:inline">Cart</span>
                        </div>
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-gradient-secondary text-white text-xs rounded-full h-5 w-5 items-center justify-center hidden shadow-lg">0</span>
                    </a>
                    <a href="{{ route('customer.orders') }}"
                        class="text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50">
                        📦 Pesanan
                    </a>
                    <a href="{{ route('customer.profile') }}"
                        class="text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50">
                        👤 Profile
                    </a>
                    @elseif(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}"
                        class="text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50">
                        📊 Dashboard
                    </a>
                    @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50">
                        ⚙️ Admin
                    </a>
                    @endif

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button
                            class="flex items-center text-slate-700 hover:text-purple-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50 group">
                            <div
                                class="w-8 h-8 bg-gradient-primary rounded-full flex items-center justify-center mr-2 group-hover:scale-110 transition-transform duration-200">
                                <span class="text-white text-xs font-semibold">{{ substr(auth()->user()->name, 0, 1)
                                    }}</span>
                            </div>
                            <span class="hidden lg:inline">{{ auth()->user()->name }}</span>
                            <svg class="ml-1 h-4 w-4 group-hover:rotate-180 transition-transform duration-200"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-slate-700 hover:text-red-500 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-red-50">
                            🚪 Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-slate-700 hover:text-purple-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-purple-50">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="gradient-primary text-white hover:shadow-lg px-6 py-2 rounded-full text-sm font-medium transition-all duration-200 hover:scale-105 shadow-modern">
                        Daftar Sekarang
                    </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 gradient-primary rounded-lg flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold">F</span>
                        </div>
                        <span class="text-2xl font-bold text-white">Faciona</span>
                    </div>
                    <p class="text-slate-300 mb-4 max-w-md">Platform fashion terdepan untuk generasi muda. Temukan style
                        terbaru dengan harga terjangkau dan kualitas terbaik.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">Tentang
                                Kami</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">Karir</a>
                        </li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">Blog
                                Fashion</a></li>
                        <li><a href="#"
                                class="text-slate-300 hover:text-white transition-colors duration-200">Bantuan</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">Pusat
                                Bantuan</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">Kebijakan
                                Return</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">Syarat &
                                Ketentuan</a></li>
                        <li><a href="#"
                                class="text-slate-300 hover:text-white transition-colors duration-200">Privasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-700 mt-8 pt-8 text-center">
                <p class="text-slate-400">&copy; 2024 Faciona. All rights reserved. Made with ❤️ for Gen Z</p>
            </div>
        </div>
    </footer>

    <script>
        // Update cart count on page load
        @auth
        @if (auth() -> user() -> role === 'customer')
            document.addEventListener('DOMContentLoaded', function () {
                updateCartCount();
            });

        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.getElementById('cart-count');
                    if (data.count > 0) {
                        cartCount.textContent = data.count;
                        cartCount.classList.remove('hidden');
                        cartCount.classList.add('flex');
                    } else {
                        cartCount.classList.add('hidden');
                        cartCount.classList.remove('flex');
                    }
                })
                .catch(error => console.error('Error updating cart count:', error));
        }
        @endif
        @endauth
    </script>
</body>

</html>