<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // ✅ 

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Electronics', 'Fashion', 'Home', 'Books', 'Sports'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat
            ]);
        }
    }
}
