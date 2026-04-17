<?php

namespace Tests\Feature\Mypage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;

class ProfileEditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_プロフィール編集画面に初期値が表示される()
    {
        $user = User::factory()->create();

        $profile = Profile::create([
            'user_id' => $user->id,
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都テスト',
            'building' => 'テストビル',
            'image_path' => 'test.jpg',
        ]);

        $this->actingAs($user);

        $response = $this->get('/mypage/profile');

        $response->assertSee('test.jpg');
        $response->assertSee('テストユーザー');
        $response->assertSee('123-4567');
        $response->assertSee('東京都テスト');
        $response->assertSee('テストビル');
    }
}
