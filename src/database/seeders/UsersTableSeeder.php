<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => '2026-03-23 15:21:52',
            'profile_completed' => true,
            ],
            [
            'name' => 'test-buyer',
            'email' => 'test-buyer@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => '2026-03-23 15:21:52',
            'profile_completed' => true,
            ]
        ]);
    }
}