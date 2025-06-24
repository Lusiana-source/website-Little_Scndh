<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
public function index(Request $request)
{

    $products = Product::with('category')
        ->when($request->search, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->when($request->category, function($query) use ($request) {
            $query->where('category_id', $request->category);
        })
        ->paginate(12); // Tampilkan 12 produk per halaman

    $categories = Category::all();

    return view('shop', compact('products', 'categories'));
}

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }
}
