<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class TaskController extends Controller
{
    public function __construct(Project $project, Task $task)
    {
    	$this->project = $project;
    	$this->task = $task;
    }

    public function index($code)
    {
        return view('projects.tasks.index')->with([
            'project' => $this->project->whereCode($code)->with(['members', 'tasks'])->firstOrFail()
        ]);
    }

    public function create()
    {
    	return view('projects.tasks.create');
    }
}
