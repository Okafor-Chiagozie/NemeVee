<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
   /**
    * Handle an incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    * @param string $session_name
    * @return \Symfony\Component\HttpFoundation\Response
    */
   public function handle(Request $request, Closure $next, string $session_name): Response
   {
      if(!$request->session()->has($session_name)){
         if(url()->current() == url()->previous())
            return to_route('auth.login');

         return redirect(url()-> previous() ?: route('auth.login')); 
      }

      return $next($request);
   }
}
