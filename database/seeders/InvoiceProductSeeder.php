<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvoiceProduct;

class InvoiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceProduct::factory(10)->create();
    }
}
