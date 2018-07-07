<?php

namespace App\Http\Middleware;

use Closure;
use App\Project;

class CheckAccessUserForProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #dd($request->project);

        $project = Project::whereCode($request->project)->with('members')->firstOrFail();

        #libera o acesso somente se for o dono do projeto ou se for membro
        if($project->owner_id == auth()->user()->id || $project->members->contains(auth()->user()->id)){

            return $next($request);

        }

        #curioso é bloqueado
        return abort(403);
        
    }
}
