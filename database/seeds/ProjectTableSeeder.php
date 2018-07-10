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
        	'slug' => str_slug('App Gestão de projetos'),
        	'name' => 'App Gestão de projetos',
        	'description' => 'Sistema para gestão de projetos, criado para facilitar o compartilhamento de tarefas e acompanhamento do desenvolvmento dos projetos.',
        	'owner_id' => '1',
        	'visibility' => 'public'
        ]);

        $project->members()->attach([2,3]);
    }
}
