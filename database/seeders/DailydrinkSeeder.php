<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DailydrinkSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Coffee', 'description' => 'Espresso based favorit harian.'],
            ['name' => 'Non Coffee', 'description' => 'Pilihan creamy tanpa kopi.'],
            ['name' => 'Tea', 'description' => 'Teh segar kekinian.'],
            ['name' => 'Frappe', 'description' => 'Blended dingin yang menyegarkan.'],
            ['name' => 'Signature', 'description' => 'Racikan spesial DAILYDRINK.'],
        ];

        $catIds = [];
        foreach ($categories as $c) {
            $cat = Category::firstOrCreate(
                ['slug' => Str::slug($c['name'])],
                ['name' => $c['name'], 'description' => $c['description']]
            );
            $catIds[$c['name']] = $cat->id;
        }

        $products = [
            ['name' => 'Americano', 'cat' => 'Coffee', 'price' => 18000, 'best' => true, 'desc' => 'Espresso bold dengan air, pahit segar untuk fokus harian.'],
            ['name' => 'Cafe Latte', 'cat' => 'Coffee', 'price' => 24000, 'best' => false, 'desc' => 'Espresso lembut dengan susu creamy yang seimbang.'],
            ['name' => 'Caramel Macchiato', 'cat' => 'Coffee', 'price' => 28000, 'best' => true, 'desc' => 'Espresso dengan kombinasi susu creamy dan caramel untuk menemani aktivitas harian.'],
            ['name' => 'Matcha Latte', 'cat' => 'Non Coffee', 'price' => 25000, 'best' => true, 'desc' => 'Matcha premium dengan susu segar, earthy dan creamy.'],
            ['name' => 'Chocolate', 'cat' => 'Non Coffee', 'price' => 22000, 'best' => false, 'desc' => 'Cokelat manis creamy favorit semua umur.'],
            ['name' => 'Thai Tea', 'cat' => 'Tea', 'price' => 18000, 'best' => false, 'desc' => 'Teh Thailand manis creamy dengan aroma khas.'],
            ['name' => 'Strawberry Frappe', 'cat' => 'Frappe', 'price' => 27000, 'best' => true, 'desc' => 'Strawberry segar diblend dengan es dan susu.'],
            ['name' => 'Daily Signature', 'cat' => 'Signature', 'price' => 30000, 'best' => true, 'desc' => 'Racikan spesial DAILYDRINK: kopi susu gula aren + cream.'],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'category_id' => $catIds[$p['cat']],
                    'name' => $p['name'],
                    'description' => $p['desc'],
                    'price' => $p['price'],
                    'stock' => 50,
                    'image' => null,
                    'status' => 'active',
                    'is_best_seller' => $p['best'],
                ]
            );
        }

        User::firstOrCreate(
            ['email' => 'admin@dailydrink.id'],
            ['name' => 'Admin DAILYDRINK', 'password' => Hash::make('password'), 'role' => 'admin', 'phone' => '081234567890']
        );

        User::firstOrCreate(
            ['email' => 'demo@dailydrink.id'],
            ['name' => 'Demo Customer', 'password' => Hash::make('password'), 'role' => 'customer', 'phone' => '081234567891', 'address' => 'Jl. Gen Z No. 1, Jakarta']
        );
    }
}
