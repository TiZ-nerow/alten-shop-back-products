<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = \File::json(frontPath('src\\assets\\products.json'));

        foreach (data_get($json, 'data') as $product) {
            Product::query()->updateOrCreate($product);
        }
    }
}
