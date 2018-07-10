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
        $task = Task::create([
        	'slug' => str_slug('Tarefa numer One'),
        	'project_id' => '1',
    		'name' => 'Tarefa numer One',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $task->members()->attach(['2', '3']);
    }   
}
