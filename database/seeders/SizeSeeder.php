<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::truncate();
        foreach ($this->data() as $data) {
            Size::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'name' => 'S',
            ],
            [
                'name' => 'M',
            ],
            [
                'name' => 'L',
            ],
            [
                'name' => 'XL',
            ],
            [
                'name' => 'XXL',
            ],
        ];
    }
}
