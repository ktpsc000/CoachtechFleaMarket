<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => '1',
            'name' => 'テスト',
            'postal_code' => '123',
            'address' => '東京都',
            'building' => 'Aマンション',
            'image_path' => '',
        ]);
    }
}