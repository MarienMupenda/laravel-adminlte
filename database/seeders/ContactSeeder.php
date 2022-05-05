<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::truncate();
        foreach ($this->data() as $data) {
            Contact::create($data);
        }
    }

    private function data()
    {
        return [
            [
                'company_id' => 1,
                'whatsapp' => '243970966587',
                'facebook' => 'SmirlTech',
            ]
        ];
    }
}
