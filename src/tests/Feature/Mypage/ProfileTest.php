<?php

namespace Tests\Feature\Mypage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order;


class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_必要な情報が全て取得できる()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'profile_completed' => true,
        ]);

        Profile::create([
            'name' => $user->name,
            'user_id' => $user->id,
            'image_path' => 'default.jpg',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
            'building' => 'テストビル101',
        ]);

        $seller = User::factory()->create();

        $sellItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品',
        ]);

        $buyItem = Item::factory()->create([
            'user_id' => $seller->id,
            'name' => '購入商品',
        ]);

        Order::factory()->create([
            'item_id' => $buyItem->id,
            'buyer_id' => $user->id,
            'seller_id' => $seller->id,
        ]);

        $this->actingAs($user);


        $response = $this->get('/mypage');
        $response->assertSee('テストユーザー');
        $response->assertSee('default.jpg');

        $response = $this->get('/mypage?page=sell');
        $response->assertSee('出品商品');

        $response = $this->get('/mypage?page=buy');
        $response->assertSee('購入商品');
    }
}
