<?php

namespace App\Http\Services;

use App\Project;

/**
 * 
 */
class ProjectService
{
	private $project;

	function __construct(Project $project)
	{
		$this->project = $project;
	}

	#Retorna um objeto do model Project
	public function get($colum, $value)
	{
		return $this->project->where($colum, $value)->firstOrFail();
	}

	#retorna um objeto do model Project com os relationamentos passados no controller
	public function getWith($colum, $value, $with = array())
	{	
		#Array flaten coloca todos os argumentos em um mesmo nivel
		$with = array_flatten(['owner','members', $with]);

		try {
			
			$project = $this->project->where($colum, $value)
										->with($with)
										->withCount(['tasks','tasksFinished'])
										->firstOrFail();

			return ['status' => true, 'message' => 'Projeto encontrado', 'project' => $project];


		} catch (Exception $e) {
			
			return ['status' => false, 'message' => $e->getMessage()];

		}
	}

	public function store($data = array())
	{

		try {

            $project = $this->project->create([
				'owner_id' => auth()->user()->id,
    			'slug' => str_slug($data['name']),
				'name' => $data['name'],
				'description' => $data['description'],
				'start' => $data['start'],
				'end' => $data['end'],
    		]);

            return ['status' => true, 'message' => 'Projeto criado com sucesso', 'project' => $project->slug];        


        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage(), 'project' => $project->slug];

        }

	}

	public function update($data = array(), $project)
	{
		try {

            $project = $this->get('slug', $project);

            $project->update($data);

            return ['status' => true, 'message' => 'Projeto atualizado com sucesso', 'project' => $project->slug];        


        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage(), 'project' => $project->slug];

        }
	}

	public function delete($project)
	{

		try {

            $project = $this->get('slug', $project);

            $project->delete();

            return ['status' => true, 'message' => 'Projeto movido para a lixeira'];        

        } catch (Exception $e) {
            
            return ['status' => false, 'message' => $e->getMessage()];

        }
	}
}