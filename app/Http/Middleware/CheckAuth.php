<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = new User();
        $token = $request->cookie('sessionToken');
        $user_id = $user->getLoginUserId($token);
        if (!$user_id) {
            return redirect('/report_owner/login')->withoutCookie('sessionToken');
        }

        return $next($request);
    }
}
