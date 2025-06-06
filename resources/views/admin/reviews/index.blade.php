@extends('layouts.app')

@section('title', 'Review Management - Admin')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Review Management</h1>
                <p class="text-slate-300 mt-2">Monitor and moderate product reviews</p>
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
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="flex flex-wrap items-center gap-4">
            <!-- Search -->
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reviews, products, or users..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Status Filter -->
            <select name="status" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>

            <!-- Rating Filter -->
            <select name="rating" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">All Ratings</option>
                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
            </select>

            <!-- Filter Button -->
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                Filter
            </button>

            <!-- Clear Filters -->
            @if(request()->hasAny(['search', 'status', 'rating']))
            <a href="{{ route('admin.reviews.index') }}" class="text-slate-600 hover:text-purple-600 px-4 py-2 border border-slate-300 rounded-lg hover:border-purple-300 transition-colors duration-200">
                Clear
            </a>
            @endif
        </form>
    </div>
</div>

<!-- Reviews Table -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Review</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="max-w-xs">
                                @if($review->title)
                                <div class="text-sm font-medium text-slate-900 mb-1">{{ Str::limit($review->title, 30) }}</div>
                                @endif
                                <div class="text-sm text-slate-600">{{ Str::limit($review->comment, 60) }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-lg flex items-center justify-center">
                                    @if($review->product->images && count($review->product->images) > 0)
                                    <img src="{{ asset('storage/products/' . $review->product->images[0]) }}" alt="{{ $review->product->name }}" class="w-10 h-10 object-cover rounded-lg">
                                    @else
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-slate-900">{{ Str::limit($review->product->name, 25) }}</div>
                                    <div class="text-sm text-slate-500">{{ $review->product->category->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-xs">{{ substr($review->user->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-slate-900">{{ $review->user->name }}</div>
                                    <div class="text-sm text-slate-500">{{ $review->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                @endfor
                                <span class="ml-2 text-sm text-slate-600">{{ $review->rating }}/5</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $review->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($review->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($review->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                            {{ $review->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.reviews.show', $review) }}" class="text-purple-600 hover:text-purple-900">View</a>
                            
                            <!-- Quick Status Change -->
                            @if($review->status !== 'approved')
                            <form method="POST" action="{{ route('admin.reviews.update-status', $review) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                            </form>
                            @endif

                            @if($review->status !== 'rejected')
                            <form method="POST" action="{{ route('admin.reviews.update-status', $review) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                            </form>
                            @endif

                            <!-- Delete -->
                            <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-lg font-medium">No reviews found</p>
                                <p class="text-sm">Try adjusting your search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
        <div class="bg-white px-4 py-3 border-t border-slate-200 sm:px-6">
            {{ $reviews->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
