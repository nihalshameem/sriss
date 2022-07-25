<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    
    public function SendEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
           $details = [
                    'email' => $request->email,
                    'token' => $user->api_token,
                ];

            \Mail::to($request->email)->send(new \App\Mail\VerificationEmail($details)); 
            return \Redirect::back()->withInput()->withSuccess( 'We have emailed your password reset link!');
        }
        else
        {
            return \Redirect::back()->withInput()->withWarning( 'Email is Not Registered');
        }
        
    }
    
    public function ForgotPassword($email)
    {
        $user = User::where('email',$email)->first();
        if($user)
        {
           return view('auth.passwords.reset');
        }
        else
        {
            return \Redirect::back()->withInput()->withWarning( 'Email is Not Registered');
        }
    }
    
    public function ResetPassword(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            $user = User::find($user->id);
            $user->password = Hash::make($request->password); 
            $user->save();
            return redirect(route('admin.login'));
        }
        else
        {
            return \Redirect::back()->withInput()->withWarning( 'Email is Not Registered');
        } 
    }
}
