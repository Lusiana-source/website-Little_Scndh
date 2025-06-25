@extends('layouts.admin')

@section('title', 'Kirim Barang')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Kirim Barang untuk Pesanan #{{ $order->id }}</h1>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
                <input type="hidden" name="status" value="dikirim">
                <div class="mb-4">
                    <label for="resi" class="block font-medium text-sm text-gray-700 mb-1">Nomor Resi</label>
                    <input type="text" name="no_resi" id="no_resi" required
                        class="w-full border rounded px-3 py-2"
                        placeholder="Masukkan nomor resi"
                        value="{{ old('no_resi', $order->no_resi) }}">
                    @error('no_resi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kirim Barang
            </button>
        </div>
    </form>
</div>
@endsection
