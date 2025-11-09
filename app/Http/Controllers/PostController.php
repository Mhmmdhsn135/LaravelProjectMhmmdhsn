<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::with(['user','comments','categories','tags'])->get());
    }

    public function store(Request $request)
    {
        $post = Post::create($request->only('user_id','title','body','published'));
        return response()->json($post,201);
    }

    public function show($id)
    {
        $post = Post::with(['user','comments','categories','tags'])->find($id);
        if(!$post) return response()->json(['message'=>'Post not found'],404);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if(!$post) return response()->json(['message'=>'Post not found'],404);
        $post->update($request->only('title','body','published'));
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if(!$post) return response()->json(['message'=>'Post not found'],404);
        $post->delete();
        return response()->json(['message'=>'Post deleted']);
    }
}
