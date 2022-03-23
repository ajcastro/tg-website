<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['code' => 'BCA', 'group' => 'BANK', 'is_active' => 1, 'is_require_account_no' => 1],
            ['code' => 'BNI', 'group' => 'BANK', 'is_active' => 1, 'is_require_account_no' => 1],
            ['code' => 'BRI', 'group' => 'BANK', 'is_active' => 1, 'is_require_account_no' => 1],
            ['code' => 'MANDIRI', 'group' => 'BANK', 'is_active' => 1, 'is_require_account_no' => 1],
            ['code' => 'CIMB', 'group' => 'BANK', 'is_active' => 1, 'is_require_account_no' => 1],
            ['code' => 'PERMATA', 'group' => 'BANK', 'is_active' => 1, 'is_require_account_no' => 1],
            ['code' => 'SAKUKU', 'group' => 'ePAYMENT', 'is_active' => 1, 'is_require_account_no' => 0],
            ['code' => 'GOPAY', 'group' => 'ePAYMENT', 'is_active' => 1, 'is_require_account_no' => 0],
            ['code' => 'LinkAJA', 'group' => 'ePAYMENT', 'is_active' => 1, 'is_require_account_no' => 0],
            ['code' => 'DANA', 'group' => 'ePAYMENT', 'is_active' => 1, 'is_require_account_no' => 0],
            ['code' => 'OVO', 'group' => 'ePAYMENT', 'is_active' => 1, 'is_require_account_no' => 0],
            ['code' => 'JENIUS', 'group' => 'ePAYMENT', 'is_active' => 1, 'is_require_account_no' => 0],
        ];

        foreach ($banks as $bank) {
            \App\Models\Bank::firstOrCreate(['code' => $bank['code']], $bank+[
                'website_id' => Website::getWebsiteId(),
            ]);
        }
    }
}
