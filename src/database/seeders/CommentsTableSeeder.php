<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert(
            [
                'item_id' => 2,
                'user_id' => 1,
                'content' => 'コメントがここに入ります'
            ]);
    }
}
