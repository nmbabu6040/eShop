<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->delete();
        $data = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',

            ],

            [
                'name' => 'Fashion',
                'slug' => 'fashion',

            ],

            [
                'name' => 'Home & Kitchen',
                'slug' => 'home-&-kitchen',

            ],

            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'eauty-&-personal-care',

            ],

            [
                'name' => 'Sports & Fitness',
                'slug' => 'sports-&-fitness',

            ],

            [
                'name' => 'Books & Stationery',
                'slug' => 'books-&-stationery',

            ],

            [
                'name' => 'Toys & Kids',
                'slug' => 'toys-&-kids',

            ],

            [
                'name' => 'Automotive Accessories',
                'slug' => 'automotive-accessories',

            ],

            [
                'name' => 'Grocery & Food',
                'slug' => 'grocery-&-food',

            ],

            [
                'name' => 'Jewelry & Watches',
                'slug' => 'jewelry-&-watches',
            ],


        ];

        foreach ($data as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
