<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'start', 'end', 'owner_id', 'visivility',
    ];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
    	return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
