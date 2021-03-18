<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Guitar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Piano',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flute',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Drums',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trumpet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
