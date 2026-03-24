<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'item_id' => 1,
            'buyer_id' => 2,
            'seller_id' => 1,
            'price' => 15000,
            'payment_method' =>"カード払い",
            'postal_code' => "012-3456",
            'address' => "東京都",
            'building' => "渋谷マンション",
        ]);
    }
}
