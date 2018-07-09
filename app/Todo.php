<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
   	protected $table = 'todos';
   	
   	protected $fillable = [
    	'description', 'author_id', 'task_id',
   	];

   	protected $dates = ['created_at', 'updated_at'];

   	public function author()
   	{
   		return $this->belongsTo(User::class, 'author_id');
   	}
}
