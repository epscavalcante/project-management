<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Http\Services\ProjectService;

use App\Project;
use App\Task;
use App\User;

class TaskController extends Controller
{
    public function __construct(Project $project, Task $task, User $user, ProjectService $projectService)
    {
    	$this->project = $project;
        $this->task = $task;
    	$this->user = $user;

        $this->projectService = $projectService;
    }

    public function index($project)
    {
        
        $response = $this->projectService->getWithAndWithCount('slug', $project, ['owner', 'members', 'tasks'], ['tasks','tasksFinished']);

        return view('projects.tasks.index')->with([
            'project' => $response['project']
        ]);
    }

    public function show($project, $task)
    {
        // dd($this->task->whereCode($task)
        //                 ->with(['members','todos', 'todos.author', 'project','project.members'])
        //                 ->withCount(['todos'])
        //                 ->firstOrFail());

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
