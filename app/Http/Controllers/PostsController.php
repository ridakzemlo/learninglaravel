<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {

        $posts = Post::latest()
            ->filter(\request(['month', 'year']))
            ->get();


        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();

        return view('posts.index', compact('posts', 'archives'));
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

        auth()->user()->publish(
            new Post(\request(['title', 'body']))
        );

        /*
        Post::create([
            'title' => \request('title'),
            'body' =>\request('body'),
            'user_id' => auth()->id()
        ]);
        */


        // And then redirect (to home maybe?)
        return redirect('/');
    }
}
