@extends('layouts.admin')

@section('content')
<div class="p-6 bg-blue-100 min-h-screen">
    <h1 class="text-2xl font-semibold mb-4">Manajemen Produk</h1>

    {{-- Tombol Tambah Produk --}}
    <div class="mb-6">
        <a href="{{ route('products.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
            + Tambah Produk
        </a>
    </div>

    {{-- Tabel Produk --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm bg-white border border-gray-200 shadow rounded-lg">
            <thead class="bg-gray-100 uppercase text-sm font-semibold text-gray-700">
                <tr>
                    <th class="px-4 py-3 border-b">Gambar</th>
                    <th class="px-4 py-3 border-b">Nama</th>
                    <th class="px-4 py-3 border-b">Kategori</th>
                    <th class="px-4 py-3 border-b">Harga</th>
                    <th class="px-4 py-3 border-b">Stok</th>
                    <th class="px-4 py-3 border-b">Size</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-16 h-16 object-cover rounded-md">
                        </td>
                        <td class="px-4 py-2 border-b font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-4 py-2 border-b">
                            <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b text-green-600 font-semibold">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 border-b">
                            @if ($product->stock == 0)
                                <span class="text-red-600 font-semibold">0 pcs</span>
                            @else
                                {{ $product->stock }} pcs
                            @endif
                        </td>
                        <td class="py-2 px-4 border text-center">
                                 {{ $product->size ?? '-' }}
                        </td>
                        <td class="px-4 py-2 border-b">
                            <div class="flex flex-wrap justify-center items-center gap-2">
                               <!-- <a href="{{ route('products.show', $product->id) }}" 
                                    class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                    Detail
                                </a>-->
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
@if ($products->hasPages())
<div class="mt-6 flex justify-center">
    <nav class="inline-flex space-x-1 text-sm" role="navigation" aria-label="Pagination Navigation">
        {{-- Previous --}}
        @if ($products->onFirstPage())
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $products->previousPageUrl() }}" 
               class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700">&laquo;</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
                <span class="px-3 py-2 bg-blue-500 text-white font-semibold rounded">{{ $page }}</span>
            @else
                <a href="{{ $url }}" 
                   class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next --}}
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" 
               class="px-3 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-gray-700">&raquo;</a>
        @else
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">&raquo;</span>
        @endif
    </nav>
</div>
@endif

</div>
@endsection
