<?php

namespace App\Http\Middleware;

use Closure;
use App;
use App\Models\User;
use App\Helpers\Helper;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        $role = auth()->user()->role ?? null; 

        if (auth()->check()) {
            if ($role == User::USER) {
                return $next($request);
            } else {
                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('user.login');
        }
    }
}
