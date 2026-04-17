<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

class ItemIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_全商品を取得できる()
    {
        $items = Item::factory()->count(3)->create();
        $response = $this->get('/');
        foreach ($items as $item){
            $response->assertSee($item->name);
            $response->assertSee($item->image_path);
        };
    }

    public function test_購入済み商品はSoldと表示される()
    {
        $item = Item::factory()->create();

        Order::factory()->create(['item_id' => $item->id,]);

        $response = $this->get('/');

        $response->assertSee($item->name);
        $response->assertSee($item->image_path);
        $response->assertSee('Sold');
    }

    public function test_自分が出品した商品は表示されない()
    {
        $user = User::factory()->create();

        $myItem = Item::factory()->create([
            'user_id' => $user->id,
            'image_path' => 'items/my_item.jpg',
            ]);
        $otherItem = Item::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertSee($otherItem->name);
        $response->assertSee($otherItem->image_path);
        $response->assertDontSee($myItem->name);
        $response->assertDontSee($myItem->image_path);
    }
}
