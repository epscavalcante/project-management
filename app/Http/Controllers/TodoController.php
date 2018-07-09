<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Todo;
use App\Task;
use App\Project;

class TodoController extends Controller
{
    public function __construct(Todo $todo, Task $task, Project $project)
    {
    	$this->todo = $todo;
    	$this->task = $task;
    	$this->project = $project;
    }

    public function store(StoreTodoRequest $request, $project, $task)
    {
    	try {

    		$this->todo->create([
    			'author_id' => auth()->user()->id,
    			'task_id' => $this->task->whereCode($task)->first()->id,
    			'description' => $request->description,
    		]);
    		
			toast('Item criado com sucesso', 'success', 'top-right');

    		return back();

    	} catch (Exception $e) {
    		
    	}
    }

    public function update(UpdateTodoRequest $request, $project, $task, $todo)
    {
    	try {
			
			$this->todo->find($todo)->update($request->all());
			toast('Item atualizado com sucesso', 'success', 'top-right');
			return back();

    	} catch (Exception $e) {
    		toast($e->getMessage(), 'error', 'top-right');
			return back();
    	}
    }
}
