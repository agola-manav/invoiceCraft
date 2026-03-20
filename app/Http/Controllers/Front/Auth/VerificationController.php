<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\User;
use Hash;

class VerificationController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // Apply 'user' middleware to all methods except 'verify'
            //new Middleware('user', except: ['verify']),

            // Apply 'signed' middleware only to 'verify' method
            new Middleware('signed', only: ['verify']),

            // Apply 'throttle' middleware to all methods except 'verify' and 'resend'
            new Middleware('throttle:6,1', except: ['verify', 'resend']),
        ];
    }

    /**
     * Display an email verification notice.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice(Request $request){
        return $request->user()->hasVerifiedEmail() 
            ? redirect()->route('user.dashboard') : view('front.auth.verify-email');
    }

    /**
     * User's email verificaiton.
     *
     * @param  \Illuminate\Http\EmailVerificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $id, $hash){

        $user = User::findOrFail($id);

        // Check if the hash from the URL matches the hash of the user's email
        $expectedHash = sha1($user->getEmailForVerification());
        
        if (!hash_equals($expectedHash, $hash)) {
            return redirect()->route('user.login')->withSuccess('Invalid verification link.');
        }

        // Check if the email is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.login')->withSuccess('Email is already verified.');
        }

        // Mark the email as verified
        $user->markEmailAsVerified();

        return redirect()->route('user.login')->withSuccess('Email verified successfully!');
    }

    /**
     * Resent verificaiton email to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()
        ->withSuccess('A fresh verification link has been sent to your email address.');
    }

}