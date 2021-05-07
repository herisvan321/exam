<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
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
        try {
            $user = /*Auth::guard('peserta')->user();*/
            JWTAuth::parseToken()->authenticate();
            // return response()->json(['status' => $user]);
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                $status = false;
                $message = 'token_invalid';
                return response()->json(['status' => $status, 'message' => $message]);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                $status = false;
                $message = 'token_expired';
                return response()->json(['status' => $status, 'message' => $message]);
            }else{
                $status = false;
                $message = 'user_not_found';
                return response()->json(['status' => $status, 'message' => $message]);
            }
        }
        return $next($request);
    }
}
