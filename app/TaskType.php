<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    protected $table = 'task_type';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }
}
