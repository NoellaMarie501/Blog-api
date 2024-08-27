<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use Throwable;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        try {
            $posts = $this->postService->getUserPosts(Auth::id());
            return response()->json($posts);
        } catch (Throwable $e) {
            Log::error('Error fetching user posts: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'user_id' => Auth::id()
            ]);
            return response()->json(['message' => 'Failed to fetch posts: '. $e->getMessage()], 500);
        }
    }

    public function getPost(Request $request, $id)
    {
        try {
            $post = $this->postService->getUserPost(Auth::id(), $id);
            return response()->json($post);
        } catch (Throwable $e) {
            Log::error('Error fetching post: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'user_id' => Auth::id(),
                'post_id' => $id
            ]);
            return response()->json(['message' => 'Failed to fetch post: '. $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $data = $request->only(['title', 'content']);
            $post = $this->postService->createPost($data);

            return response()->json($post, 201);
        } catch (Throwable $e) {
            Log::error('Error creating post: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'data' => $request->all()
            ]);
            return response()->json(['message' => 'Failed to create post: '. $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $data = $request->only(['title', 'content']);
            $post = $this->postService->updatePost($id, $data, Auth::id());

            return response()->json($post);
        } catch (Throwable $e) {
            Log::error('Error updating post: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'data' => $request->all(),
                'post_id' => $id
            ]);
            return response()->json(['message' => 'Failed to update post: '. $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->postService->deletePost($id, Auth::id());
            return response()->json(['message' => 'Post Deleted'], 200);
        } catch (Throwable $e) {
            Log::error('Error deleting post: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'post_id' => $id
            ]);
            return response()->json(['message' => 'Failed to delete post: '. $e->getMessage()], 400);
        }
    }
}
