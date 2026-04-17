<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_「購入する」ボタンを押すと購入が完了する()
{
    $buyer = User::factory()->create(['profile_completed' => true]);
    $seller = User::factory()->create();

    $buyer->profile()->create([
        'name' => $buyer->name,
        'image_path' => 'default.png',
        'postal_code' => '123-4567',
        'address' => '東京都渋谷区1-1-1',
        'building' => 'テストビル101',
    ]);

    $item = Item::factory()->create([
        'user_id' => $seller->id,
        'price' => 1000,
    ]);

    $sessionData = [
        'purchase' => [
            'payment_method' => 'コンビニ払い',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
            'building' => 'テストビル101',
        ],
    ];

    $response = $this->actingAs($buyer)
        ->withSession($sessionData)
        ->post("/purchase/{$item->id}", [
            'payment_method' => 'コンビニ払い',
        ]);

    $response->assertRedirect('/');

    $this->assertDatabaseHas('orders', [
        'buyer_id' => $buyer->id,
        'seller_id' => $seller->id,
        'item_id' => $item->id,
        'payment_method' => 'コンビニ払い',
    ]);
}

    public function test_購入した商品は商品一覧画面にて「sold」と表示される()
    {
        $buyer = User::factory()->create(['profile_completed' => true]);
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        Order::factory()->create([
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'item_id' => $item->id,
            'payment_method' => 'コンビニ払い',
        ]);

        $response = $this->get('/');
        $response->assertSee('Sold');
    }

    public function test_プロフィールの「購入した商品一覧」に追加されている()
    {
        $buyer = User::factory()->create(['profile_completed' => true]);
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        Order::factory()->create([
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'item_id' => $item->id,
            'payment_method' => 'コンビニ払い',
        ]);

        $response = $this->actingAs($buyer)->get('/mypage?tab=buy');
        $response->assertSee($item->name);
    }
}
