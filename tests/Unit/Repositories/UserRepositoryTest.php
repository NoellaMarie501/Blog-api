<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected UserRepository $userRepository;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = Mockery::mock(User::class);
        $this->userRepository = new UserRepository($this->user);
    }

    public function testFind()
    {
        $id = 1;
        $user = new User(['id' => $id, 'name' => 'John Doe', 'email' => 'john@example.com']);
        
        
        // Mocking the findOrFail method
        $this->user->shouldReceive('findOrFail')
            ->with($id)
            ->once()
            ->andReturn($user);
        $result = $this->userRepository->find($id);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('John Doe', $result->name);
        $this->assertEquals('john@example.com', $result->email);
    }

    public function testFindEmail()
    {
        $email = 'test@example.com';
        $user = new User(['email' => $email, 'name' => 'John Doe']);
        
        // Mocking the where and firstOrFail methods
        $this->user->shouldReceive('where')
            ->with('email', $email)
            ->once()
            ->andReturnSelf();
        $this->user->shouldReceive('firstOrFail')
            ->once()
            ->andReturn($user);

        $result = $this->userRepository->findEmail($email);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($email, $result->email);
    }

    public function testAll()
    {
        $users = new Collection([
            new User(['id' => 1, 'name' => 'User 1']),
            new User(['id' => 2, 'name' => 'User 2'])
        ]);

        // Mocking the all method
        $this->user->shouldReceive('all')
            ->once()
            ->andReturn($users);

        $result = $this->userRepository->all();
        $this->assertCount(2, $result);
    }

    public function testCreate()
    {
        $data = ['name' => 'New User', 'email' => 'newuser@example.com'];
        $user = new User($data);

        // Mocking the create method
        $this->user->shouldReceive('create')
            ->with($data)
            ->once()
            ->andReturn($user);

        $result = $this->userRepository->create($data);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($data['name'], $result->name);
        $this->assertEquals($data['email'], $result->email);
    }


}
