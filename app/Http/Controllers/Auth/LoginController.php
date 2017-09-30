<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        session()->flash('message','Welcome to Echo');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * facebook Callback function
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function handleProviderCallback()
    {

        $user = Socialite::driver('facebook')->user();

        /**
         * if user exit then login
         * else register the authorized user and login
         */
        if(Auth::attempt(['email' =>$user->getEmail() , 'provider_id'=>$user->getId()]))
        {
            Auth::login(User::where('provider_id', $user->getId()));
            return redirect('home');
        }

        else{
            $newUser= new \App\User;
            $newUser->name= $user->getName();
            $newUser->provider_id= $user->getId();
            $newUser->email= $user->getEmail();
            $newUser->avatar= $user->getAvatar();
            $newUser->save();
            Auth::login($newUser);
            return redirect('home');
        }
    }
}
