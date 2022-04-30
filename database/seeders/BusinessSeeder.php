<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    public function run()
    {
        Business::truncate();
        foreach ($this->data() as $data) {
            Business::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'name' => 'Developpement Logiciel',
            ],
            [
                'name' => 'Restaurants',
            ],
            [
                'name' => 'Boutiques',
            ],
            [
                'name' => 'Hopitaux',
            ],
            [
                'name' => 'Quincailleries',
            ],
            [
                'name' => 'Cabinets juridiques',
            ],
            [
                'name' => 'Sales de fete',
            ],

            [
                'name' => 'Imprimerie',
            ],

        ];
    }
}
