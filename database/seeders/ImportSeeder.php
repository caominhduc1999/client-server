<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imports')->insert([
            [
                'name' => 'Import instrumental Goods',
                'vendor_id' => 3,
                'import_date' => date('2021-01-01'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Import special Accessories',
                'vendor_id' => 3,
                'import_date' => date('2021-01-01'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
