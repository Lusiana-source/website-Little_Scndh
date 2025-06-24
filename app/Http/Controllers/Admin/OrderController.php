<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::latest()->paginate(10);
    return view('admin.orders.index', compact('orders'));
}
    // Menampilkan form input resi dan ubah status
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Simpan data pengiriman (ubah status & isi nomor resi)
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,dikirim,selesai',
            'no_resi' => 'nullable|string|max:255',
        ]);

        $order->update([
            'status'   => $request->status,
            'no_resi'  => $request->no_resi,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function confirmPayment(Order $order)
{
    $order->status = 'dibayar';
    $order->save();

    return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
}

}
