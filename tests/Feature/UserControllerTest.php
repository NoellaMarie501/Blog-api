<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        // Create a user for authentication tests
        $this->user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegister()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/api/register', $data);

        $response->assertStatus(200);
        $response->assertJson(['user created' => [
            'name' => $data['name'],
            'email' => $data['email'],
        ]]);
    }

    

    public function testLoginUnauthorized()
    {
        $data = [
            'email' => 'john@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->post('/api/login', $data);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Failed to log in: The provided credentials are incorrect.']);
    }

    public function testUserRecord()
    {
        Passport::actingAs($this->user);

        $response = $this->get('/api/user');

        $response->assertStatus(200);
        $response->assertJson(['user' => [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]]);
    }

    public function testUpdatePassword()
    {
        Passport::actingAs($this->user);

        $data = [
            'password' => 'newpassword123',
        ];

        $response = $this->post('/api/update', $data);

        $response->assertStatus(200);
        $response->assertJson(['user' => [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]]);

        // Verify password update
        $this->assertTrue(Hash::check('newpassword123', $this->user->fresh()->password));
    }

    public function testLogout()
    {
        Passport::actingAs($this->user);

        $response = $this->post('/api/logout');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Successfully logged out from all sessions']);
    }
}

