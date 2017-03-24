<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user)
    {
        $posts=$user->post()->latest()->paginate(5);
        return view('user_profile', compact('user', 'posts'));
    }

    public function update_form()
    {
        $user=Auth::user();
        return view('update', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        /*validate request*/

        $this->validate($request,[
            'name'=>'required|min:2',
            'email' =>'required|email',
            'phone' => '',
            'avatar' => 'dimensions:max_width=1000,max_height=2000'
        ]);

        $path="";
        if($request->hasFile('avatar')){
            $path = Storage::url($request->file('avatar')->store('public/avatars'));
            $user->avatar=$path;
            $user->save();
        }//store avatar

        $user->update(request()->all());
        return redirect('/user/'.$user->id);
    }

}
