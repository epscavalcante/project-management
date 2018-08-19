<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $table = 'task_status';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function tasks()
    {
    	return $this->belongsTo(Task::class);
    }
}
