<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

   public function create()
    {
        return view('posts.create');
    }


    public function index() {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request)
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

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


   public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        $post = Post::findOrFail($id);

        $post->update([
            'name' => $validated['name'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }



public function destroy($id)
{
    $post = Post::find($id);

    if (!$post) {
        return redirect()->route('posts.index')->with('error', 'Post not found');
    }

    $users = \App\Models\User::where('Posts_id', $id)->get();

    if ($users->isNotEmpty()) {
        $users->each(function ($user) {
            $user->Posts_id = null;
            $user->save();
        });
    }

    Log::info("Attempting to delete post", ['post' => $post, 'user_id' => auth()->id()]);

    $post->delete();

    DB::statement('ALTER TABLE posts AUTO_INCREMENT = 1');

    return redirect()->route('posts.index')->with('success', 'Post deleted and reindexed successfully');
}

}