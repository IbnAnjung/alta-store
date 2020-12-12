<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
      if($request->header('x-admin-token') == env('APP_ADMIN_TOKEN')){
        
        return $next($request);
      
      }else{

        return response()->json([
          'status' => 'error',
          'message' => 'maaf hanya admin yang di berikan izin untuk request ini'
        ], 405);

      }
    }
}
