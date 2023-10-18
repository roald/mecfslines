<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\CommentRequest;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return redirect()->route('posts.show', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $comment = new Comment([
            'commented_at' => Carbon::now(),
        ]);
        $comment->post = $post;
        $users = User::orderBy('name')->get();
        return view('comments.edit')->with('comment', $comment)->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post)
    {
        $comment = new Comment($request->allValidated());
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->route('posts.show', $comment->post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return redirect()->route('posts.show', $comment->post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $users = User::orderBy('name')->get();
        return view('comments.edit')->with('comment', $comment)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->fill($request->allValidated())->save();
        return redirect()->route('posts.show', $comment->post);
    }

    public function remove(Comment $comment)
    {
        return view('comments.remove')->with('comment', $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $post = $comment->post;
        $comment->delete();
        return redirect()->route('posts.show', $post);
    }
}
