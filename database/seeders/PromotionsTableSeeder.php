<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\PromotionSetting;
use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::factory(10)
            ->has(PromotionSetting::factory())
            ->create();
    }
}
