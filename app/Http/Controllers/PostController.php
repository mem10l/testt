<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'comments_id' => 'nullable|integer',
        ]);


        $post = Post::create([
            'name' => $validated['name'],
            'status' => $validated['status'],
            'user_id' => 1,
            'comments_id' => $validated['comments_id'] ?? null,
        ]);

        return response()->json($post, 201);
    }


    public function index() {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'comments_id' => 'nullable|integer',
        ]);

        $post = Post::find($id);

        if (!$post || $post->user_id !== 1) {
            return response()->json(['message' => 'Post not found or access denied'], 404);
        }

        $post->name = $validated['name'] ?? $post->name;
        $post->status = $validated['status'] ?? $post->status;
        $post->comments_id = $validated['comments_id'] ?? $post->comments_id;
        $post->save();

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post || $post->user_id !== 1) {
            return response()->json(['message' => 'Post not found or access denied'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
