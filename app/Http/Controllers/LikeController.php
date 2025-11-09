<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        return response()->json(Like::with(['user','post'])->get());
    }

    public function store(Request $request)
    {
        $like = Like::create($request->only('user_id','post_id'));
        return response()->json($like,201);
    }

    public function show($id)
    {
        $like = Like::with(['user','post'])->find($id);
        if(!$like) return response()->json(['message'=>'Like not found'],404);
        return response()->json($like);
    }

    public function update(Request $request, $id)
    {
        $like = Like::find($id);
        if(!$like) return response()->json(['message'=>'Like not found'],404);
        // معمولاً update روی like نیاز نیست، ولی اگه خواستی میتونی user_id/post_id رو تغییر بدی
        return response()->json($like);
    }

    public function destroy($id)
    {
        $like = Like::find($id);
        if(!$like) return response()->json(['message'=>'Like not found'],404);
        $like->delete();
        return response()->json(['message'=>'Like deleted']);
    }
}
