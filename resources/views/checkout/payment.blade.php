@extends('layouts.app')

@section('title', 'Payment Method - Faciona')

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
            <span class="text-slate-800 font-medium">Payment Method</span>
        </nav>

        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Payment Method</h1>
            <p class="text-xl text-slate-600">Choose your preferred payment option</p>
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
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-emerald-600">Shipping</p>
                    <p class="text-xs text-slate-500">Completed</p>
                </div>
            </div>

            <div class="flex-1 mx-4">
                <div class="h-1 bg-emerald-600 rounded-full"></div>
            </div>

            <!-- Step 3: Payment -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    3
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-purple-600">Payment</p>
                    <p class="text-xs text-slate-500">Current step</p>
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
    <form method="POST" action="{{ route('checkout.review') }}" class="space-y-8">
        @csrf
        
        <!-- Payment Methods -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Select Payment Method</h2>
            
            <div class="space-y-4">
                <!-- Cash on Delivery -->
                <label class="flex items-start p-6 border-2 border-slate-200 rounded-xl cursor-pointer hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 group">
                    <input type="radio" name="payment_method" value="cod" class="mt-1 mr-4 text-purple-600 focus:ring-purple-500" checked>
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center group-hover:bg-emerald-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-900 mb-1">Cash on Delivery (COD)</h3>
                            <p class="text-slate-600 mb-2">Pay when your order arrives at your doorstep</p>
                            <div class="flex items-center space-x-2">
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full text-xs font-medium">Recommended</span>
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded-full text-xs">No extra fees</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-emerald-600">Free</span>
                            <p class="text-xs text-slate-500">No processing fee</p>
                        </div>
                    </div>
                </label>

                <!-- Bank Transfer -->
                <label class="flex items-start p-6 border-2 border-slate-200 rounded-xl cursor-not-allowed opacity-60 bg-slate-50">
                    <input type="radio" name="payment_method" value="bank_transfer" class="mt-1 mr-4" disabled>
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-700 mb-1">Bank Transfer</h3>
                            <p class="text-slate-500 mb-2">Transfer directly to our bank account</p>
                            <div class="flex items-center space-x-2">
                                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-medium">Coming Soon</span>
                                <span class="bg-slate-100 text-slate-500 px-2 py-1 rounded-full text-xs">BCA, Mandiri, BNI</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-semibold text-slate-500">Available Soon</span>
                            <p class="text-xs text-slate-400">Secure transfer</p>
                        </div>
                    </div>
                </label>

                <!-- Credit Card -->
                <label class="flex items-start p-6 border-2 border-slate-200 rounded-xl cursor-not-allowed opacity-60 bg-slate-50">
                    <input type="radio" name="payment_method" value="credit_card" class="mt-1 mr-4" disabled>
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-700 mb-1">Credit/Debit Card</h3>
                            <p class="text-slate-500 mb-2">Pay securely with your card</p>
                            <div class="flex items-center space-x-2">
                                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-medium">Coming Soon</span>
                                <span class="bg-slate-100 text-slate-500 px-2 py-1 rounded-full text-xs">Visa, Mastercard</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-semibold text-slate-500">Available Soon</span>
                            <p class="text-xs text-slate-400">SSL encrypted</p>
                        </div>
                    </div>
                </label>

                <!-- E-Wallet -->
                <label class="flex items-start p-6 border-2 border-slate-200 rounded-xl cursor-not-allowed opacity-60 bg-slate-50">
                    <input type="radio" name="payment_method" value="ewallet" class="mt-1 mr-4" disabled>
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-700 mb-1">E-Wallet</h3>
                            <p class="text-slate-500 mb-2">Pay with your digital wallet</p>
                            <div class="flex items-center space-x-2">
                                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-medium">Coming Soon</span>
                                <span class="bg-slate-100 text-slate-500 px-2 py-1 rounded-full text-xs">OVO, GoPay, DANA</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-semibold text-slate-500">Available Soon</span>
                            <p class="text-xs text-slate-400">Instant payment</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="bg-gradient-to-r from-emerald-50 to-blue-50 border border-emerald-200 rounded-2xl p-6">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Secure Payment Guarantee</h3>
                    <p class="text-slate-600 mb-3">Your payment information is protected with industry-standard encryption. We never store your payment details on our servers.</p>
                    <div class="flex items-center space-x-4 text-sm text-slate-600">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>SSL Encrypted</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>PCI Compliant</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Money Back Guarantee</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('checkout.shipping') }}" 
                class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-200 transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Shipping
            </a>
            
            <button type="submit" 
                    class="gradient-primary text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center shadow-modern">
                Review Order
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection
