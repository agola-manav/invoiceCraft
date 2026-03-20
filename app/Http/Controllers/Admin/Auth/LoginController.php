<?php
namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller {


    public function getLoginForm(Request $request)
    {
        return view('admin.auth.login');
    }

    public function postLoginForm(Request $request)
    {
        //check user email
        $user = User::select('name','password','role')
                        ->where('email',$request->get('email'))
                        ->first();

        //if user exists
        if(!empty($user)){
            $credentials = array(
                "email" => $request->get('email'),
                "password" => $request->get('password')
            );

            //check user email and password
            if (Auth::attempt($credentials)){

                //Redirect to Admin Backend
                if($user->isAdmin($user->role)){
                    session()->flash('message','Welcome Back '.$user->name.'.');
                    session()->flash('level','success');
                    return redirect()->route('admin.home');
                }

                //Redirect Back to Login
                session()->flash('message','Invalid credentials!');
                session()->flash('level','error');
                return redirect()->back();
            }else{
                //Redirect Back to Login
                session()->flash('message','Invalid credentials!');
                session()->flash('level','error');
                return redirect()->back();  
            }
        }else{
            //Redirect Back to Login
            session()->flash('message','Invalid credentials!');
            session()->flash('level','error');
            return redirect()->back();
        }
    }

    public function postLogoutForm(Request $request)
    {
        Auth::logout();
        session()->flash('message','Logged out Successfully.');
        session()->flash('level','success');
        return redirect()->route('admin.login');
    }
}