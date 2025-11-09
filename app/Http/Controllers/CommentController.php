<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return response()->json(Comment::with(['user','post'])->get());
    }

    public function store(Request $request)
    {
        $comment = Comment::create($request->only('user_id','post_id','content'));
        return response()->json($comment,201);
    }

    public function show($id)
    {
        $comment = Comment::with(['user','post'])->find($id);
        if(!$comment) return response()->json(['message'=>'Comment not found'],404);
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment) return response()->json(['message'=>'Comment not found'],404);
        $comment->update($request->only('content'));
        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(!$comment) return response()->json(['message'=>'Comment not found'],404);
        $comment->delete();
        return response()->json(['message'=>'Comment deleted']);
    }
}
