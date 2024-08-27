<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $postRepository;
    protected $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = Mockery::mock(Post::class);
        $this->postRepository = new PostRepository($this->post);
    }

    public function testFind()
    {
        $id = 1;
        $post = new Post(['id' => $id, 'title' => 'Test Post']);
        $this->post->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn($post);

        $result = $this->postRepository->find($id);
        $this->assertInstanceOf(Post::class, $result);
        $this->assertEquals('Test Post', $result->title);
    }

    public function testAll()
    {
        $posts = collect([
            new Post(['id' => 1, 'title' => 'Post 1']),
            new Post(['id' => 2, 'title' => 'Post 2'])
        ]);

        $this->post->shouldReceive('all')
            ->once()
            ->andReturn($posts);

        $result = $this->postRepository->all();
        $this->assertCount(2, $result);
    }

    public function testCreate()
    {
        $data = ['title' => 'New Post'];
        $post = new Post($data);

        $this->post->shouldReceive('create')
            ->with($data)
            ->andReturn($post);

        $result = $this->postRepository->create($data);
        $this->assertInstanceOf(Post::class, $result);
        $this->assertEquals($data['title'], $result->title);
    }

   
}
