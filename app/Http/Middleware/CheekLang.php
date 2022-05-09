<?php

namespace App\Http\Middleware;

use Closure;

class CheekLang
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
        set_Locale('ar');
       $lan= $request->header('lan');
       $request->headers->set('lan', (string) $lan, true);
       
       if($request->hasHeader('lan')){
          $langs=getLanguges();
           foreach($langs as $lang){
               if($request->header('lan')==$lang->abbr){
                 set_Locale($lang->abbr);
                 return $next($request);
               }

           }

       }
       return $next($request);
       
    }
}
