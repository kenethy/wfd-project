@extends('layouts.app')

@section('title', 'User Management - Admin')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">User Management</h1>
                <p class="text-slate-300 mt-2">Manage user accounts, roles, and permissions</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center gap-4">
            <!-- Search -->
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Role Filter -->
            <select name="role" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">All Roles</option>
                <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="seller" {{ request('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <!-- Status Filter -->
            <select name="status" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>

            <!-- Filter Button -->
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                Filter
            </button>

            <!-- Clear Filters -->
            @if(request()->hasAny(['search', 'role', 'status']))
            <a href="{{ route('admin.users.index') }}" class="text-slate-600 hover:text-purple-600 px-4 py-2 border border-slate-300 rounded-lg hover:border-purple-300 transition-colors duration-200">
                Clear
            </a>
            @endif
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
                                    <div class="text-sm text-slate-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 
                                   ($user->role === 'seller' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.users.show', $user) }}" class="text-purple-600 hover:text-purple-900">View</a>
                            
                            <!-- Role Change Dropdown -->
                            <div class="inline-block relative" x-data="{ open: false, position: 'bottom' }"
                                 x-init="
                                    $watch('open', value => {
                                        if (value) {
                                            $nextTick(() => {
                                                const rect = $el.getBoundingClientRect();
                                                const spaceBelow = window.innerHeight - rect.bottom;
                                                const spaceAbove = rect.top;
                                                position = spaceBelow < 300 && spaceAbove > 300 ? 'top' : 'bottom';
                                            });
                                        }
                                    })
                                 ">
                                <button @click="open = !open"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 border border-blue-200 hover:border-blue-300">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                    Role
                                </button>
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     @click.outside="open = false"
                                     :class="position === 'top' ? 'absolute left-0 bottom-full mb-2 w-48 bg-white rounded-xl shadow-lg z-30 border border-slate-200 py-1' : 'absolute left-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg z-30 border border-slate-200 py-1'"
                                     style="display: none;">
                                    <div class="px-3 py-2 border-b border-slate-100">
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Change Role</p>
                                    </div>

                                    <!-- Customer Option -->
                                    <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="role" value="customer"
                                                class="w-full flex items-center px-3 py-2 text-sm text-slate-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-200 {{ $user->role === 'customer' ? 'bg-green-50 text-green-700' : '' }}">
                                            <div class="w-2 h-2 rounded-full mr-2 {{ $user->role === 'customer' ? 'bg-green-500' : 'bg-slate-300' }}"></div>
                                            <span class="font-medium">Customer</span>
                                            @if($user->role === 'customer')
                                            <svg class="w-3 h-3 text-green-600 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Seller Option -->
                                    <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="role" value="seller"
                                                class="w-full flex items-center px-3 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200 {{ $user->role === 'seller' ? 'bg-blue-50 text-blue-700' : '' }}">
                                            <div class="w-2 h-2 rounded-full mr-2 {{ $user->role === 'seller' ? 'bg-blue-500' : 'bg-slate-300' }}"></div>
                                            <span class="font-medium">Seller</span>
                                            @if($user->role === 'seller')
                                            <svg class="w-3 h-3 text-blue-600 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Admin Option -->
                                    <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="role" value="admin"
                                                class="w-full flex items-center px-3 py-2 text-sm text-slate-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-200 {{ $user->role === 'admin' ? 'bg-red-50 text-red-700' : '' }}">
                                            <div class="w-2 h-2 rounded-full mr-2 {{ $user->role === 'admin' ? 'bg-red-500' : 'bg-slate-300' }}"></div>
                                            <span class="font-medium">Admin</span>
                                            @if($user->role === 'admin')
                                            <svg class="w-3 h-3 text-red-600 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Toggle Status -->
                            <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <p class="text-lg font-medium">No users found</p>
                                <p class="text-sm">Try adjusting your search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="bg-white px-4 py-3 border-t border-slate-200 sm:px-6">
            {{ $users->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
