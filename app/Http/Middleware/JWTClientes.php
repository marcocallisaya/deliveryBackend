<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth as TymonJWTAuth;
use Closure;

class JWTClientes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        TymonJWTAuth::parseToken()->authenticate();
        return $next($request);
    }
}
