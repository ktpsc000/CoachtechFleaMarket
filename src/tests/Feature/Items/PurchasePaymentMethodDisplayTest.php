<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class PurchasePaymentMethodDisplayTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_支払い方法選択が画面に反映される()
    {
        $user = User::factory()->create(['profile_completed' => true]);

        $user->profile()->create([
            'name' => $user->name,
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
            'building' => 'テストビル',
            'image_path' => 'default.png',
        ]);

        $item = Item::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->withSession([
                'purchase' => [
                    'payment_method' => 'カード払い',
                    'postal_code' => '123-4567',
                    'address' => '東京都渋谷区1-1-1',
                    'building' => 'テストビル',
                ]
            ])
            ->get("/purchase/{$item->id}");

        $response->assertSee('カード払い');
    }
}
