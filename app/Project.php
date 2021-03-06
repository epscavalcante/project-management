<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Carbon\Carbon;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'start', 'end', 'visivility',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'start', 'end'
    ];

    public $timestamp = true;

    // public function getRouteKey() {
       
    //    return $this->slug;
    
    // }

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
    public function members()
    {
    	return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    #Retorna todas as tarefas
    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('created_at', 'desc');
    }

    #mapeia somente as tarefas arquivadas
    public function tasksTrashed()
    {
        return $this->hasMany(Task::class)->onlyTrashed()->orderBy('created_at', 'desc')->orderBy('deleted_at', 'asc');
    }

    #mapeia somente as tarefas finalizadas
    public function tasksFinished()
    {
        return $this->hasMany(Task::class)->whereFinished(1)->orderBy('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    | Getters, Mutatores e Accessors
    |--------------------------------------------------------------------------
    |
    | Seção para definir os mutators e accessors do laral
    |
    */

    public function progress($completed, $total)
    {

        if($total == 0)
        {
            return 0;
        }

        #Converte um possivel valor decimal para inteiro (arredonda para cima)
        return ceil(($completed / $total) * 100);
    }
}
