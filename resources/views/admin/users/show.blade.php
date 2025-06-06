@extends('layouts.app')

@section('title', 'User Details - Admin')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">User Details</h1>
                <p class="text-slate-300 mt-2">{{ $user->name }} - {{ ucfirst($user->role) }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                ← Back to Users
            </a>
        </div>
    </div>
</div>

<!-- User Information -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Profile -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">{{ $user->name }}</h2>
                    <p class="text-slate-600">{{ $user->email }}</p>
                    
                    <div class="mt-4 space-y-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 
                               ($user->role === 'seller' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                        <br>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 border-t border-slate-200 pt-6">
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Phone</dt>
                            <dd class="text-sm text-slate-900">{{ $user->phone ?: 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Address</dt>
                            <dd class="text-sm text-slate-900">{{ $user->address ?: 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Joined</dt>
                            <dd class="text-sm text-slate-900">{{ $user->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Last Updated</dt>
                            <dd class="text-sm text-slate-900">{{ $user->updated_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Actions -->
                <div class="mt-6 border-t border-slate-200 pt-6 space-y-4">
                    <!-- Change Role -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Change User Role</label>
                        <div class="space-y-2">
                            <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
                                @csrf
                                @method('PUT')

                                <!-- Customer Option -->
                                <button type="submit" name="role" value="customer"
                                        class="w-full flex items-center p-3 border rounded-lg transition-all duration-200 {{ $user->role === 'customer' ? 'border-green-300 bg-green-50 text-green-700' : 'border-slate-200 hover:border-green-300 hover:bg-green-50' }}">
                                    <div class="w-3 h-3 rounded-full mr-3 {{ $user->role === 'customer' ? 'bg-green-500' : 'bg-slate-300' }}"></div>
                                    <div class="flex-1 text-left">
                                        <div class="font-medium text-sm">Customer</div>
                                        <div class="text-xs text-slate-500">Regular platform user</div>
                                    </div>
                                    @if($user->role === 'customer')
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    @endif
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
                                @csrf
                                @method('PUT')

                                <!-- Seller Option -->
                                <button type="submit" name="role" value="seller"
                                        class="w-full flex items-center p-3 border rounded-lg transition-all duration-200 {{ $user->role === 'seller' ? 'border-blue-300 bg-blue-50 text-blue-700' : 'border-slate-200 hover:border-blue-300 hover:bg-blue-50' }}">
                                    <div class="w-3 h-3 rounded-full mr-3 {{ $user->role === 'seller' ? 'bg-blue-500' : 'bg-slate-300' }}"></div>
                                    <div class="flex-1 text-left">
                                        <div class="font-medium text-sm">Seller</div>
                                        <div class="text-xs text-slate-500">Can sell products</div>
                                    </div>
                                    @if($user->role === 'seller')
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    @endif
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
                                @csrf
                                @method('PUT')

                                <!-- Admin Option -->
                                <button type="submit" name="role" value="admin"
                                        class="w-full flex items-center p-3 border rounded-lg transition-all duration-200 {{ $user->role === 'admin' ? 'border-red-300 bg-red-50 text-red-700' : 'border-slate-200 hover:border-red-300 hover:bg-red-50' }}">
                                    <div class="w-3 h-3 rounded-full mr-3 {{ $user->role === 'admin' ? 'bg-red-500' : 'bg-slate-300' }}"></div>
                                    <div class="flex-1 text-left">
                                        <div class="font-medium text-sm">Admin</div>
                                        <div class="text-xs text-slate-500">Full platform access</div>
                                    </div>
                                    @if($user->role === 'admin')
                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Toggle Status -->
                    <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full px-4 py-3 {{ $user->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition-colors duration-200 font-medium">
                            {{ $user->is_active ? '🔒 Deactivate User' : '✅ Activate User' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Activity -->
        <div class="lg:col-span-2">
            <div class="space-y-6">
                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Total Orders</p>
                                <p class="text-2xl font-bold text-slate-900">{{ $user->orders->count() }}</p>
                            </div>
                        </div>
                    </div>

                    @if($user->role === 'seller')
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Products</p>
                                <p class="text-2xl font-bold text-slate-900">{{ $user->products->count() }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Reviews</p>
                                <p class="text-2xl font-bold text-slate-900">{{ $user->reviews->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                @if($user->orders->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Recent Orders</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($user->orders->sortByDesc('created_at')->take(5) as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        #{{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
