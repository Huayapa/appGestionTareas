<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function register(Request $request){
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:4',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['auth_provider'] = 'standard';

            $validatedData['api_token'] = Str::random(60);
            $user = User::create($validatedData);

            return apiResponse([
                'status' => 'success',
                'message' => 'Usuario registrado exitosamente.',
                'data' => [
                    'user' => $user,
                    'access_token' => $user->api_token,
                    'token_type' => 'Bearer',
                ],
            ], 201);
        } catch (Exception $e) {
            return apiResponse([
                'status' => 'error',
                'message' => 'Error al registrar el usuario.',
                'data' => null,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            $user = User::where('email', $request->email)->first();
            
            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw new Exception('Credenciales inválidas.');
            }
            $token = Str::random(60);
            $user->update(['api_token' => $token]);

            return apiResponse([
                'status' => 'success',
                'message' => 'Usuario logueado exitosamente.',
                'data' => [
                    'user' => $user,
                    'access_token' => $user->api_token,
                    'token_type' => 'Bearer',
                ],
            ], 200);

        } catch (Exception $e) {
            return apiResponse([
                'status' => 'error',
                'message' => 'Error al iniciar sesión.',
                'data' => null,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request){
        try {
            $user = $request->user();
            if (! $user) {
                throw new Exception('No hay usuario autenticado.');
            }
            $user->update(['api_token' => null]);

            return apiResponse([
                'status' => 'success',
                'message' => 'Usuario deslogueado exitosamente.',
            ], 200);

        } catch (Exception $e) {
            return apiResponse([
                'status' => 'error',
                'message' => 'Error al cerrar sesión.',
                'data' => null,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
