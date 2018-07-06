<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'code', 'name', 'description', 'start', 'project_id',
    ];

    public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}
