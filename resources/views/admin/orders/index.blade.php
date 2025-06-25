@extends('layouts.admin')

@section('title', 'Data Pesanan')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-center">Ringkasan Pesanan</h1>

    <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full border text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-4 py-3 border">ID</th>
                    <th class="px-4 py-3 border">Pembeli</th>
                    <th class="px-4 py-3 border">Email</th>
                    <th class="px-4 py-3 border">Total</th>
                    <th class="px-4 py-3 border">Bukti Pembayaran</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border">No. Resi</th>
                    <th class="px-4 py-3 border">Tanggal</th>
                    <th class="px-4 py-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">#{{ $order->id }}</td>
                        <td class="px-4 py-2 border">{{ $order->name }}</td>
                        <td class="px-4 py-2 border">{{ $order->email }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">
    @if ($order->payment_proof)
        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-blue-600 underline text-sm">
            Lihat Bukti
        </a>
    @else
        <span class="text-gray-400 italic text-sm">Belum ada</span>
    @endif
</td>

<td class="px-4 py-2 border">
    @php
        $statusColor = match($order->status) {
            'pending' => 'bg-yellow-200 text-yellow-800',
            'Menunggu Konfirmasi' => 'bg-green-200 text-green-800',
            'Dikirim' => 'bg-blue-200 text-blue-800',
            'Selesai' => 'bg-gray-200 text-gray-800',
            default => 'bg-gray-100 text-gray-500',
        };
    @endphp
    <span class="inline-block px-2 py-1 text-xs rounded font-semibold {{ $statusColor }}">
        {{ ucfirst($order->status) }}
    </span>
</td>

                        <td class="px-4 py-2 border">{{ $order->no_resi ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 border">
                            @if($order->status === 'pending')
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="text-indigo-600 hover:underline text-sm font-medium">
                                 Kirim Barang
                                </a>
                            @else
                                <span class="text-gray-500 text-sm">Dikirim</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500 py-6">Tidak ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
