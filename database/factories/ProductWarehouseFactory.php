<?php

namespace Database\Factories;

use App\Models\ProductWarehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductWarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductWarehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'warehouse_id' => fake()->numberBetween(1, 10),
            'product_id' => fake()->numberBetween(1, 10),
            'product_attributes' => fake()->randomElement([
                [
                    'color' => fake()->colorName,
                    'size' => fake()->randomElement(['S', 'M', 'L', 'XL'])
                ], [
                    'Brand' => fake()->company,
                    'Style' => fake()->randomElement(['Casual', 'Formal', 'Sport']),
                    'Model' => fake()->ean8
                ], [
                    'material' => fake()->randomElement(['cotton', 'polyester', 'wool'])
                ],
            ]),

            'min_stock_level' => fake()->randomFloat(2, 1, 100),
            'quantity' => fake()->numberBetween(1, 100),
            'unit_price' => fake()->randomFloat(2, 10, 1000),
            'receive_date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
