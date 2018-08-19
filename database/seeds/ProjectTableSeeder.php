<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = App\Project::create([
        	'name' => 'App Gestão de projetos',
        	'description' => 'Sistema para gestão de projetos, criado para facilitar o compartilhamento de tarefas e acompanhamento do desenvolvmento dos projetos.',
        	'visibility' => 'public',
            'start' => \Carbon\Carbon::now(),
            'end' => \Carbon\Carbon::now()->addYear(),
        ]);

        $project->members()->attach(1, 
            [
                'role_id' => '1', 
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ] );
    }
}
