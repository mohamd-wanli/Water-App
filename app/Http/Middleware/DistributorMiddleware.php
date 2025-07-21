<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistributorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user=auth()->user();
       if ($user &&$user->getTable() === 'distributors' &&
           $user->status === \App\Types\DistributerRequest::APPROVED){
           return $next($request);
       }

        return response()->json([
            'message' => 'Unauthorized. Approved distributor access required.'
        ], 403);
    }

}
