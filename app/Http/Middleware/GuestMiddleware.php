<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\GuestController;

class GuestMiddleware
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
      if((new GuestController)->getGuest($request)) {
        
        return $next($request);

      } else{

        return (new GuestController)->storeNewGuest();

      }
    }
}
