<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    use GeneralTrait;

    public function handle(Request $request, Closure $next): Response
    {

            try {

                    $user = JWTAuth::parseToken() -> authenticate() ;
                }

            catch(\Exception $error) {
                if ($error instanceof TokenExpiredException) {
                    return $this->returnError('401', 'The token has been expired !');
                } elseif ($error instanceof TokenInvalidException) {
                    return $this->returnError('498', 'The token is invalid !');
                } else {
                    return $this->returnError('404', 'The token does not exists');
                }

            }


            return $next($request);

}       }
