<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;

class MyListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_いいねした商品だけが表示される()
    {
        $user = User::factory()->create();

        $favoriteItem = Item::factory()->create(['name' => 'お気に入り商品',]);
        $otherItem = Item::factory()->create(['name' => '他の商品',]);

        $user->favoriteItems()->attach($favoriteItem->id);

        $response = $this->actingAs($user)
            ->get('/?tab=mylist');

        $response->assertSee('お気に入り商品');
        $response->assertDontSee('他の商品');
    }

    public function test_購入済み商品は「Sold」と表示される()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();
        $item = Item::factory()->create([
            'user_id' => $seller->id,
            'name' => '購入済み商品',
        ]);

        $user->favoriteItems()->attach($item->id);

        Order::factory()->create([
            'item_id' => $item->id,
            'seller_id' => $seller->id,
            'buyer_id' => $user->id,
            'price' => $item->price,
        ]);

        $response = $this->actingAs($user)
            ->get('/?tab=mylist');

        $response->assertSee('購入済み商品');
        $response->assertSee('Sold');
    }

    public function test_未認証の場合は何も表示されない()
    {
        $item = Item::factory()->create(['name' => 'お気に入り商品',]);
        $response = $this->get('/?tab=mylist');

        $response->assertDontSee('お気に入り商品');
    }
}

