<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTasks(Request $request) {
        $tasks = Task::all();
        return apiResponse([
            'status' => 'success',
            'message' => 'Lista de tareas obtenida exitosamente.',
            'data' => $tasks,
        ], 200);
    }

    public function getTask(Request $request, $id) {
        $task = Task::find($id);
        if (!$task) {
            throw new Exception('Tarea no encontrada.');
        }

        return apiResponse([
            'status' => 'success',
            'message' => 'Tarea obtenida exitosamente.',
            'data' => $task,
        ], 200);
    }

    public function getTasksUser(Request $request, $userId) {
        $tasks = Task::where('user_assigned', $userId)->get();
        return apiResponse([
            'status' => 'success',
            'message' => 'Lista de tareas del usuario obtenida exitosamente.',
            'data' => $tasks,
        ], 200);
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $user = $request->user();
        if (!$user) {
            throw new Exception('No hay usuario autenticado.');
        }
        $validatedData['user_assigned'] = $user->id;
        $validatedData['status'] = 'pendiente';

        $task = Task::create($validatedData);

        return apiResponse([
            'status' => 'success',
            'message' => 'Tarea creada exitosamente.',
            'data' => $task,
        ], 201);
    }

    public function update(Request $request, $id) {
        $task = Task::find($id);
        if (!$task) {
            throw new Exception('Tarea no encontrada.');
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|in:"pendiente","en progreso","completada"',
            'due_date' => 'sometimes|nullable|date',
        ]);

        $task->update($validatedData);

        return apiResponse([
            'status' => 'success',
            'message' => 'Tarea actualizada exitosamente.',
            'data' => $task,
        ], 200);
    }

    public function destroy(Request $request, $id) {
        $task = Task::find($id);
        if (!$task) {
            throw new Exception('Tarea no encontrada.');
        }

        $task->delete();

        return apiResponse([
            'status' => 'success',
            'message' => 'Tarea eliminada exitosamente.',
        ], 200);
    }
}
