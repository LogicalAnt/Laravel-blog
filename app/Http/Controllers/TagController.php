<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showPost(Tag $tag)
    {
        $posts=$tag->post()->where('deleted_at', '=', null)->paginate(6);
        return view('others.body', compact('posts'));
    }
}
