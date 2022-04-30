<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();
        foreach ($this->data() as $data) {
            Color::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'name' => 'Blanc',
                'code' => '#ffffff',
            ],
            [
                'name' => 'Bleu',
                'code' => '#0000ff',
            ],
            [
                'name' => 'Rouge',
                'code' => '#ff0000',
            ],
            [
                'name' => 'Vert',
                'code' => '#00ff00',
            ],
            [
                'name' => 'Noire',
                'code' => '#000000',
            ],
        ];
    }
}
