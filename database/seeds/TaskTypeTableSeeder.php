<?php

use Illuminate\Database\Seeder;
use App\TaskType;

class TaskTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskType::create(['name' => 'Tarefa']);
        TaskType::create(['name' => 'Funcionalidade']);
        TaskType::create(['name' => 'Defeito']);
    }
}
