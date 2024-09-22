<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        
        if (! $request->user()->hasRole($role)){

            return response([
                "error" => [
                    "message" => "You're not allowed to access the requested resource !"
                ]
            ], 403);
        }
        
        return $next($request);
    }
}
