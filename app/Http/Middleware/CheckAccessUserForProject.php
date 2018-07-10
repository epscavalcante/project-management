<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Services\ProjectService;

class CheckAccessUserForProject
{

    function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
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

        $project = $this->projectService->get('slug', $request->project);

        #libera o acesso somente se for o dono do projeto ou se for membro
        if(auth()->user()->id == $project->owner_id || auth()->user()->projects->contains($project->id)){

            return $next($request);

        }

        #curioso é bloqueado
        return abort(403);
        
    }
}
