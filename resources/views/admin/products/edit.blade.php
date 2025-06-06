@extends('layouts.app')

@section('title', 'Edit Product - Admin')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 to-purple-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Edit Product</h1>
                <p class="text-slate-300 mt-2">Update product information</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                ← Back to Products
            </a>
        </div>
    </div>
</div>

<!-- Form -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-400 @enderror"
                        placeholder="Enter product name">
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select id="category_id" name="category_id" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('category_id') border-red-400 @enderror">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-slate-700 mb-2">
                        Price (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0" step="0.01"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('price') border-red-400 @enderror"
                        placeholder="Enter price">
                    @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-slate-700 mb-2">
                        Stock Quantity <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('stock') border-red-400 @enderror"
                        placeholder="Enter stock quantity">
                    @error('stock')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-400 @enderror"
                    placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-slate-300 rounded">
                    <span class="ml-2 text-sm font-medium text-slate-700">Active Product</span>
                </label>
                <p class="mt-1 text-sm text-slate-500">Active products will be visible to customers</p>
            </div>

            <!-- Current Product Info -->
            <div class="bg-slate-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-slate-700 mb-2">Current Product Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500">Seller:</span>
                        <span class="font-medium">{{ $product->seller->name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Created:</span>
                        <span class="font-medium">{{ $product->created_at->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Current Category:</span>
                        <span class="font-medium">{{ $product->category->name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Last Updated:</span>
                        <span class="font-medium">{{ $product->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
