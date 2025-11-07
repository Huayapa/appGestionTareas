<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers(Request $request) {
        $users = User::all();
        return apiResponse([
            'status' => 'success',
            'message' => 'Lista de usuarios obtenida exitosamente.',
            'data' => $users,
        ], 200);
    }

    public function getUser(Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            throw new Exception('Usuario no encontrado.');
        }

        return apiResponse([
            'status' => 'success',
            'message' => 'Usuario obtenido exitosamente.',
            'data' => $user,
        ], 200);
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['auth_provider'] = 'standard';

        $user = User::create($validatedData);

        return apiResponse([
            'status' => 'success',
            'message' => 'Usuario creado exitosamente.',
            'data' => $user,
        ], 201);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            throw new Exception('Usuario no encontrado.');
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:4',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return apiResponse([
            'status' => 'success',
            'message' => 'Usuario actualizado exitosamente.',
            'data' => $user,
        ], 200);
    }

    public function destroy(Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            throw new Exception('Usuario no encontrado.');
        }

        $user->delete();

        return apiResponse([
            'status' => 'success',
            'message' => 'Usuario eliminado exitosamente.',
            'data' => null,
        ], 200);
    }
}
