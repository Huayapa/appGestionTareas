<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('due_date')->get()->groupBy('status');
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $userId = Auth::id();
        $validatedData['user_assigned'] = $userId;
        $validatedData['status'] = 'pendiente';

        $task = Task::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'id' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pendiente,en progreso,completada'
        ]);

        $task = Task::find($validatedData['id']);
        $task->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'id' => 'required|string',
        ]);

        $task = Task::find($validatedData['id']);
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tarea eliminada exitosamente.');
    }
}
