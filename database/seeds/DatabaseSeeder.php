<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(TaskTypeTableSeeder::class);
        $this->call(TaskStatusTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(TaskTableSeeder::class);
        
    }
}
