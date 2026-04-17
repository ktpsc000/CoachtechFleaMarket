<?php

namespace Tests\Feature\Items;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

class ExhibitionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_商品出品時に必要な情報が正しく保存される()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        Profile::create([
            'name' => $user->name,
            'user_id' => $user->id,
            'image_path' => 'default.jpg',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
        ]);

        $category1 = Category::create(['name' => 'ファッション',]);
        $category2 = Category::create(['name' => '家電',]);

        $this->actingAs($user);

        $image = UploadedFile::fake()->create('test.jpg', 100);

        $response = $this->post('/sell', [
            'image' => $image,
            'category_ids' => [$category1->id, $category2->id],
            'condition' => 1,
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 1000,
        ]);

        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 1000,
            'condition' => 1,
        ]);

        $item = Item::first();

        $this->assertDatabaseHas('category_item', [
            'item_id' => $item->id,
            'category_id' => $category1->id,
        ]);

        $this->assertDatabaseHas('category_item', [
            'item_id' => $item->id,
            'category_id' => $category2->id,
        ]);
    }
}
