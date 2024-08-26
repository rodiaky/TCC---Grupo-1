<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\LogAcessoMiddleware;

class AdministradorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        session_start();
        if (isset($_SESSION['eh_admin'])) {
            if($_SESSION['eh_admin'] == 'Administrador') {
                return $next($request);
            } else {
                return redirect()->route('login', ['erro' => 4]);
            } 
        } else {
            return redirect()->route('login', ['erro' => 5]);
        }

    }
}
