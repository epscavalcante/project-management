<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
class TrashController extends Controller
{
    public function __construct(Project $project, Task $task)
    {
    	$this->project = $project;
    	$this->task = $task;
    }

    public function index()
    {
    	#dd($this->project->onlyTrashed()->get());
    	return view('trash.index')->with([
    		'projects' => $this->project->onlyTrashed()->get(),
    		'tasks' => $this->task->with(['project'])->onlyTrashed()->get()
    	]);
    }
}
