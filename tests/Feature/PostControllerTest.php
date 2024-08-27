<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];
        $response = $this->post('/api/register', $data);

        // Obtain authentication token
        $response = $this->post('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);
        $this->token = $response->json('token');
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

}
