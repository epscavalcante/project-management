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

    // const CREATED_AT = 'date_insert';
    // const UPDATED_AT = 'date_updated';
    // const DELETED_AT = 'finished_at';



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

    #Retorna todas as tarefas
    public function tasks()
    {
        return $this->hasMany(Task::class)->withTrashed()->orderBy('created_at', 'desc')->orderBy('deleted_at', 'asc');
    }

    #mapeia somente as tarefas excluidas
    public function tasksTrashed()
    {
        return $this->hasMany(Task::class)->onlyTrashed()->orderBy('created_at', 'desc')->orderBy('deleted_at', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | Getters, Mutatores e Accessors
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

    public function progress($completed, $total)
    {
        #Converte um possivel valor decimal para inteiro (arredonda para cima)
        return ceil(($completed / $total) * 100);
    }
}
