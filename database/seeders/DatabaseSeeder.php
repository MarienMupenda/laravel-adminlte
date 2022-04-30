<?php

namespace Database\Seeders;

use App\Http\Controllers\Dashboard\BussinessApi;
use App\Models\Business;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Price;
use App\Models\Selling;
use App\Models\SellingDetail;
use App\Models\Stock;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

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
            SizeSeeder::class,
            ColorSeeder::class,
        ]);

        //  User::factory(5)->create();


    }
}
