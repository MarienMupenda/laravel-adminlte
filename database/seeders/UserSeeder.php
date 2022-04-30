<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        foreach ($this->data() as $data) {
            User::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'name' => "Admin",
                'email' => "admin@smirl.org",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'company_id' => 1,
                'role_id' => 1,
                'remember_token' => Str::random(10),
            ]
        ];
    }
}
