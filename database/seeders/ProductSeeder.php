<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Tidak ada kategori. Jalankan CategorySeeder dulu.');
            return;
        }

        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) {
                Product::create([
                    'name' => $category->name . " Product {$i}",
                    'price' => fake()->randomFloat(2, 10000, 500000), 
                    'category_id' => $category->id,
                    'stock' => fake()->numberBetween(0, 100),
                    'image_path' => null,
                    'description' => fake()->sentence(10),
                ]);
            }
        }
    }
}
