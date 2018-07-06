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

    public function myProjects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getImageAttribute($value)
    {
        return 'images/'.$value;
    }
}
