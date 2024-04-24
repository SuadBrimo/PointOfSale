<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

        $this->call(CategoriesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(WarehousesTableSeeder::class);
        $this->call(PointOfSaleSeeder::class);
        $this->call(AttributeProductSeeder::class);
        $this->call(ProductWarehouseTableSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(InvoiceProductSeeder::class);

    }
}
