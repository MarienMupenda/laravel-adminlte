<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::truncate();
        foreach ($this->data() as $data) {
            UserRole::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'user_id' => 1,
                'role_id' => 1,
            ]
        ];

    }
}
