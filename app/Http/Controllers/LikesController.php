<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postLikes = Like::where('target_type', Post::class)->get();

        $commentLikes = Like::where('target_type', Comment::class)->get();

        return view('likes.index', compact('postLikes', 'commentLikes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $targetId = $request->input('target_id');
        $targetType = $request->input('target_type');

        // Check if the user has already liked the target
        $existingLike = Like::where('user_id', $user->id)
            ->where('target_id', $targetId)
            ->where('target_type', $targetType)
            ->first();

        if (!$existingLike) {
            $like = new Like([
                'user_id' => $user->id,
                'target_id' => $targetId,
                'target_type' => $targetType,
            ]);
            $like->save();
        }

        return response()->json(['success' => true]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Like $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();

        return response()->json(['success' => true]);
    }

    public function like(Post $post)
{
    $user = auth()->user();

    $like = new Like([
        'user_id' => $user->id,
        'target_id' => $post->id,
        'target_type' => 'post', 
    ]);

    $like->save();

    return redirect()->back();
}

public function unlike(Post $post)
{
    $user = auth()->user();

    $like = Like::where('user_id', $user->id)
        ->where('target_id', $post->id)
        ->where('target_type', 'post') 
        ->first();

    if ($like) {
        $like->delete();
    }

    return redirect()->back();
}

}
