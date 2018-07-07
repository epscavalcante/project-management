<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Project;
use App\Task;
use App\User;

class TaskController extends Controller
{
    public function __construct(Project $project, Task $task, User $user)
    {
    	$this->project = $project;
        $this->task = $task;
    	$this->user = $user;
    }

    public function index($code)
    {
        return view('projects.tasks.index')->with([
            'project' => $this->project->whereCode($code)->with(['members', 'tasks'])->firstOrFail()
        ]);
    }

    public function create($code)
    {
    	return view('projects.tasks.create')->with([
            'project' => $this->project->whereCode($code)->with(['members', 'tasks'])->firstOrFail(),
            'users' => $this->user->all()
        ]);
    }

    public function store(StoreTaskRequest $request, $project)
    {
        dd($request->all());
    }
}
