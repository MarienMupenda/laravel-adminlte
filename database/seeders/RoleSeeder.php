<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::truncate();
        foreach ($this->data() as $data) {
            Role::create($data);
        }
    }


    private function data()
    {
        return [
            [
                'name' => 'Super Admin',
                'description' => 'Full access',
            ],
            [
                'name' => 'Admin',
                'description' => 'Company full access',

            ],
            [
                'name' => 'Seller',
                'description' => 'Company selling access',

            ],
            [
                'name' => 'Customer',
                'description' => 'buying access',

            ],
        ];
    }

}
