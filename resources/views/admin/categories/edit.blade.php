@extends('layouts.app')

@section('title', 'Edit Category - Admin')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Edit Category</h1>
                <p class="text-slate-300 mt-2">Update category information</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                ← Back to Categories
            </a>
        </div>
    </div>
</div>

<!-- Form -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Category Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-400 @enderror"
                    placeholder="Enter category name">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-2">
                    Description
                </label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-400 @enderror"
                    placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-slate-300 rounded">
                    <span class="ml-2 text-sm font-medium text-slate-700">Active Category</span>
                </label>
                <p class="mt-1 text-sm text-slate-500">Active categories will be visible to users and sellers</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
