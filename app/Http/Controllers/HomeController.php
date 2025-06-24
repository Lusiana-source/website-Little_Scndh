<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
public function index(Request $request)
{
    $products = Product::whereIn('id', function ($query) {
        $query->select('product_id')
              ->from('order_items')
              ->groupBy('product_id');
    })
    ->withCount(['orderItems as total_terjual' => function ($q) {
        $q->select(\DB::raw("SUM(quantity)"));
    }])
    ->orderByDesc('total_terjual')
    ->take(8)
    ->get();

    $categories = Category::all(); // <- Tambahkan baris ini

    return view('admin.home', compact('products', 'categories')); // <- Tambahkan 'categories'
} 
    
    
    public function shop(Request $request)
    {
        $query = Product::query();
    
        // Filter berdasarkan pencarian nama produk
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        $products = $query->get();
        $categories = Category::all();
    
        return view('shop', compact('products', 'categories'));
    }
    
   // public function about() 
   // {
   // return view('about');
   // }
   public function contact()
    {
        return view('contact');
    }
}
