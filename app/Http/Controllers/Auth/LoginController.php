<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

        $socialiteUser = Socialite::driver('facebook')->stateless()->user();

        /**
         * if user exist then login
         * else register the authorized user and login
         */
        $user=User::where(['email' => $socialiteUser->getEmail(), 'provider_id' =>$socialiteUser->getId()])->first();
        if($user !== null)
        {
            Auth::loginUsingId($user->id);
            return redirect('home');
        }

        else{
            $newUser= new User;
            $newUser->name= $socialiteUser->getName();
            $newUser->provider_id= $socialiteUser->getId();
            $newUser->email= $socialiteUser->getEmail();
            $newUser->avatar= $socialiteUser->getAvatar();
            $newUser->save();
            Auth::login($newUser);
            return redirect('home');
        }
    }
}
