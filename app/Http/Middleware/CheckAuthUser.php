<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->route()->parameter('userType');
        $user_list = array("admin","report_owner","report_viewer");

        if(in_array($user,$user_list)) {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
