<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'code' => 'CODE25',
                'discount' => '25',
                'start_date' => date('2021-01-01'),
                'end_date' => date('2022-01-01'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CODE50',
                'discount' => '50',
                'start_date' => date('2021-01-01'),
                'end_date' => date('2022-01-01'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CODE10',
                'discount' => '10',
                'start_date' => date('2021-01-01'),
                'end_date' => date('2022-01-01'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
