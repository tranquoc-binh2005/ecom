<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        if($user){
            $userRoles = $user->roles->pluck('slug')->toArray();
            foreach ($roles as $role) {
                if (in_array($role, $userRoles)) {
                    return $next($request);
                }
            }
        }
        return redirect()->route('admin.auth')->with('error', 'Not authorized');
    }
}
