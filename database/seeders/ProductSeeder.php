<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DB::table('categories')->where('status', 1)->pluck('cateid')->toArray();
        $brands = DB::table('brands')->where('status', 1)->pluck('id')->toArray();

        if (empty($categories)) {
            $categories = DB::table('categories')->pluck('cateid')->toArray();
        }
        if (empty($brands)) {
            $brands = DB::table('brands')->pluck('id')->toArray();
        }

        for ($i = 1; $i <= 15; $i++) {
            $name = fake()->unique()->words(3, true);
            $price = fake()->randomFloat(2, 100000, 5000000);
            $priceSale = fake()->boolean(40) ? $price * 0.9 : null;

            DB::table('products')->insert([
                'productname' => ucfirst($name),
                'slug' => Str::slug($name),
                'cateid' => fake()->randomElement($categories),
                'brand_id' => fake()->randomElement($brands),
                'price' => $price,
                'price_sale' => $priceSale,
                'image' => null,
                'quantity' => fake()->numberBetween(5, 100),
                'status' => fake()->numberBetween(0, 1),
                'sort_order' => $i,
                'description' => fake()->sentence(20),
                'detail' => fake()->paragraph(5),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
