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
            'project' => $this->project->whereCode($code)->with(['members', 'tasks'])->firstOrFail(),
            'users' => $this->user->all(),
        ]);
    }

    public function show($project, $task)
    {
        return view('projects.tasks.show')->with([
            'task' => $this->task->whereCode($task)->with(['members'])->firstOrFail(),
            'project' => $this->project->whereCode($project)->with(['members'])->firstOrFail(),
            'users' => $this->user->all(),
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
        
        try {

            $project = $this->project->whereCode($project)->firstOrFail();

            $task = $this->task->create([
                'code' => \Carbon\Carbon::now()->timestamp,
                'name' => $request->name,
                'description' => $request->description,
                'start' => $request->start,
                'end' => $request->end,
                'project_id' => $project->id
            ]);

            if($request->has('members')){
                
                $task->members()->sync($request->members);
            }

            toast('Gerencia esta nova tarefa', 'info', 'top-right');
            
            return redirect()->route('projects.tasks.show', [$project->code, $task->code]);

        } catch (Exception $e) {
            
        }
    }


    public function destroy($project, $task)
    {
        try {
            
            $this->task->whereCode($task)->firstOrFail()->delete();

            toast('Tarefa excluída com sucesso!', 'success', 'top-right');
            
            return redirect()->route('projects.tasks', $project);

        } catch (Exception $e) {
            
        }
    }
}
