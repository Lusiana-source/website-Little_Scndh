@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white p-8 rounded-xl shadow-md text-center w-full max-w-md">
        <div class="flex justify-center mb-4">
            <div class="bg-green-100 text-green-600 w-12 h-12 flex items-center justify-center rounded-full text-2xl">
                <i class="fas fa-check"></i>
            </div>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h2>
        <p class="text-gray-600 mb-6">
            Terima kasih telah berbelanja di <span class="text-blue-600 font-medium">Little Scndh</span>.
            Kami akan segera memproses pesananmu.
        </p>

        <a href="{{ route('orders.history') }}"
           class="w-full bg-blue-600 text-white font-medium text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-receipt"></i> Lihat Riwayat Pesanan
        </a>

        <a href="{{ route('home') }}"
           class="w-full mt-2 bg-gray-800 text-white font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-900 transition duration-200 flex items-center justify-center gap-2">
            ← Kembali ke Beranda
        </a>
        
@if ($order && $order->payment_method === 'transfer' && !$order->payment_proof)
    <div class="mt-6 text-center">
        <p class="text-gray-700 mb-2">Silakan upload bukti transfer untuk menyelesaikan pesanan.</p>
        <a href="{{ route('checkout.uploadProof.form', $order->id) }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Upload Bukti Pembayaran
        </a>
    </div>
@endif
    </div>
</div>
@endsection
