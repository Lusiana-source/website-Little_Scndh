<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class BuyNowController extends Controller
{
    public function buyNow(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Simpan di session
        session([
            'buy_now' => [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image
            ]
        ]);

        return redirect()->route('checkout.buy-now');
    }

    public function showCheckout()
    {
        $item = session('buy_now');

        if (!$item) {
            return redirect('/shop')->with('error', 'Tidak ada produk untuk dibeli.');
        }

        return view('checkout.buy-now', compact('item'));
    }

    public function processCheckout(Request $request)
    {
        $item = session('buy_now');

        if (!$item) {
            return redirect('/shop')->with('error', 'Checkout gagal. Tidak ada produk.');
        }

        $product = Product::findOrFail($item['product_id']);

        if ($product->stock < $item['quantity']) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Simpan order
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $product->price * $item['quantity'],
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $item['quantity'],
            'price' => $product->price,
        ]);

        // Update stok
        $product->decrement('stock', $item['quantity']);

        // Hapus sesi
        session()->forget('buy_now');

        return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat.');
    }
}
