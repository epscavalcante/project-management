<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'code', 'name', 'description', 'start', 'end', 'project_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    |
    | Aqui está mapeado os relacionamentos com outros models
    |
    */
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function members()
    {
    	return $this->belongsToMany(User::class);
    }
}
