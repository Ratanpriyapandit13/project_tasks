<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $electronics = Category::create(['name' => 'Electronics']);
        $clothing = Category::create(['name' => 'Clothing']);
        $Grocery = Category::create(['name' => 'Grocery']);

        Product::create([
            'name' => 'Smartphone',
            'price' => 499.99,
            'category_id' => $electronics->id,
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Laptop',
            'price' => 899.00,
            'category_id' => $electronics->id,
            'stock' => 20,
        ]);

        Product::create([
            'name' => 'T-Shirt',
            'price' => 19.99,
            'category_id' => $clothing->id,
            'stock' => 150,
        ]);

        Product::create([
            'name' => 'T-Shirt',
            'price' => 19.99,
            'category_id' => $Grocery->id,
            'stock' => 150,
        ]);
    }
}
