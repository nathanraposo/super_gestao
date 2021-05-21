<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session_start();

        if(isset($_SESSION['email']) && $_SESSION['email'] != ''){
            return $next($request);
        }else{
            return redirect()->route('site.login',['erro' => 2]);
        }
    }
}
