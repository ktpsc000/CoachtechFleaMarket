<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_メールアドレス未入力でエラー表示()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => '',
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email']);
        $response = $this->get('/login');
        $response->assertSee('メールアドレスを入力してください');
    }

    public function test_パスワード未入力でエラー表示()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'test@test.com',
            'password' => '',
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['password']);
        $response = $this->get('/login');
        $response->assertSee('パスワードを入力してください');
    }

    public function test_ログイン情報が誤っている場合エラー表示()
    {
        User::factory()->create([
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'aaa@test.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors();
        $response = $this->get('/login');
        $response->assertSee('ログイン情報が登録されていません');
    }

    public function test_正しい情報でログイン成功()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }
}
