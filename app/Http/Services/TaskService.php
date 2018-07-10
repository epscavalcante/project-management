<?php

namespace App\Http\Services;

use App\Task;
use App\Project;

class TaskService
{
	private $project;

	function __construct(Task $task, Project $project)
	{
		$this->task = $task;
		$this->project = $project;
	}

    public function get($columnTask, $task, $with = array())
    {
        $with = array_flatten(['members','todos', 'todos.author', 'project','project.members', $with]);
        
        try {
            
            $task = $this->task->where($columnTask, $task)
                                ->with($with)
                                ->withCount(['todos', 'todosFinished'])
                                ->firstOrFail();

            return ['status' => true, 'message' => 'Tarefa encontrada', 'task' => $task];


        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage()];

        }
    }

	public function store($data = array(), $project)
	{
		try {

            $task = $this->task->create([
                'slug' => str_slug($data['name']),
                'name' => $data['name'],
                'description' => $data['description'],
                'start' => $data['start'],
                'end' => $data['end'],
                'project_id' => $project->id
            ]);

            if(array_has($data, 'members')){
                
                $task->members()->attach($data['members']);
                
            }

            return ['status' => true, 'message' => 'Tarefa criada com sucesso'];

        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage()];

        }
	}

    public function update($data = array(), $task)
    {
        try {
            
            $task = $this->get('slug', $task)['task'];

            $task->update($data);

            return ['status' => true, 'message' => 'Tarefa encontrada'];

        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage()];
            
        }
    }

    public function attach($task, $user)
    {
        try {
            
            $task = $this->get('slug', $task)['task'];

            $task->members()->attach($user);

            return ['status' => true, 'message' => 'Membro adicionado com sucesso'];

        } catch (Exception $e) {
            
            return ['status' => true, 'message' => $e->getMessage()];
        }
    }

    public function dettach($task, $user)
    {
        try {
            
            $task = $this->get('slug', $task)['task'];

            $task->members()->detach($user);

            return ['status' => true, 'message' => 'Membro removido com sucesso'];

        } catch (Exception $e) {
            
            return ['status' => true, 'message' => $e->getMessage()];
        }
    }

    public function destroy($task)
    {
        try {
            
            $task = $this->get('slug', $task)['task'];

            $task->delete();

            return ['status' => true, 'message' => 'Tarefa movida para a lixeira'];

        } catch (Exception $e) {
            
        }
    }
}