<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user_group = Auth::user()->user_group_id;
        if ($user_group == 1 OR $user_group == 2 OR $user_group == 3 ) {
             return $next($request);
        }else{
           return redirect()->back(); 
        }
    }
}
