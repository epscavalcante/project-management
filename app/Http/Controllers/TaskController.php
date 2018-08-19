<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Task;
use App\TaskType;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index($project)
    {
        return view('tasks.index')->with(['project' => $project]);
    }

    public function show($project, $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function create($project)
    {
        return view('tasks.create')->with(['task_types' => TaskType::all(), 'project' => $project]);
    }

    public function store(StoreTaskRequest $request)
    {

        try {

            $task = $this->task->create($request->all());
            toast('Tarefa criada com sucesso', 'success', 'top-right');

            return redirect()->route('projects.show', $request->project_id);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function edit($project, $task)
    {
        return view('tasks.edit')->with(['task' => $task, 'task_type' => TaskType::all()]);
    }
}
