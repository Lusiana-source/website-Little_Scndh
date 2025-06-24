<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('checkout.index', compact('products', 'cart'));
    }

    public function store(Request $request)
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('checkout.success')->with('error', 'Keranjang kosong.');
    }

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string',
        'address' => 'required|string',
        'payment_method' => 'required|in:cod,transfer,qris',
    ]);

    DB::beginTransaction();

    try {
        $totalPrice = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                return redirect()->route('checkout.success')->with('error', 'Produk tidak ditemukan.');
            }

            $qty = $item['quantity'];

            if ($product->stock < $qty) {
                return redirect()->route('checkout.success')->with('error', 'Stok tidak cukup untuk produk: ' . $product->name);
            }

            $totalPrice += $product->price * $qty;
        }

        // Simpan order ke database
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);
        logger($request->all());


        // Simpan item order
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            $qty = $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $qty,
                'price' => $product->price,
            ]);

            // Update stok produk
            $product->stock -= $qty;
            $product->save();
        }

        session()->forget('cart'); // Kosongkan keranjang
        DB::commit();

        return redirect()->route('checkout.success');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('checkout.success')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function success()
    {
    $order = Order::where('user_id', auth()->id())
                  ->latest()
                  ->first();

    return view('checkout.success', compact('order'));
    }

   public function showUploadProofForm(Order $order)
{
    // Pastikan hanya user yang punya pesanan bisa akses
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('checkout.upload-proof', compact('order'));
}

public function uploadPaymentProof(Request $request, Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $path = $request->file('payment_proof')->store('payment_proofs', 'public');

    $order->update([
        'payment_proof' => $path,
        'status' => 'Menunggu Konfirmasi',
    ]);

    return redirect()->route('orders.history')->with('success', 'Bukti pembayaran berhasil diupload.');
}
 

}
