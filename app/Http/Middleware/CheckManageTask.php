<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Services\TaskService;

class CheckManageTask
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

        $task = $this->taskService->get('slug', $request->task);

        #libera o acesso somente se for o dono do projeto ou se for membro
        if(auth()->user()->id == $task['task']->user_id){

            return $next($request);

        }

        return abort(403);
    }
}
