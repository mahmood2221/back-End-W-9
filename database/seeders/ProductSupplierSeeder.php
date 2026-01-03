<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSupplierSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Product::all()->each(function ($product) {
                        $product->suppliers()->attach([
                            rand(1,5) => ['cost_price'=>100,'lead_time_days'=>7],
                rand(1,5) => ['cost_price'=>120,'lead_time_days'=>5],
            ]);
                    });



    }
}
