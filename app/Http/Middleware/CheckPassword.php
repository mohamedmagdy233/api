<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPassword
{

    public function handle(Request $request, Closure $next): Response
    {
       if ( $request->api_password !== env('API_PASSWORD','38PBpdhbEtRhsmN78')){

           return response()->json(['massage' =>'unauthenticated']);

        }
        return $next($request);
    }
}
