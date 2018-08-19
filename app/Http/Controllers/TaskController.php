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

    //     $response = $this->taskService->get('slug', $task, ['project.tasks','project.tasksFinished']);

    //     if($response['status']){

    //         return view('projects.tasks.show')->with([
    //             'task' => $response['task']
    //         ]);

    //     }

    //     toast($response['message'], 'error', 'top-right');
    //     return back();
        
    // }

    // public function members($project, $task)
    // {
    //     $response = $this->taskService->get('slug', $task);

    //     if($response['status']){

    //         return view('projects.tasks.members.index')->with([
    //             'task' => $response['task']
    //         ]);

    //     }

    //     toast($response['message'], 'error', 'top-right');
    //     return back();
    // }

    // public function attach($project, $task, $user)
    // {
        
    //     $response = $this->taskService->attach($task, $user);

    //     if($response['status']){
    //         toast($response['message'], 'success', 'top-right');
    //     }else{
    //         toast($response['message'], 'error', 'top-right');
    //     }

    //     return back();
    // }

    // public function dettach($project, $task, $user)
    // {
    //     $response = $this->taskService->dettach($task, $user);

    //     if($response['status']){
    //         toast($response['message'], 'success', 'top-right');
    //     }else{
    //         toast($response['message'], 'error', 'top-right');
    //     }

    //     return back();
    // }

    // public function store(StoreTaskRequest $request, $project)
    // {
    //     $project = $this->projectService->get('slug', $project);

    //     $response = $this->taskService->store($request->all(), $project);

    //     if($response['status']){
    //         toast($response['message'], 'success', 'top-right');
    //     }else{
    //         toast($response['message'], 'error', 'top-right');
    //     }

    //     return back();
    // }

    // public function update(UpdateTaskRequest $request, $project, $task)
    // {

    //     $response = $this->taskService->update($request->all(), $task);

    //     if($response['status']){
    //         toast($response['message'], 'success', 'top-right');
    //     }else{
    //         toast($response['message'], 'error', 'top-right');
    //     }

    //     return back();
    // }
    
    // public function destroy($project, $task)
    // {

    //     $response = $this->taskService->destroy($task);

    //     if($response['status']){
    //         toast($response['message'], 'success', 'top-right');
    //     }else{
    //         toast($response['message'], 'error', 'top-right');
    //     }

    //     return redirect()->route('projects.tasks', $project);
    // }
}
