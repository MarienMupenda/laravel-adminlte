<?php

namespace Database\Seeders;

use App\Http\Controllers\Dashboard\BussinessApi;
use App\Models\Price;
use App\Models\SellingDetail;
use App\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->call([
            CategorySeeder::class,
            BusinessSeeder::class,
            CompanySeeder::class,
            CurrencySeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            ContactSeeder::class,
            UserRoleSeeder::class
        ]);

        //  User::factory(5)->create();


    }
}
