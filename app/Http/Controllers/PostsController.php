<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $this->validate(\request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        // Create a new post using the request data
        // Save it to database
        Post::create(\request(['title', 'body']));


        // And then redirect (to home maybe?)
        return redirect('/');
    }
}
