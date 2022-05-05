<?php

namespace Database\Seeders;

use App\Models\MainCategory;
use Illuminate\Database\Seeder;

class MainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MainCategory::truncate();
        //create main categories for each main category
        foreach ($this->data() as $data) {
            MainCategory::create($data);
        }


    }

    private function data()
    {
        return [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronics',
                'image' => 'electronics.jpg',
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Clothing',
                'image' => 'clothing.jpg',
            ],
            [
                'name' => 'Furniture',
                'slug' => 'furniture',
                'description' => 'Furniture',
                'image' => 'furniture.jpg',
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'Books',
                'image' => 'books.jpg',
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Sports',
                'image' => 'sports.jpg',
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Home & Garden',
                'image' => 'home-garden.jpg',
            ],
            [
                'name' => 'Toys',
                'slug' => 'toys',
                'description' => 'Toys',
                'image' => 'toys.jpg',
            ],
            [
                'name' => 'Others',
                'slug' => 'others',
                'description' => 'Others',
                'image' => 'others.jpg',
                ''
            ],
        ];
    }
}
