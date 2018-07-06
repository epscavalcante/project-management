<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\User;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Project $project)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->project = $project;
    }

    
    public function index()
    {
        $projects = auth()->user()->projects;
        
        return view('home', compact('projects'));
    }

    public function show($code)
    {

    	return view('projects.show')->with([
    		'project' => $this->project->whereCode($code)->firstOrFail()
    	]);
    }

    public function edit($code)
    {
        return view('projects.edit')->with([
            'project' => $this->project->whereCode($code)->with(['members', 'tasks'])->firstOrFail()
        ]);
    }

    public function activities($code)
    {
        return view('projects.tasks')->with([
            'project' => $this->project->whereCode($code)->with(['members'])->firstOrFail()
        ]);
    }

    public function create()
    {
    	return view('projects.create')->with(['users' => $this->user->where('id', '<>', auth()->user()->id)->get()]);
    }

    public function store(StoreProjectRequest $request)
    {
    	try {

    		$project = $this->project->create([
				'owner_id' => auth()->user()->id,
    			'code' => \Carbon\Carbon::now()->timestamp,
				'name' => $request->name,
				'description' => $request->description,
				'start' => $request->start,
				'end' => $request->end,
				#'visibility' => $request->visibility
    		]);

    		#Se houverem membros
    		$project->users()->sync($request->members);

    		return redirect()->route('projects.show', $project->code);


    	} catch (Exception $e) {
    		
    		toast('error', $e->getMessage(), 'top-right');

    	}
    }

    public function update(UpdateProjectRequest $request, $code)
    {   
        try {

            $project = $this->project->whereCode($code)->firstOrFail();

            $project->update($request->all());

            toast('Alteração realizada com sucesso', 'success', 'top-right');

            return redirect()->route('projects.show', $project->code);        


        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();

        }

    }
}
