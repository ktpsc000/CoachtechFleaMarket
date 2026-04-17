<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;

class PurchaseAddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_送付先住所変更画面にて登録した住所が商品購入画面に反映されている()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        Profile::create([
            'name' => $user->name,
            'user_id' => $user->id,
            'postal_code' => '111-1111',
            'address' => '元の住所',
            'building' => '元ビル',
        ]);

        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $this->actingAs($user);

        $this->patch("/purchase/address/{$item->id}", [
            'postal_code' => '123-4567',
            'address' => '変更後住所',
            'building' => '変更ビル',
        ]);

        $response = $this->get("/purchase/{$item->id}");

        $response->assertSee('123-4567');
        $response->assertSee('変更後住所');
        $response->assertSee('変更ビル');
    }

    public function test_購入した商品に送付先住所が紐づいて登録される()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        Profile::create([
            'name' => $user->name,
            'user_id' => $user->id,
            'postal_code' => '111-1111',
            'address' => '元の住所',
            'building' => '元ビル',
        ]);

        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
            'price' => 1000,
        ]);

        $this->actingAs($user);

        $this->patch("/purchase/address/{$item->id}", [
            'postal_code' => '999-9999',
            'address' => '購入住所',
            'building' => '購入ビル',
        ]);

        $this->post("/purchase/{$item->id}", [
            'payment_method' => 'コンビニ払い',
        ]);

        $this->assertDatabaseHas('orders', [
            'buyer_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => '999-9999',
            'address' => '購入住所',
            'building' => '購入ビル',
        ]);
    }
}
