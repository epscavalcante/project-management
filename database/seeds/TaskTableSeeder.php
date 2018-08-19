<?php

use Illuminate\Database\Seeder;
use App\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'project_id' => '1',
            'user_id' => '1',
            'task_type_id' => '1', #Tipo da tarefa
        	'task_status_id' => '1', #Status dessa tarefa
    		'description' => 'Aqui já começa com a descrição do tarefa a ser feita ou que ja foi feita, enfim é alguma coisa para fazer um pequeno teste.'
        ]);

        Task::create([
            'project_id' => '1',
            'user_id' => '1',
            'task_type_id' => '2', #Funcionalidade
            'task_status_id' => '2', #Status dess tarefa
            'description' => 'Outra outro texto para identificar alguma coisa la na view.'
        ]);

    }   
}
