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
       if(isset($request->lange)){
           $langs=getLanguges();
           foreach($langs as $lang){
                 
               if($request->lange==$lang->abbr){
                 set_Locale($lang->abbr);
                 return $next($request);
               }

           }

       }
       return $next($request);
       
    }
}
