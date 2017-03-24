<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Tag;

class PostController extends Controller
{
    protected $post;
    public function __construct(Post $post)
    {
        $this->middleware('auth');
        $this->post=$post;
    }


    public function create (Request $request)
    {
        /*post validation*/
        $post=$this->post;//new Post();
        $this->validate($request, [
            'title' => 'required|max:1000',
            'body' => 'required',
        ]);

        /*post store*/
        $post->user_id=Auth::id();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->created_at=Carbon::now('Asia/Dhaka');
        $post->save();


        /*save post*/


        foreach(request('tag') as $tag)
        {
            /*
            * if tag not found, store tag
            */

            //if found, store on post_tag pivot table
            DB::table('post_tag')->insert([
                'post_id'=> $post->id,
                'tag_id' => $tag,
            ]);
        }
        return redirect('/');
    }

    public function show(Post $post)
    {

        $comments=$post->comments->sortByDesc('created_at');
        return view('others.show_post', compact('post', 'comments'));
    }


    public function update(Post $post)
    {

        if(Auth::id()==$post->user->id) {
            return view('others.update_post', compact('post'));
        }
        else abort(404);
    }

    public function patch(Post $id)
    {
        $id->update([
            'title' =>request('title'),
            'body'=>request('body')
        ]);


        /*fetch all tags requested*/
        if(request('tag'))
        {
            /*delete associated tag from pivot*/
            foreach($id->tags as $tag)
            {
                DB::table('post_tag')
                    ->where('post_id', '=', $id->id)
                    ->delete();
            }

            /*insert all requested*/
            foreach(request('tag') as $tag)
            {
                DB::table('post_tag')->insert([
                    'post_id'=> $id->id,
                    'tag_id' => $tag,
                ]);
            }
        }

        return redirect('post/'.$id->id);
    }

    public function delete(Post $id)
    {

        /*delete tag record from post_tag pivot*/
        foreach($id->tags as $tag)
        {
            DB::table('post_tag')
                ->where('post_id', '=', $id->id)
                ->delete();
        }

        $id->delete();
        return redirect('/');
    }
    
}
