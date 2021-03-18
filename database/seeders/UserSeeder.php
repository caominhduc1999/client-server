<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '123456789',
                'password' => Hash::make('123456789'),
                'user_type' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'customer',
                'email' => 'customer@gmail.com',
                'phone' => '123456789',
                'password' => Hash::make('123456789'),
                'user_type' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'vendor',
                'email' => 'vendor@gmail.com',
                'phone' => '123456789',
                'password' => Hash::make('123456789'),
                'user_type' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
