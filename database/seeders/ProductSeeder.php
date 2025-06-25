<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder {
    public function run() {
        Product::create([
            'name' => 'T-Shirt Vintage',
            'category' => 1, 
            'price' => 75000,
            'image' => 'produk1.jpg', 
        ]);
    }
}
