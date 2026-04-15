<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_ログイン済みのユーザーはコメントを送信できる()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $response = $this->actingAs($user)->post("/item/{$item->id}", [
            'content' => 'テストコメント',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => 'テストコメント',
        ]);

        $this->assertEquals(1, $item->comments()->count());
    }

    public function test_ログイン前のユーザーはコメントを送信できない()
    {
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $response = $this->post("/item/{$item->id}", [
            'content' => 'テストコメント',
        ]);

        $this->assertDatabaseMissing('comments', [
            'content' => 'テストコメント',
        ]);
    }

    public function test_コメントが未入力場合、バリデーションメッセージが表示される()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $response = $this->actingAs($user)
            ->from("/item/{$item->id}")
            ->post("/item/{$item->id}", [
                'content' => '',
            ]);

        $response->assertRedirect("/item/{$item->id}");
        $response->assertSessionHasErrors('content');

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_コメントが255字以上の場合、バリデーションメッセージが表示される()
    {
        $user = User::factory()->create();
        $seller = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $comment = str_repeat('あ', 256);

        $response = $this->actingAs($user)
            ->from("/item/{$item->id}")
            ->post("/item/{$item->id}", [
                'content' => $comment,
            ]);

        $response->assertRedirect("/item/{$item->id}");
        $response->assertSessionHasErrors('content');

        $this->assertDatabaseCount('comments', 0);
    }
}