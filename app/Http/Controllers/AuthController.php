<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Hash;
use Auth;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()
{
    //dd(hash::make(123456));
    if (Auth::check()) {
        if(Auth::user()->user_type == 1){
            return redirect('admin/dashboard');
        }else if(Auth::user()->user_type == 2){
            return redirect('teacher/dashboard');
        }else if(Auth::user()->user_type == 3){
            return redirect('student/dashboard');
        }else if(Auth::user()->user_type == 4){
            return redirect('parent/dashboard');
        }
    }

    return view('auth.login');
}

public function authlogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }else if(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }else if(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }else if(Auth::user()->user_type == 4){
                return redirect('parent/dashboard');
            }

        } else {
            return redirect()->back()->with('error', 'Please check Email Or Password');
        }
    }
    public function forgotpassword(){
        return view('auth/forgot');
    }
    public function ForgotPasswordMail(Request $request){
        $user = User::getemailsigle($request->email);
        if(!empty($user))
        {   $user->remember_token =str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->with('success','Please Check Yor Email And Reset Password.');
        }else
        {
            return redirect()->back()->with('error',"Email not found in the System");
        }
        dd($user);
    }
public function logout()
    {

        Auth::logout();
        return redirect()->route('auth/login');

    }
}
