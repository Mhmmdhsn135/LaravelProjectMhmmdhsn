<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return response()->json(Tag::with('posts')->get());
    }

    public function store(Request $request)
    {
        $tag = Tag::create($request->only('name'));
        return response()->json($tag,201);
    }

    public function show($id)
    {
        $tag = Tag::with('posts')->find($id);
        if(!$tag) return response()->json(['message'=>'Tag not found'],404);
        return response()->json($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        if(!$tag) return response()->json(['message'=>'Tag not found'],404);
        $tag->update($request->only('name'));
        return response()->json($tag);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if(!$tag) return response()->json(['message'=>'Tag not found'],404);
        $tag->delete();
        return response()->json(['message'=>'Tag deleted']);
    }
}
