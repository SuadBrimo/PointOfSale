<?php

namespace Database\Factories;

use App\Models\InvoiceProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_id' => \App\Models\Invoice::factory(),
            'product_warehouse_id' => \App\Models\ProductWarehouse::factory(),
            'quantity' => fake()->numberBetween(1, 100),
            'unit_price' => fake()->randomFloat(2, 10, 1000),
            'total_price' => fake()->randomFloat(2, 10, 10000),
        ];
    }
}
