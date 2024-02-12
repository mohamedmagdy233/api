<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeLangauage
{

    public function handle(Request $request, Closure $next): Response
    {
        app()->setLocale('ar');

        if ($request->lang=='en'){


            app()->setLocale('en');


        }

        return $next($request);
    }
}
