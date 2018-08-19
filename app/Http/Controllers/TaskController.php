<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Task;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index($project)
    {
    }

    public function show($project, Task $task)
    {
        return view('projects.tasks.show', compact('task'));
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            $task = $this->task->create($request->all());
            toast('Tarefa criada com sucesso', 'success', 'top-right');

            return redirect()->route('projects.tasks.show', [$request->project_id, $task->id]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}
