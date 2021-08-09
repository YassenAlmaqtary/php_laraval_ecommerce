<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
       
        if (!$request->expectsJson()) {

            if ($request->is('Admins') || $request->is('Admins/*'))

               return route('get.admin.login');
            else if ($request->is('Vendors') || $request->is('Vendors/*'))
                  
                return route('get.vendor.login');
            else
                return route('login');
        }
    }
}
