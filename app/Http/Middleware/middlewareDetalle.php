<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Caso;

use Closure;

class middlewareDetalle
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

 if (auth()->user()->hasRole('admin')) { 

return $next($request);}

    elseif (auth()->user()->hasRole('profesional')) {






       // if(auth()->user()->getSede()=="LA PLATA"){
            return $next($request);
        }else{abort(403, "No tienes autorización para ingresar.");}

       

    } 

     elseif (auth()->user()->hasRole('user')) {

//if(auth()->user()->getId()=="2"){
            return $next($request);      }

    }else{abort(403, "No tienes autorización para ingresar.");} 
          
     
       
    }
}

