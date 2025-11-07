<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->header('Authorization');
            if (!$token) {
                throw new \Exception('Token no proporcionado');
            }

            $user = User::where('api_token', str_replace('Bearer ', '', $token))->first();
            if (!$user) {
                throw new \Exception('Token inválido');
            }

             Auth::setUser($user);
            return $next($request);
        } catch (\Exception $e) {
            return apiResponse([
                'status' => 'error',
                'message' => 'Ocurrió un error al procesar la solicitud',
                'data' => [],
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }
}
