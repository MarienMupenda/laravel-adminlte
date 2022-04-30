<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::truncate();
        foreach ($this->data() as $data) {
            Unit::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'name' => 'PCS',
            ],
            [
                'name' => 'Mètres',
            ],
            [
                'name' => 'KG',
            ],
        ];
    }
}
