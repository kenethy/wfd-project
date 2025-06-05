@extends('layouts.app')

@section('title', 'Shipping Information - Faciona')

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
            <a href="{{ route('cart.index') }}" class="text-slate-600 hover:text-purple-600 transition-colors duration-200">
                Cart
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">Shipping Information</span>
        </nav>

        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Shipping Information</h1>
            <p class="text-xl text-slate-600">Where should we deliver your order?</p>
        </div>
    </div>
</div>

<!-- Progress Indicator -->
<div class="bg-white border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <!-- Step 1: Cart Review -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-emerald-600">Cart Review</p>
                    <p class="text-xs text-slate-500">Completed</p>
                </div>
            </div>
            
            <div class="flex-1 mx-4">
                <div class="h-1 bg-emerald-600 rounded-full"></div>
            </div>

            <!-- Step 2: Shipping -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    2
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-purple-600">Shipping</p>
                    <p class="text-xs text-slate-500">Current step</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-slate-200 rounded-full"></div>
            </div>

            <!-- Step 3: Payment -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                    3
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-500">Payment</p>
                    <p class="text-xs text-slate-400">Next step</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-slate-200 rounded-full"></div>
            </div>

            <!-- Step 4: Confirmation -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                    4
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-500">Review</p>
                    <p class="text-xs text-slate-400">Final step</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <form method="POST" action="{{ route('checkout.payment') }}" class="space-y-8">
        @csrf
        
        <!-- Shipping Information Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Delivery Address</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="full_name" class="block text-sm font-semibold text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" id="full_name" required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('full_name') border-red-500 @enderror"
                           value="{{ old('full_name', auth()->user()->name) }}"
                           placeholder="Enter your full name">
                    @error('full_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address *</label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('email') border-red-500 @enderror"
                           value="{{ old('email', auth()->user()->email) }}"
                           placeholder="Enter your email address">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Phone Number *</label>
                    <input type="tel" name="phone" id="phone" required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('phone') border-red-500 @enderror"
                           value="{{ old('phone', auth()->user()->phone) }}"
                           placeholder="Enter your phone number">
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="country" class="block text-sm font-semibold text-slate-700 mb-2">Country *</label>
                    <select name="country" id="country" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('country') border-red-500 @enderror">
                        <option value="">Select Country</option>
                        <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                        <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                        <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                    </select>
                    @error('country')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-6">
                <label for="address" class="block text-sm font-semibold text-slate-700 mb-2">Street Address *</label>
                <textarea name="address" id="address" rows="3" required
                          class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('address') border-red-500 @enderror"
                          placeholder="Enter your complete street address">{{ old('address', auth()->user()->address) }}</textarea>
                @error('address')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="city" class="block text-sm font-semibold text-slate-700 mb-2">City *</label>
                    <input type="text" name="city" id="city" required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('city') border-red-500 @enderror"
                           value="{{ old('city') }}"
                           placeholder="Enter your city">
                    @error('city')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="postal_code" class="block text-sm font-semibold text-slate-700 mb-2">Postal Code *</label>
                    <input type="text" name="postal_code" id="postal_code" required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors duration-200 @error('postal_code') border-red-500 @enderror"
                           value="{{ old('postal_code') }}"
                           placeholder="Enter postal code">
                    @error('postal_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('checkout.index') }}" 
                class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Cart Review
            </a>
            
            <button type="submit" 
                    class="gradient-primary text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center shadow-modern">
                Continue to Payment
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection
