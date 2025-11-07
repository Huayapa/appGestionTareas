<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
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

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario registrado exitosamente.',
                'data' => [
                    'user' => $user,
                    'access_token' => $user->api_token,
                    'token_type' => 'Bearer',
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al registrar el usuario.',
                'data' => null,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
