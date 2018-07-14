<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Services\TaskService;

class CheckUserAccessForTask
{

    function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $task = $this->taskService->get('slug', $request->task, ['members'])['task'];

        #libera o acesso somente se for o dono do projeto ou se for membro
        if(auth()->user()->id == $task->user_id || $task->members->contains(auth()->user()->id)){

            return $next($request);

        }

        #curioso é bloqueado
        return abort(403);

    }
}
