@extends('layouts.app')

@section('title', 'Tambah Produk - Faciona Seller')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Produk Baru</h1>
            <p class="text-gray-600 mt-2">Lengkapi informasi produk yang akan Anda jual</p>
        </div>
        <a href="{{ route('seller.products.index') }}"
            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18">
                </path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <!-- Basic Information -->
            <div class="px-6 py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Dasar</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            placeholder="Masukkan nama produk yang menarik">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : ''
                                }}>
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
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0"
                            step="1000"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                            placeholder="50000">
                        @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stok *</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror"
                            placeholder="100">
                        @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk
                            *</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                            placeholder="Deskripsikan produk Anda dengan detail...">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Variants -->
            <div class="px-6 py-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Varian Produk</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sizes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ukuran Tersedia</label>
                        <div class="space-y-2">
                            @php
                            $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '28', '29', '30', '31', '32', '33',
                            '34'];
                            $oldSizes = old('sizes', []);
                            @endphp
                            @foreach($availableSizes as $size)
                            <label class="flex items-center">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size, $oldSizes)
                                    ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $size }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colors -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Warna Tersedia</label>
                        <div class="space-y-2">
                            @php
                            $availableColors = ['Putih', 'Hitam', 'Abu-abu', 'Navy', 'Biru', 'Merah', 'Pink', 'Hijau',
                            'Kuning', 'Ungu'];
                            $oldColors = old('colors', []);
                            @endphp
                            @foreach($availableColors as $color)
                            <label class="flex items-center">
                                <input type="checkbox" name="colors[]" value="{{ $color }}" {{ in_array($color,
                                    $oldColors) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $color }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="px-6 py-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Gambar Produk</h2>

                <div class="space-y-4">
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar</label>
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
                                        <span>Upload gambar</span>
                                        <input id="images" name="images[]" type="file" class="sr-only" multiple
                                            accept="image/*" onchange="previewImages(this)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP hingga 2MB (maksimal 5 gambar)</p>
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
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Produk
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
            // Check file count limit
            if (input.files.length > 5) {
                alert('Maksimal 5 gambar yang dapat diupload');
                input.value = '';
                preview.classList.add('hidden');
                return;
            }

            preview.classList.remove('hidden');

            // Add upload status indicator
            const statusDiv = document.createElement('div');
            statusDiv.className = 'col-span-full mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg';
            statusDiv.innerHTML = `
                <div class="flex items-center text-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    ${input.files.length} gambar siap diupload
                </div>
            `;
            preview.appendChild(statusDiv);

            Array.from(input.files).slice(0, 5).forEach((file, index) => {
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert(`File ${file.name} bukan gambar yang valid`);
                    return;
                }

                // Validate file size (2MB = 2048KB)
                if (file.size > 2048 * 1024) {
                    alert(`File ${file.name} terlalu besar. Maksimal 2MB`);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-gray-300 group-hover:border-blue-400 transition-colors">
                        <div class="absolute top-1 right-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            ${index + 1}
                        </div>
                        <div class="absolute bottom-1 left-1 bg-green-500 text-white text-xs px-2 py-1 rounded">
                            ✓ Siap
                        </div>
                    `;
                    preview.appendChild(div);
                };

                reader.onerror = function () {
                    alert(`Gagal membaca file ${file.name}`);
                };

                reader.readAsDataURL(file);
            });
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
@endsection