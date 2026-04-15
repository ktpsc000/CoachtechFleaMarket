<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class FavoriteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;


    public function test_いいねアイコンを押下後、いいね登録することができる()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/favorite");

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_追加済みのアイコンは色が変化する()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $this->actingAs($user)
            ->post("/item/{$item->id}/favorite");

        $response = $this->actingAs($user)
            ->get("/item/{$item->id}");

        $response->assertSee('ハートロゴ_ピンク.png', false);
        $response->assertSee('>1<', false);
    }

    public function test_再度いいねアイコンを押下後、いいね解除ができる()
    {
        $user = User::factory()->create(['profile_completed' => true]);
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $this->actingAs($user)
            ->post("/item/{$item->id}/favorite");

        $this->actingAs($user)
            ->post("/item/{$item->id}/favorite");

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->get("/item/{$item->id}");

        $response->assertSee('ハートロゴ_デフォルト.png', false);
        $response->assertSee('>0<', false);
    }
}
