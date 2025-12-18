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
                'id' => '1',
                'name' => 'Electronics',
                'slug' => 'electronics',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '2',
                'name' => 'Fashion',
                'slug' => 'fashion',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '3',
                'name' => 'Home & Kitchen',
                'slug' => 'home-&-kitchen',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '4',
                'name' => 'Beauty & Personal Care',
                'slug' => 'eauty-&-personal-care',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '5',
                'name' => 'Sports & Fitness',
                'slug' => 'sports-&-fitness',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '6',
                'name' => 'Books & Stationery',
                'slug' => 'books-&-stationery',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '7',
                'name' => 'Toys & Kids',
                'slug' => 'toys-&-kids',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '8',
                'name' => 'Automotive Accessories',
                'slug' => 'automotive-accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '9',
                'name' => 'Grocery & Food',
                'slug' => 'grocery-&-food',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => '10',
                'name' => 'Jewelry & Watches',
                'slug' => 'jewelry-&-watches',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ];
        Category::Insert($data);
    }
}
