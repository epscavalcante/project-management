<?php

use Illuminate\Database\Seeder;
use App\TaskStatus;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::create(['name' => 'Em aberto']);
        TaskStatus::create(['name' => 'Em andamento']);
        TaskStatus::create(['name' => 'Finalizada']);
    }
}
