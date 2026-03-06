<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->insert([
            [
                'item_id' => 1,
                'user_id' => 1,
            ],
            [
                'item_id' => 1,
                'user_id' => 2,
            ],
            [
                'item_id' => 2,
                'user_id' => 2,
            ],
        ]);
    }
}
