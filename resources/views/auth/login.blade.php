@extends('layouts.app')

@section('title', 'Login - Faciona')

@section('content')
<!-- Login Page with Faciona Brand Theme -->
<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div
            class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-br from-purple-200/30 to-pink-200/30 rounded-full blur-xl">
        </div>
        <div
            class="absolute bottom-20 right-10 w-40 h-40 bg-gradient-to-br from-pink-200/30 to-purple-200/30 rounded-full blur-xl">
        </div>
        <div
            class="absolute top-1/2 left-1/4 w-24 h-24 bg-gradient-to-br from-purple-100/40 to-pink-100/40 rounded-full blur-lg">
        </div>
        <div
            class="absolute bottom-1/3 right-1/3 w-20 h-20 bg-gradient-to-br from-pink-100/40 to-purple-100/40 rounded-full blur-lg">
        </div>
    </div>

    <div class="max-w-md w-full space-y-8 relative z-10">
        <!-- Header Section -->
        <div class="text-center fade-in">
            <!-- Faciona Logo -->
            <div class="flex justify-center mb-8">
                <div class="flex items-center space-x-3 group">
                        <div
                            class="w-8 h-8 gradient-primary rounded-lg flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300 animate-float">
                            <span class="text-white font-bold text-sm">F</span>
                        </div>
                    <span class="text-3xl font-bold text-gradient">Faciona</span>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-slate-900 mb-2">
                Welcome Back
            </h2>
            <p class="text-slate-600 text-lg">
                Sign in to your fashion journey
            </p>
        </div>

        <!-- Login Form Card -->
        <div
            class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-modern border border-white/50 p-8 space-y-6 hover:shadow-xl transition-all duration-300">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-slate-700">
                        Email Address
                    </label>
                    <div class="relative">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('email') border-red-400 focus:ring-red-400 @enderror"
                            placeholder="Enter your email">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                    <p class="text-sm text-red-600 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-slate-700">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('password') border-red-400 focus:ring-red-400 @enderror"
                            placeholder="Enter your password">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @error('password')
                    <p class="text-sm text-red-600 flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-slate-300 rounded transition-colors duration-200">
                        <label for="remember-me" class="ml-2 block text-sm text-slate-700 font-medium">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#"
                            class="font-semibold text-purple-600 hover:text-purple-700 transition-colors duration-200">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full gradient-primary text-white py-3 px-6 rounded-xl font-semibold text-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 btn-animate btn-ripple hover-glow">
                        Sign In
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-slate-500 font-medium">New to Faciona?</span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center w-full bg-white border border-slate-200 text-slate-700 py-3 px-6 rounded-xl font-semibold hover:bg-slate-50 hover:border-purple-200 hover:text-purple-600 transition-all duration-300 btn-animate">
                    Create Account
                </a>
            </div>
        </div>

        <!-- Demo Accounts Section -->
        <div class="bg-white/60 backdrop-blur-sm rounded-2xl border border-white/50 p-6 space-y-4">
            <h3 class="text-sm font-bold text-slate-800 text-center mb-4">Demo Accounts</h3>
            <div class="grid grid-cols-1 gap-3">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-3 rounded-xl">
                    <div class="text-xs font-semibold text-purple-800 mb-1">Admin Access</div>
                    <div class="text-xs text-slate-600">admin@wfd.com / password</div>
                </div>
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-100 p-3 rounded-xl">
                    <div class="text-xs font-semibold text-blue-800 mb-1">Seller Dashboard</div>
                    <div class="text-xs text-slate-600">seller1@wfd.com / password</div>
                </div>
                <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-100 p-3 rounded-xl">
                    <div class="text-xs font-semibold text-green-800 mb-1">Customer Account</div>
                    <div class="text-xs text-slate-600">customer1@wfd.com / password</div>
                </div>
            </div>
        </div>

        <!-- Footer Text -->
        <div class="text-center">
            <p class="text-sm text-slate-500">
                By signing in, you agree to our
                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">Terms of Service</a>
                and
                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">Privacy Policy</a>
            </p>
        </div>
    </div>
</div>
@endsection