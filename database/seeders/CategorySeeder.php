<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Kaos']);
        Category::create(['name' => 'Celana']);
        Category::create(['name' => 'Hoodie']);
        Category::create(['name' => 'Tas']);
        Category::create(['name' => 'Sepatu']);
        Category::create(['name' => 'Sweater']);
    }
}
