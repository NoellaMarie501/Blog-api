<?php

namespace App\Services;

interface PostServiceInterface
{
    public function getUserPosts($userId);
    
    public function getUserPost($userId, $postId);

    public function createPost(array $data);

    public function updatePost($postId, array $data, $userId);

    public function deletePost($postId, $userId);
}
