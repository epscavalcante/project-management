<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Http\Services\ProjectService;
use App\Http\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(ProjectService $projectService, TaskService $taskService)
    {
        $this->projectService = $projectService;
        $this->taskService = $taskService;
    }

    public function show($project, $task)
    {

        $response = $this->taskService->get('slug', $task, ['project.tasks','project.tasksFinished']);

        if($response['status']){

            return view('projects.tasks.show')->with([
                'task' => $response['task']
            ]);

        }

        toast($response['message'], 'error', 'top-right');
        return back();
        
    }

    public function members($project, $task)
    {
        $response = $this->taskService->get('slug', $task);

        if($response['status']){

            return view('projects.tasks.members.index')->with([
                'task' => $response['task']
            ]);

        }

        toast($response['message'], 'error', 'top-right');
        return back();
    }

    public function attach($project, $task, $user)
    {
        $response = $this->taskService->attach($task, $user);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
    }

    public function dettach($project, $task, $user)
    {
        $response = $this->taskService->dettach($task, $user);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
    }

    public function store(StoreTaskRequest $request, $project)
    {
        $project = $this->projectService->get('slug', $project);

        $response = $this->taskService->store($request->all(), $project);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
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

    // public function members(Request $request, $project, $task)
    // {   

    //     try {
            
    //         $task = $this->task->whereCode($task)->firstOrFail();

    //         $task->members()->sync($request->members);

    //         toast('Alterações nos membros realizadas com sucesso', 'success', 'top-right');

    //         return back();


    //     } catch (Exception $e) {
            
    //         toast($e->getMessage(), 'error', 'top-right');

    //         return back();
            
    //     }
    // }
}
