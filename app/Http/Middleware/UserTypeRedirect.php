<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypeRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Retrieve user type from the authenticated user
            $usertype = $user->usertype;

            if ($usertype == '1') {
                // Admin user, redirect to admin home
                return redirect()->route('admin.home');
            } else {
                // Regular user, redirect to dashboard
                return redirect()->route('user.home');
                
            }
        }

        // If no authenticated user, proceed with the request
        return $next($request);
    }
}