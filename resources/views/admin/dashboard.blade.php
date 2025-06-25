@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
{{-- Judul Dashboard --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800 text-center uppercase tracking-wide">
        ADMIN DASHBOARD
    </h1>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-blue-200 p-6 rounded-lg shadow text-center">
        <h2 class="text-sm text-blue-900">Total Produk</h2>
        <p class="text-2xl font-bold text-blue-900">{{ $totalProduk }}</p>
    </div>
    <div class="bg-green-200 p-6 rounded-lg shadow text-center">
        <h2 class="text-sm text-green-900">Total Pesanan</h2>
        <p class="text-2xl font-bold text-green-900">{{ $totalPesanan }}</p>
    </div>
    <div class="bg-yellow-200 p-6 rounded-lg shadow text-center">
        <h2 class="text-sm text-yellow-900">Total Pendapatan</h2>
        <p class="text-xl font-bold text-yellow-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>
    <div class="bg-red-200 p-6 rounded-lg shadow text-center">
        <h2 class="text-sm text-red-900">Pesanan Tertunda</h2>
        <p class="text-2xl font-bold text-red-900">{{ $pesananTertunda }}</p>
    </div>
</div>

<!-- Produk Stok Rendah 
<div class="bg-white p-6 rounded-2xl shadow-md">
    <h3 class="text-lg font-semibold text-yellow-600 flex items-center gap-2">
        ⚠️ Produk Stok Rendah
    </h3>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-3 text-sm text-gray-700">
    @forelse ($stokRendah as $product)
        <div class="bg-yellow-50 border border-yellow-200 rounded p-3 shadow-sm">
            <p class="font-medium">{{ $product->name }}</p>
            <p class="text-sm text-gray-600">{{ $product->stock }} pcs</p>
        </div>
    @empty
        <div class="col-span-full text-gray-500 italic">Semua stok aman 👍</div>
    @endforelse
</div>
</div> -->

<!-- Produk Terbaru -->
<div class="bg-white p-6 rounded-2xl shadow-md mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Produk Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-200 rounded">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Stok</th>
                    <th class="py-2 px-4 border">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produkTerbaru as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border">{{ $product->name }}</td>
                        <td class="py-2 px-4 border">{{ $product->stock }} pcs</td>
                        <td class="py-2 px-4 border">{{ $product->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
