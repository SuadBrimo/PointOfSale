<?php

namespace Database\Seeders;

use App\Models\PointOfSale;
use Illuminate\Database\Seeder;

class PointOfSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        PointOfSale::factory(10)->create();
    }
}
