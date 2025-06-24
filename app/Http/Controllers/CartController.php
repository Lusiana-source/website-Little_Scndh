<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
   public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Cek apakah stok habis
    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'Stok produk habis dan tidak dapat ditambahkan ke keranjang.');
    }

    // Ambil cart dari session
    $cart = session()->get('cart', []);

    // Jika produk sudah ada di cart, tambahkan jumlahnya
    if (isset($cart[$id])) {
        // Tambah hanya jika belum melebihi stok
        if ($cart[$id]['quantity'] + 1 > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'name'     => $product->name,
            'price'    => $product->price,
            'image'    => $product->image,
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}
}
