@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Riwayat Pesanan</h1>

    @if($orders->isEmpty())
        <div class="text-center bg-yellow-100 text-yellow-800 py-6 rounded-md shadow">
            <p class="text-lg font-semibold">Kamu belum pernah melakukan pesanan.</p>
        </div>
    @else
        <div class="space-y-8">
            @foreach($orders as $order)
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">ID Pesanan: #{{ $order->id }}</h2>
                        <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>

                    <p class="text-base text-gray-700 mb-2">
                        Status: 
                        <span class="inline-block px-2 py-1 text-sm rounded 
                            {{ $order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    <p class="text-base text-gray-700 mb-4">
                        Total Harga: 
                        <span class="font-semibold text-green-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-base border border-gray-200 rounded">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-3 border text-left">Produk</th>
                                    <th class="px-4 py-3 border text-left">Harga</th>
                                    <th class="px-4 py-3 border text-left">Jumlah</th>
                                    <th class="px-4 py-3 border text-left">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800">
                                @foreach($order->items as $item)
                                    <tr class="border-t">
                                        <td class="px-4 py-3 border">{{ $item->product->name }}</td>
                                        <td class="px-4 py-3 border">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 border">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<div class="text-center mt-10">
    <a href="{{ url('/') }}"
       class="inline-block bg-indigo-600 text-white text-base font-semibold px-6 py-3 rounded hover:bg-indigo-700 transition">
        ← Kembali ke Beranda
    </a>
</div>

@endsection
