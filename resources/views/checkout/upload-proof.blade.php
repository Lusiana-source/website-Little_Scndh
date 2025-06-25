@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Upload Bukti Pembayaran</h2>
    <p class="text-gray-600 mb-4">Pesanan ID: {{ $order->id }}</p>

    <form action="{{ route('checkout.uploadProof', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required
               class="w-full mb-4 p-2 border rounded" />
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Upload
        </button>
    </form>
</div>
@endsection
