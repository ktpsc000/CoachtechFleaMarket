<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class ItemSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_商品名で部分一致検索ができる()
    {
        Item::factory()->create(['name' => '腕時計']);
        Item::factory()->create(['name' => 'HDD']);
        Item::factory()->create(['name' => '玉ねぎ3束']);

        $response = $this->get('/?keyword=腕');

        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
        $response->assertDontSee('玉ねぎ3束');
    }

    public function test_検索状態がマイリストでも保持されている()
    {
        $user = User::factory()->create();
        $favoriteItem = Item::factory()->create(['name' => '腕時計']);
        $otherItem  = Item::factory()->create(['name' => 'HDD']);

        $user->favoriteItems()->attach($favoriteItem->id);

        $response = $this->actingAs($user)
        ->get('/?keyword=腕');

        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
        $response->assertSee('value="腕"', false);

        $response->assertSee('/?tab=mylist&keyword=腕', false);

        $response = $this->actingAs($user)
            ->get('/?tab=mylist&keyword=腕');

        $response->assertSee('腕時計');
        $response->assertSee('value="腕"', false);
    }
}
