<?php

namespace App\Http\Services;

use App\Todo;

class TodoService
{
	private $todo;

	function __construct(Todo $todo)
	{
		$this->todo = $todo;
	}

	public function store($data = array(), $task)
	{
		try {

    		$this->todo->create([
    			'author_id' => auth()->user()->id,
    			'task_id' => $task->id,
    			'description' => $data['description'],
    		]);
    		
    		return ['status' => true, 'message' => 'Item criado com sucesso'];

    	} catch (Exception $e) {
    		
    		return ['status' => false, 'message' => $e->getMessage];
    	}
	}

    public function update($data = array(), $todo)
    {
        try {

            $this->todo->find($todo)->update($data);
            
            return ['status' => true, 'message' => 'Item atualizado com sucesso'];

        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage];

        }
    }
    public function destroy($todo)
    {
        try {

            $this->todo->destroy($todo);
            
            return ['status' => true, 'message' => 'Item removido com sucesso'];

        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage];

        }
    }

    public function mark($todo)
    {

        try {

            $todo = $this->todo->find($todo);

            if($todo->finished){

                $todo->finished = 0;

            }else{

                $todo->finished = 1;

            }

            $todo->save();
            
            return ['status' => true, 'message' => 'Item alterado com sucesso'];

        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage];

        }
    }
}