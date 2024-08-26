<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PostController extends Controller
{
    /**
     * Repository object
     * 
     * @var PostRepositoryInterface $postRepository
     */
    protected $postRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = Auth::user()->posts;
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $data = $request->only(['title', 'content']);
            $data['user_id'] = Auth::id();
            $post = $this->postRepository->create($data);

            return response()->json($post, 201);
        } catch (Throwable $e) {
            return response()->json(['mesage' => $e->getMessage(), 'trace' => $e->getTrace(), 'error' => $e], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $post = Post::findOrFail($id);
            if ($post->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();

            return response()->json($post);
        } catch (Throwable $e) {
            return response()->json(['mesage' => $e->getMessage(), 'trace' => $e->getTrace(), 'error' => $e], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            if ($post->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $post->delete();
            return response()->json(['mesage' => 'Post Deleted'], 200);

        } catch (Throwable $e) {
            return response()->json(['mesage' => $e->getMessage(), 'trace' => $e->getTrace(), 'error' => $e], 400);
        }
    }
}
