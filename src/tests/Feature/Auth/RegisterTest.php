<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_名前未入力でエラー表示()
    {
        $response = $this->from('/register')->post('/register',[
            'name' => '',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name']);
        $response = $this->get('/register');
        $response->assertSee('お名前を入力してください');
    }

    public function test_メアド未入力でエラー表示()
    {
        $response = $this->from('/register')->post('/register',[
            'name' => 'test',
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['email']);
        $response = $this->get('/register');
        $response->assertSee('メールアドレスを入力してください');
    }

    public function test_パスワード未入力でエラー表示()
    {
        $response = $this->from('/register')->post('/register',[
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);
        $response = $this->get('/register');
        $response->assertSee('パスワードを入力してください');
    }

    public function test_パスワード7文字以下でエラー表示()
    {
        $response = $this->from('/register')->post('/register',[
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);
        $response = $this->get('/register');
        $response->assertSee('パスワードは8文字以上で入力してください');
    }

    public function test_パスワード不一致でエラー表示()
    {
        $response = $this->from('/register')->post('/register',[
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '12345678',
            'password_confirmation' => '10000008',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);
        $response = $this->get('/register');
        $response->assertSee('パスワードと一致しません');
    }

    public function test_会員登録後、認証メールが送信される()
    {

        Notification::fake();

        $response = $this->from('/register')->post('/register', [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $user = User::where('email', 'test@test.com')->first();

        $this->assertNotNull($user);

        Notification::assertSentTo($user, VerifyEmail::class);
    }
}
