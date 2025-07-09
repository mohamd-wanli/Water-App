<?php

namespace App\Http\Middleware;

use App\Types\DistributerRequest;
use App\Types\UserTypes;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        $user=auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
//        $user->role===UserTypes::DISTRIBUTOR &&
        if(in_array(UserTypes::DISTRIBUTOR,$roles)){
            if(
                !$user->is_banned &&
                $user->distributor->status===DistributerRequest::APPROVED
            ){
                return $next($request);
            }
        }
        if (in_array($user->role, $roles)) {
            return $next($request);
        }
        return response()->json([
            'message' => 'Unauthorized. Required roles: ' . implode(', ', $roles)
        ], 403);
    }
}
