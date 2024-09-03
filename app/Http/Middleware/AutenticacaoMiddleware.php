<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifique o status da sessão
        if (session_status() === PHP_SESSION_NONE) {
        // Inicie a sessão apenas se ela ainda não estiver iniciada
        session_start();
        }

        if (isset($_SESSION['eh_admin'])) {
            return $next($request);
        } else {
            return redirect()->route('login', ['erro' => 5]);
        }
    }
}
