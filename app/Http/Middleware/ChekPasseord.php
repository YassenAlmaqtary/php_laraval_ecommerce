<?php

namespace App\Http\Middleware;

use Closure;

class ChekPasseord
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
     if($request->api_password != env("API_PASSWORD","Z5MZawGyKOaTAHxeN0v")){
     
        return response()->json(['message'=>'Unauthenticated.']);

     }


        return $next($request);
    }
}
