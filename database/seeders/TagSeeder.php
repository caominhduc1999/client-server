<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'Guitar Tag',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Piano Tag',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Drum Tag',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
