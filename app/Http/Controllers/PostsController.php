<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $posts = Post::all(); 
        $postLikesCounts = [];
        $postComments = [];

    foreach ($posts as $post) {
        $target_id = $post->id;
        $postLikesCounts[$target_id] = Like::where('target_type', 'post')
            ->where('target_id', $target_id)
            ->count();
    }

    foreach ($posts as $post) {
        $post->comments = Comment::where('post_id', $post->id)->get();
    }

    return view('dashboard', compact('posts', 'postLikesCounts', 'user', 'postComments'));

    }

    public function welcome()
    {
        $posts = Post::all(); 
        $postLikesCounts = [];
        $postComments = [];

    foreach ($posts as $post) {
        $target_id = $post->id;
        $postLikesCounts[$target_id] = Like::where('target_type', 'post')
            ->where('target_id', $target_id)
            ->count();
    }

    foreach ($posts as $post) {
        $post->comments = Comment::where('post_id', $post->id)->get();
    }

    return view('welcome', compact('posts', 'postLikesCounts', 'postComments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    $post = new Post;
    $post->title = $request->input('title');
    $post->content = $request->input('content');

    $post->save();

    return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {
        if (auth()->user()->id !== $posts->user_id) {
        $posts->delete();
        return redirect()->route('dashboard');
        }

    }
    
}
