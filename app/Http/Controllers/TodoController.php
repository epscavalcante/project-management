<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

use App\Http\Services\TodoService;
use App\Http\Services\TaskService;

class TodoController extends Controller
{
    public function __construct(TodoService $todoService, TaskService $taskService)
    {
        $this->todoService = $todoService;
    	$this->taskService = $taskService;
    }

    public function store(StoreTodoRequest $request, $project, $task)
    {
        $task = $this->taskService->get('slug', $task)['task'];

    	$response = $this->todoService->store($request->all(), $task);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
    }

    public function update(UpdateTodoRequest $request, $project, $task, $todo)
    {
        $response = $this->todoService->update($request->all(), $todo);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
    }

    public function destroy($project, $task, $todo)
    {

    	$response = $this->todoService->destroy($todo);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
    }

    public function mark($project, $task, $todo)
    {
    	$response = $this->todoService->mark($todo);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return back();
    }

}
