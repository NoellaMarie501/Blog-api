<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function find($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Handle the exception, log it, or rethrow it
            throw new \Exception("Post not found", 404); // You can customize the exception message or code
        }
    }


    public function findByIdAndUser($user_id, $post_id)
    {
        return $this->model->where('id', $post_id)->where('user_id', $user_id)->get();
    }

    public function findByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
        return $post;
    }
}
