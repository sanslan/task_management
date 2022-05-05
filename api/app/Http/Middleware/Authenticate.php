<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{

    public function handle(Request $request,  Closure $next, $guards=Null){

        if(Auth::guard($guards)->guest()){
            return response()->json(
                [
                    'code' => -1,
                    'data' => Null,
                    'validation_errors' => ['Unauthenticated request']
                ]
            );
        }

        return $next($request);

    }
}
