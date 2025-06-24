<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function history()
    {
        // Pastikan user sudah login
        $orders = auth()->user()
            ->orders()
            ->with('items.product') // pastikan relasi ini ada
            ->latest()
            ->get();

        return view('admin.orders.history', compact('orders'));
    }

    public function adminIndex()
{
    $orders = \App\Models\Order::with('user')->latest()->paginate(10);
    return view('admin.orders.index', compact('orders'));
}

public function showUploadForm($orderId)
{
    $order = Order::findOrFail($orderId);
    return view('orders.upload-proof', compact('order'));
}
public function uploadPaymentProof(Request $request, $orderId)
{
    $request->validate([
        'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $order = Order::findOrFail($orderId);

    // Simpan file
    $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');

    $order->payment_proof = $filePath;
    $order->status = 'Menunggu Konfirmasi';
    $order->save();

    return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diupload.');
}
}
