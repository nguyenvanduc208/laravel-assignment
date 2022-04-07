<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\News;
use App\Models\ParentCategory;
use App\Models\ProductNew;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        ParentCategory::factory(10)->create();
        Category::factory(20)->create();
        Product::factory(1000)->create();
    }
}
