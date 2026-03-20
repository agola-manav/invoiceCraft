<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function getForgotPassword(Request $request){
        return view('front.auth.forgot-password');
    }

    public function postForgotPassword(Request $request){

        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('message','Successfully sent password reset link.');
            session()->flash('level','success');

             return back()->with(['status' => __($status)]);
        } else{
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function getResetPassword($token, Request $request){

        return view('front.auth.reset-password', ['token' => $token]);
    }

    public function postResetPassword(Request $request){

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ]
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('message','Successfully reset your password.');
            session()->flash('level','success');

            return redirect()->route('user.login')->with('status', __($status));
        }else{
            return back()->withErrors(['email' => [__($status)]]);
        }
    }

}