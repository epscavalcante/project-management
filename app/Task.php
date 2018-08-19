<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'description', 'project_id', 'user_id', 'task_type_id', 'task_status_id',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }

    public function type()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Getters, Mutatores e Accessors
    |--------------------------------------------------------------------------
    |
    | Seção para definir os mutators e accessors do laravel
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
