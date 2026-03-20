<?php

namespace App\Http\Middleware;

use Closure;
use App;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $role = User::ADMIN;

        if (auth()->check()) {
            if (auth()->user()->role == $role) {
                return $next($request);
            } else {
                abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect()->route('admin.login');
        }
    }

}
