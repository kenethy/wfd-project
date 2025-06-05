<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@wfd.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'is_active' => true,
        ]);

        // Seller Users
        User::create([
            'name' => 'Toko Fashion A',
            'email' => 'seller1@wfd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'phone' => '081234567891',
            'address' => 'Jl. Seller A No. 10, Bandung',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Toko Fashion B',
            'email' => 'seller2@wfd.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'phone' => '081234567892',
            'address' => 'Jl. Seller B No. 20, Surabaya',
            'is_active' => true,
        ]);

        // Customer Users
        User::create([
            'name' => 'John Doe',
            'email' => 'customer1@wfd.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081234567893',
            'address' => 'Jl. Customer 1 No. 30, Jakarta',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'customer2@wfd.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081234567894',
            'address' => 'Jl. Customer 2 No. 40, Yogyakarta',
            'is_active' => true,
        ]);
    }
}
