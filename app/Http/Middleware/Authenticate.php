<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     if (auth()->guard('sanctum')->check() && auth()->guard('sanctum')->user()->isUser()){
          return $next($request);
     }
        return response()->json(['message'=>'Unauthorized access'],403);

    }
}