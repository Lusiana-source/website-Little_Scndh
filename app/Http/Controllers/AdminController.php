<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class AdminController extends Controller
{
public function index()
{
    $totalProduk = Product::count();
    $totalPesanan = Order::count();
    $totalPendapatan = Order::sum('total_price');

    $pesananTerbaru = Order::latest()->take(5)->get();
    $produkTerbaru = Product::latest()->take(5)->get();
    
    // Tambahkan ini
    $pesananTertunda = Order::where('status', 'pending')->count();

    // Ambil produk terlaris
    $produkTerlaris = DB::table('order_items')
        ->select('product_id', DB::raw('SUM(quantity) as total_terjual'))
        ->groupBy('product_id')
        ->orderByDesc('total_terjual')
        ->first();

    if ($produkTerlaris) {
        $produkTerlaris = Product::find($produkTerlaris->product_id);
        $produkTerlaris->total_terjual = DB::table('order_items')
            ->where('product_id', $produkTerlaris->id)
            ->sum('quantity');
    }

    // Produk stok rendah
    $stokRendah = Product::where('stock', '<=', 5)->get();

    return view('admin.dashboard', compact(
        'totalProduk',
        'totalPesanan',
        'totalPendapatan',
        'pesananTerbaru',
        'produkTerbaru',
        'produkTerlaris',
        'stokRendah',
        'pesananTertunda' // ← pastikan ini dikirim ke view
    ));
}
}