<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Item::find(1);
        $item->categories()->attach([1, 2, 3]);

        $item = Item::find(2);
        $item->categories()->attach([1, 2, 3]);
    }
}
