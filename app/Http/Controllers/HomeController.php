<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Contracts\Pagination;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function show()
    {
        //$posts=Post::all()->sortByDesc('created_at');
        $posts=Post::latest()->paginate(5);
        if(request('month') || request('year')){
            $posts=DB::table('posts')
                ->where('deleted_at', null)
                ->whereMonth('created_at', request('month'))
                ->whereYear('created_at', request('year'))
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        //$tags=Tag::topTag();
        return view('others.body', compact('posts'));
    }


    
}
