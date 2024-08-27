<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use App\Services\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Get posts by user ID. Throws an exception if no posts are found.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getUserPosts($userId)
    {
        $posts = $this->postRepository->findByUser($userId);

        if ($posts->isEmpty()) {
            throw new ModelNotFoundException('No posts found for this user.');
        }

        return $posts;
    }

    /**
     * Get a specific post by user ID and post ID. Throws an exception if not found.
     *
     * @param int $userId
     * @param int $postId
     * @return \App\Models\Post
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getUserPost($userId, $postId)
    {
        $post = $this->postRepository->findByIdAndUser($userId, $postId);

        if ($post->isEmpty()) {
            throw new ModelNotFoundException('Post not found for the specified user.');
        }

        return $post->first(); // Assuming you want a single post, use `first()` to get the model instance.
    }

    public function createPost(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->postRepository->create($data);
    }

    public function updatePost($postId, array $data, $userId)
    {
        $post =$this->postRepository->find($postId);

        if ($post->user_id !== $userId) {
            throw new \Exception('Unauthorized');
        }
        $post =$this->postRepository->update($postId, $data);
        return $post;
    }

    public function deletePost($postId, $userId)
    {
        $post =$this->postRepository->find($postId);

        if ($post->user_id !== $userId) {
            throw new \Exception('Unauthorized');
        }

        $post = $this->postRepository->delete($postId);
        return true;
    }
}
