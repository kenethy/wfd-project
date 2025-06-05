@extends('layouts.app')

@section('title', 'Edit Product - Faciona Seller')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
            </div>
            <p class="text-gray-600">Update your product information and settings</p>
        </div>
        <a href="{{ route('seller.products.index') }}"
            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18">
                </path>
            </svg>
            <span>Back to Products</span>
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
            </path>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form method="POST" action="{{ route('seller.products.update', $product) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="px-6 py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Basic Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            placeholder="Enter an attractive product name">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) ==
                                $category->id ? 'selected' : '' }}>
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
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (Rp) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                            required min="0" step="1000"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="50000">
                        @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock *</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                            required min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror"
                            placeholder="100">
                        @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Product
                            Description *</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                            placeholder="Describe your product in detail...">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Variants -->
            <div class="px-6 py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Product Variants</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sizes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Available Sizes</label>
                        <div class="space-y-2">
                            @php
                            $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '28', '29', '30', '31', '32', '33',
                            '34'];
                            $selectedSizes = old('sizes', $product->sizes ?? []);
                            @endphp
                            @foreach($availableSizes as $size)
                            <label class="flex items-center">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size,
                                    $selectedSizes) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $size }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colors -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Available Colors</label>
                        <div class="space-y-2">
                            @php
                            $availableColors = ['White', 'Black', 'Gray', 'Navy', 'Blue', 'Red', 'Pink', 'Green',
                            'Yellow', 'Purple'];
                            $selectedColors = old('colors', $product->colors ?? []);
                            @endphp
                            @foreach($availableColors as $color)
                            <label class="flex items-center">
                                <input type="checkbox" name="colors[]" value="{{ $color }}" {{ in_array($color,
                                    $selectedColors) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $color }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Images -->
            @if($product->images && count($product->images) > 0)
            <div class="px-6 py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Current Images</h2>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    @foreach($product->images as $index => $image)
                    <div class="relative">
                        <img src="{{ asset('storage/products/' . $image) }}"
                            class="w-full h-24 object-cover rounded-lg border border-gray-300"
                            alt="Product image {{ $index + 1 }}">
                        <div class="absolute top-1 right-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            {{ $index + 1 }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-sm text-gray-600 mt-2">Upload new images below to replace current images</p>
            </div>
            @endif

            <!-- New Images -->
            <div class="px-6 py-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">{{ $product->images && count($product->images) > 0 ?
                    'Replace Images' : 'Product Images' }}</h2>

                <div class="space-y-4">
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload Images</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="images"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload images</span>
                                        <input id="images" name="images[]" type="file" class="sr-only" multiple
                                            accept="image/*" onchange="previewImages(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 2MB (max 5 images)</p>
                            </div>
                        </div>
                        @error('images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="hidden grid grid-cols-2 md:grid-cols-5 gap-4 mt-4"></div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="px-6 py-6 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('seller.products.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImages(input) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        if (input.files && input.files.length > 0) {
            preview.classList.remove('hidden');

            Array.from(input.files).slice(0, 5).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-gray-300">
                    <div class="absolute top-1 right-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        ${index + 1}
                    </div>
                `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
@endsection