@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 mt-12 rounded-xl shadow-lg">
    {{-- Flash Message --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-gray-800 mb-10 text-center">Detail Produk</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Gambar Produk -->
        <div class="bg-white p-4 rounded-xl shadow-md w-full flex justify-center">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg') }}"
                 alt="{{ $product->name }}"
                 class="w-48 h-48 object-cover rounded-md border border-gray-200 shadow-sm">
        </div>

        <!-- Informasi Produk -->
        <div class="space-y-5 text-gray-700">
            <div>
                <p class="text-xl font-semibold">Nama Produk</p>
                <p class="text-lg">{{ $product->name }}</p>
            </div>

            <div>
                <p class="text-xl font-semibold">Kategori</p>
                <p class="text-lg">{{ $product->category->name ?? 'Kategori Tidak Diketahui' }}</p>
            </div>

            @if($product->size)
            <div>
                <p class="text-xl font-semibold">Ukuran</p>
                <p class="text-lg">{{ $product->size }}</p>
            </div>
            @endif

            <div>
                <p class="text-xl font-semibold">Harga</p>
                <p class="text-xl text-green-600 font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-xl font-semibold">Stok</p>
                <p class="text-lg">{{ $product->stock }} pcs</p>
                @if($product->stock == 0)
                    <p class="text-red-600 text-sm font-semibold mt-1">⚠️ Produk sedang kosong</p>
                @endif
            </div>

            @if($product->description)
            <div>
                <p class="text-xl font-semibold">Deskripsi</p>
                <p class="text-gray-600 text-sm">{{ $product->description }}</p>
            </div>
            @endif

            <!-- Tombol Aksi -->
            <div class="space-y-3 pt-6">
                <!-- Tombol Kembali -->
                <a href="{{ url('/shop') }}"
                   class="w-full block text-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 transition">
                    ← Kembali ke Daftar Produk
                </a>

                @if ($product->stock > 0)
                    <!-- Tambah ke Keranjang -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 bg-green-500 text-white rounded-md text-center hover:bg-green-600 transition">
                            Tambah ke Keranjang
                        </button>
                    </form>

                    <!-- Beli Sekarang -->
                    <form action="{{ route('buy.now') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-yellow-500 text-white rounded-md text-center hover:bg-yellow-600 transition">
                            Beli Sekarang
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
