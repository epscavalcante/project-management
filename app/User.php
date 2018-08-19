<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'image', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'project_user');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function getImageAttribute($value)
    {
        return 'images/'.$value;
    }
}
