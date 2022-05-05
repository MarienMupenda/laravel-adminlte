<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        Currency::truncate();
        foreach ($this->data() as $data) {
            Currency::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'code' => 'CDF',
                'name' => 'Franc Congolais',
                'symbol' => 'Fc',
            ],
            [
                'code' => 'USD',
                'name' => 'Dollars Americains',
                'symbol' => '$',
            ],
        ];
    }
}
