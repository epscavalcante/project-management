<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $fillable = ['project_id', 'task_id', 'user_id', 'title', 'description'];
    public $timestamps = true;
}
