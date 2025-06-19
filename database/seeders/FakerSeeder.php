<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class FakerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!app()->environment('local')) {
            return;
        }

        Product::factory()->count(24)->create();
//        ProductImage::factory()->count(40)->create();
    }
}
