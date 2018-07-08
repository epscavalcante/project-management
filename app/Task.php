<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'code', 'name', 'finished', 'description', 'start', 'end', 'project_id',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'start', 'end'];

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
