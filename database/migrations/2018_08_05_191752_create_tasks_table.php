<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('task_type_id');
            $table->unsignedInteger('task_status_id');

            $table->longText('description');
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id')->on('projects')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('task_type_id')->on('task_type')->references('id');
            $table->foreign('task_status_id')->on('task_status')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
