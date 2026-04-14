<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class ItemShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_商品詳細ページに必要な情報が表示される()
    {
        $seller = User::factory()->create();
        $category = Category::create(['name' => '家電']);
        $item = Item::factory()->create([
            'user_id' => $seller->id,
            'image_path' => 'items/sample.jpg',
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'これはテスト用の商品説明です。',
            'price' => 10000,
            'condition' => 1,
        ]);

        $item->categories()->attach([$category->id]);

        $favoriteUsers = User::factory()->count(3)->create();
        foreach ($favoriteUsers as $favoriteUser) {
            $item->favoriteUsers()->attach($favoriteUser->id);
        }

        $commentUsers = User::factory()->count(2)->create();
        foreach ($commentUsers as $commentUser) {
            $commentUser->profile()->create([
                'name' => 'テストユーザー',
                'postal_code' => '000-0000',
                'address' => 'テスト住所',
                'image_path' => 'default.jpg',
            ]);

            Comment::create([
                'item_id' => $item->id,
                'user_id' => $commentUser->id,
                'content' => 'テストコメント',
            ]);
        }

        $response = $this->get("/item/{$item->id}");

        $response->assertSee($item->image_url, false);
        $response->assertSee($item->name);
        $response->assertSee($item->brand);
        $response->assertSee(number_format($item->price));
        $response->assertSee('3');
        $response->assertSee('2');
        $response->assertSee($item->description);
        $response->assertSee('家電');
        $response->assertSee($item->condition_text);
        $response->assertSee('コメント(2)');
        $response->assertSee('テストユーザー');
        $response->assertSee('テストコメント');

    }

    public function test_複数選択されたカテゴリが表示される()
    {
        $seller = User::factory()->create();

        $category1 = Category::create(['name' => '本']);
        $category2 = Category::create(['name' => 'ゲーム']);

        $item = Item::factory()->create([
            'user_id' => $seller->id,
        ]);

        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('本');
        $response->assertSee('ゲーム');
    }
}
