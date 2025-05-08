<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles = ''): Response
    {
        // Split the roles string into an array
        $allowedRoles = explode('|', $roles);
        
        $userRole = $request->user()->getRole();
        
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }
        
        abort(403, 'Forbidden. Kamu tidak mempunyai akses ke halaman ini');
    }
}