<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        /*validation*/
        $this->validate(request(),[
            'body'=>'required | max:500'
        ]);


         Comment::create([
            'body' => request('body'),
            'post_id' => $post->id,
            'created_at' => Carbon::now('Asia/Dhaka'),
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }
}
