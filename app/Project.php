<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Project extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'start', 'end', 'owner_id', 'visivility',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start', 'end'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    |
    | Aqui está mapeado os relacionamentos com outros models
    |
    */
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

    /*
    |--------------------------------------------------------------------------
    | Getters e Setters
    |--------------------------------------------------------------------------
    |
    | Seção para definir os mutators e accessors do laral
    |
    */

    // public function getCreatedatAttribute($value)
    // {
    //     return date('d/m/Y H:i', strtotime($value));
    // }

    // public function getUpdatedatAttribute($value)
    // {
    //     return date('d/m/Y H:i', strtotime($value));
    // }

    public function getStartAttribute($value)
    {
        if(empty($value)){
            return "não definido";
        }

        return date('d/m/Y', strtotime($value));
    }

    public function getEndAttribute($value)
    {
        if(empty($value)){
            return "não definido";
        }

        return date('d/m/Y', strtotime($value));
    }
}
