<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {


        // Check if user has one of the roles
        if (!$request->user()->role && $request->user()->role == $role) {
            abort(403, 'YOU ARE NOT AUTHORIZED.');}
         // Split roles by comma if multiple roles are passed
        return $next($request);
    }
}
