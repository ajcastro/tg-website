<?php

namespace Database\Seeders;

use App\Models\CompanyBank;
use App\Models\Website;
use Illuminate\Database\Seeder;

class CompanyBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyBank::factory(10)->create([
            'website_id' => Website::getWebsiteId()
        ]);
    }
}
