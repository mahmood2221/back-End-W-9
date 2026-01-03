<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;


class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::insert([
            ['name'=>'Supplier A','email'=>'a@supplier.com'],
            ['name'=>'Supplier B','email'=>'b@supplier.com'],
            ['name'=>'Supplier C','email'=>'c@supplier.com'],
            ['name'=>'Supplier D','email'=>'d@supplier.com'],
            ['name'=>'Supplier E','email'=>'e@supplier.com'],
        ]);
    }
}

