<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kaos',
                'description' => 'Koleksi kaos casual dan formal untuk pria dan wanita'
            ],
            [
                'name' => 'Kemeja',
                'description' => 'Kemeja formal dan casual dengan berbagai model'
            ],
            [
                'name' => 'Celana',
                'description' => 'Celana panjang, pendek, jeans, dan formal'
            ],
            [
                'name' => 'Dress',
                'description' => 'Dress casual, formal, dan party untuk wanita'
            ],
            [
                'name' => 'Jaket',
                'description' => 'Jaket dan outerwear untuk berbagai cuaca'
            ],
            [
                'name' => 'Rok',
                'description' => 'Rok dengan berbagai model dan panjang'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }
    }
}
