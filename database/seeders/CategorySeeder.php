<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        foreach ($this->data() as $category) {
            Category::create($category);
        }
    }

    private function data()
    {
        // create products categories
        return [

            [
                'name' => 'Produit',
                'slug' => 'produit',
                'description' => 'Produits consommables',
                'parent_id' => null,
                'image' => '',
                'type' => 'main'
            ],
            [
                'name' => 'Livre',
                'slug' => 'e-commerce',
                'description' => 'E-commerce category',
                'parent_id' => null,
                'image' => '',
                'type' => 'main'
            ],
        ];

    }
}
