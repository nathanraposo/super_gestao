<?php

namespace App\Http\Middleware;

use App\LogAcesso;
use Closure;
use http\Env\Response;
use Illuminate\Http\Request;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log' => "IP $ip requisitou a rota $rota"]);

        //return Response('Chegamos no middleware e finalizamos no proprio middlware');
        return $next($request);
    }
}
