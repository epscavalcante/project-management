<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

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
        
        return view('projects.show')->with([
            'project' => $this->project->whereCode($code)
                                ->with(['owner', 'members','tasks',])
                                ->withCount(['tasks','tasksFinished'])
                                ->firstOrFail(),
            'users' => $this->user->all()
        ]);
    }

    public function show($project, $task)
    {
        // dd($this->task->whereCode($task)->with(['members','todos', 'todos.author', 'project','project.members'])->firstOrFail());

        return view('projects.task')->with([
            'task' => $this->task->whereCode($task)
                        ->with(['members','todos', 'todos.author', 'project','project.members'])
                        // ->orderBy('todos', 'desc')
                        ->firstOrFail(),
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

    public function update(UpdateTaskRequest $request, $project, $task)
    {
        try {

            $this->task->whereCode($task)->firstOrFail()->update($request->all());

            toast('Alteração realizada com sucesso', 'success', 'top-right');

            return back();       

        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();

        }
    }
    
    public function delete($project, $task)
    {
        try {
            
            $this->task->whereCode($task)->firstOrFail()->delete();

            toast('Tarefa arquivada com sucesso!', 'success', 'top-right');
            
            return redirect()->route('projects.tasks', $project);

        } catch (Exception $e) {
            
        }
    }

    public function destroy($project, $task)
    {

        try {
            
            $this->task->whereCode($task)->withTrashed()->firstOrFail()->forceDelete();

            toast('Tarefa excluída com sucesso!', 'success', 'top-right');
            
            return back();

        } catch (Exception $e) {
            
        }
    }

    public function restore($project, $task)
    {

        try {
            
            $this->task->whereCode($task)->onlyTrashed()->firstOrFail()->restore();

            toast('Tarefa restaurada com sucesso!', 'success', 'top-right');
            
            return redirect()->route('projects.show', $project);

        } catch (Exception $e) {
            
        }
    }

    public function members(Request $request, $project, $task)
    {   

        try {
            
            $task = $this->task->whereCode($task)->firstOrFail();

            $task->members()->sync($request->members);

            toast('Alterações nos membros realizadas com sucesso', 'success', 'top-right');

            return back();


        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();
            
        }
    }
}
