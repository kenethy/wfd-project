<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = User::where('role', 'seller')->get();
        $categories = Category::all();

        $products = [
            [
                'name' => 'Kaos Polos Cotton Combed',
                'description' => 'Kaos polos berbahan cotton combed yang nyaman dan berkualitas tinggi. Cocok untuk aktivitas sehari-hari.',
                'price' => 75000,
                'stock' => 50,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['Putih', 'Hitam', 'Navy', 'Abu-abu'],
                'images' => ['kaos-polos-1.jpg', 'kaos-polos-2.jpg'],
                'category' => 'Kaos'
            ],
            [
                'name' => 'Kemeja Formal Pria',
                'description' => 'Kemeja formal untuk pria dengan bahan berkualitas dan potongan yang rapi. Ideal untuk acara formal.',
                'price' => 150000,
                'stock' => 30,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors' => ['Putih', 'Biru Muda', 'Abu-abu'],
                'images' => ['kemeja-formal-1.jpg', 'kemeja-formal-2.jpg'],
                'category' => 'Kemeja'
            ],
            [
                'name' => 'Celana Jeans Slim Fit',
                'description' => 'Celana jeans dengan model slim fit yang trendy dan nyaman dipakai. Bahan denim berkualitas.',
                'price' => 200000,
                'stock' => 25,
                'sizes' => ['28', '29', '30', '31', '32', '33', '34'],
                'colors' => ['Dark Blue', 'Light Blue', 'Black'],
                'images' => ['jeans-slim-1.jpg', 'jeans-slim-2.jpg'],
                'category' => 'Celana'
            ],
            [
                'name' => 'Dress Casual Wanita',
                'description' => 'Dress casual untuk wanita dengan desain yang elegan dan nyaman. Cocok untuk berbagai acara.',
                'price' => 180000,
                'stock' => 20,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['Merah', 'Biru', 'Hitam', 'Pink'],
                'images' => ['dress-casual-1.jpg', 'dress-casual-2.jpg'],
                'category' => 'Dress'
            ],
            [
                'name' => 'Jaket Hoodie Unisex',
                'description' => 'Jaket hoodie unisex dengan bahan fleece yang hangat dan nyaman. Cocok untuk cuaca dingin.',
                'price' => 250000,
                'stock' => 15,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors' => ['Hitam', 'Abu-abu', 'Navy', 'Maroon'],
                'images' => ['hoodie-1.jpg', 'hoodie-2.jpg'],
                'category' => 'Jaket'
            ],
            [
                'name' => 'Rok Mini Denim',
                'description' => 'Rok mini berbahan denim dengan desain yang trendy dan stylish. Cocok untuk gaya kasual.',
                'price' => 120000,
                'stock' => 35,
                'sizes' => ['S', 'M', 'L'],
                'colors' => ['Blue Denim', 'Black Denim', 'Light Blue'],
                'images' => ['rok-mini-1.jpg', 'rok-mini-2.jpg'],
                'category' => 'Rok'
            ]
        ];

        foreach ($products as $productData) {
            $category = $categories->where('name', $productData['category'])->first();
            $seller = $sellers->random();

            Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'sizes' => $productData['sizes'],
                'colors' => $productData['colors'],
                'images' => $productData['images'],
                'category_id' => $category->id,
                'seller_id' => $seller->id,
                'is_active' => true,
            ]);
        }
    }
}
