<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function user_login_without_credential(): void
    {
        $response = $this->post('/api/login');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
        ]);
        $response->assertSee('Your email or password is empty');
    }

    /**
     * @test
     */
    public function user_successful_login()
    {
        $response = $this->post('/api/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertJsonStructure([
            'success',
            'status' => ['code', 'message'],
            'data' => ['accessToken', 'tokenType', 'user'],
        ]);
        $response->assertSee('Successfully logged in');
    }

    /**
     * @test
     */
    public function user_invalid_login()
    {
        $response = $this->post('/api/login', [
            'email' => $this->user->email,
            'password' => 'wrong_password',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
        ]);
        $response->assertJsonStructure([
            'success',
            'status' => ['code', 'message'],
            'data' => [],
        ]);
        $response->assertSee('Your email or password is incorrect');
    }
}
