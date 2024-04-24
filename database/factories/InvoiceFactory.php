<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_number' => fake()->unique()->numerify('INV###'),
            'invoice_date' => fake()->date(),
            'point_of_sale_id' => \App\Models\PointOfSale::factory(),
            'user_id' => \App\Models\User::factory(),
            'total_price' => fake()->randomFloat(2, 100, 1000),
            'discount' => fake()->optional()->randomFloat(2, 0, 50),
            'tax' => fake()->randomFloat(2, 5, 20),
        ];
    }
}
