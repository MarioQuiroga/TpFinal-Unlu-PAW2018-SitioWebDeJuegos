<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('guest')->except('logout');*/
    }

    public static function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public static function callback(Request $request,$provider){
        $state = $request->get('state');
        $request->session()->put('state',$state);
        session()->regenerate();

        $gUser = Socialite::driver($provider)->user();
        $user = User::where('email',$gUser->email)->first();
        if(!$user){
            $user = User::create([
                'name'=>$gUser->getName(),
                'email'=>$gUser->getEmail(),
                'password'=>bcrypt('passwordSinNingunSentido'),
                'provider'=>strtoupper($provider),
                'provider_id'=>$gUser->id,
            ]);
        }
       Auth::login($user);

        return view('home');

        //return redirect()->('/');
        //Esto funciona bien:
        //dd(Auth::user());

        /*try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existUser = User::where('email',$googleUser->email)->first();
            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->password = bcrypt('passwordSinNingunSentido');
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/home');
        }
        catch (Exception $e) {
            return 'error';
        }*/

    }
}
