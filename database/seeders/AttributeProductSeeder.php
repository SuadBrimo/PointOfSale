<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $attributes = Attribute::all();

        foreach ($products as $product) {
            $product->attributes()->attach($attributes->random(), ['value' => fake()->word]);
        }
    }
}
