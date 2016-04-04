<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                $message = 'There was a 401 error';
                return response('Unauthorized.', 401)->with(['message' => $message]);
            } else {
                // return redirect()->guest('login');
                $message = 'guest login';
                return redirect()->route('home')->with(['message' => $message]);

            }
        }

        return $next($request);
    }
}
