<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;

class MemberController extends Controller
{
    public function __construct(Project $project, User $user)
    {
    	$this->project = $project;
    	$this->user = $user;
    }

    public function index($project)
    {
    	return view('projects.members.index')->with([
			'project' => $this->project->whereCode($project)
                                ->with(['owner', 'members',])
                                ->withCount(['tasks','tasksFinished'])
                                ->firstOrFail(),
            'users' => $this->user->all()
         ]);
    }

    public function sync(Request $request, $project)
    {
        try {
            
            $project = $this->project->whereCode($project)->firstOrFail();

            $project->members()->sync($request->members);

            toast('Alterações feitas', 'success', 'top-right');

            return back();


        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();
            
        }
    }
}
