@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Tambah Produk</h2>

    <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Produk -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="category-select"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 @error('category_id') border-red-500 @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Harga</label>
            <input type="text" name="price" value="{{ old('price') }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 @error('price') border-red-500 @enderror">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gambar -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Gambar</label>
            <input type="file" name="image"
                class="w-full px-4 py-2 border rounded-lg @error('image') border-red-500 @enderror">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stok -->
        <div class="mb-4">
            <label for="stock" class="block font-medium mb-1">Stok Produk</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-500 @error('stock') border-red-500 @enderror">
            @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ukuran -->
        <div class="mb-4">
            <label for="size" class="block text-sm font-medium text-gray-700">Ukuran (Size)</label>
            <input type="text" name="size" id="size" value="{{ old('size') }}"
                placeholder="Contoh: M, L, 38, 40"
                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('size') border-red-500 @enderror">
            @error('size')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition mt-4">
            Simpan
        </button>
    </form>
</div>

<!-- JavaScript Validasi Manual -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("productForm");

        form.addEventListener("submit", function (e) {
            const requiredFields = ['name', 'category_id', 'price', 'image', 'stock'];
            let isValid = true;

            requiredFields.forEach(function(field) {
                const input = form.elements[field];
                if (!input || !input.value.trim()) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert("Silakan lengkapi semua form sebelum menyimpan produk.");
            }
        });
    });
</script>
@endsection
