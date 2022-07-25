<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTAuth;
use Session;
use App\Models\User;
use App\Models\UserRoles;

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
    protected $redirectTo = RouteServiceProvider::HOME;
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function AdminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:5'
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return \Redirect::back()->withInput()->withWarning( 'User credentials are incorrect');
        }
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $token = JWTAuth::attempt($credentials);
        $user = User::where('email',$request->email)->first();
        $role = UserRoles::where('user_id',$user->id)->first();
        Session::put('name',$user->name);
        
            if($role->role_id=='9')
            {
                return redirect()->intended('/Volunteer');
            }
            else
            {
                return redirect()->intended('/home');
            }
        
        
    }
}
