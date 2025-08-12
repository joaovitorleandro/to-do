<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return $this->responseSuccess($tasks, 'Lista de tarefas recuperada com sucesso.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'boolean'
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'completed' => $validated['completed'] ?? false,
        ]);

        return $this->responseSuccess($task, 'Tarefa criada com sucesso.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->responseFail('Tarefa não encontrada.', 404, 404);
        }
        return $this->responseSuccess($task, 'Tarefa encontrada.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->responseFail('Tarefa não encontrada.', 404, 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'completed' => 'sometimes|boolean'
        ]);

        $task->update($validated);

        return $this->responseSuccess($task, 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->responseFail('Tarefa não encontrada.', 404, 404);
        }

        $task->delete();

        return $this->responseSuccess(null, 'Tarefa excluída com sucesso.');
    }
}
