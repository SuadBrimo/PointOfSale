<?php

namespace Database\Seeders;

use App\Models\ProductWarehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductWarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductWarehouse::factory(10)->create();
    }
}
