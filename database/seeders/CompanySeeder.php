<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        Company::create([
            'name' => 'SmirlTech Ltd',
            'logo' => 'images/icons/logo.png',
            'currency_id' => 1,
            'info_legale' => 'CD/LD=SH/RCCM/20-B-00362',
            'address' => '35 Avenue Maniema',
            'business_id' => 1,
            'user_id' => 1,
            'description' => 'Entreprise de developpement Logiciel à Lubumbashi'
        ]);
    }
}
