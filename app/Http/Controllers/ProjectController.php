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
    		'project' => $this->project->whereCode($code)
                                ->with(['owner', 'members',])
                                ->withCount(['tasks','tasksFinished'])
                                ->firstOrFail(),
    	]);
    }

    public function edit($code)
    {
        return view('projects.edit')->with([
            'project' => $this->project->whereCode($code)->firstOrFail()
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
				'start' => $request->start ?? \Carbon\Carbon::now(),
				'end' => $request->end,
				#'visibility' => $request->visibility
    		]);

    		#Se houverem membros
    		$project->members()->sync($request->members);

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

    public function destroy($project)
    {

        try {
            
            $this->project->whereCode($project)->firstOrFail()->delete();

            toast('Projeto excluído', 'success', 'top-right');

            return redirect()->route('projects');


        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();
        }

    }

    public function forceDestroy($project)
    {

        try {
            
            $this->project->whereCode($task)->withTrashed()->firstOrFail()->forceDelete();

            toast('Projeto excluído com sucesso!', 'success', 'top-right');
            
            return redirect()->route('home');

        } catch (Exception $e) {

            toast($e->getMessage(), 'error', 'top-right');

            return back();
        }
    }

    public function restore($project, $task)
    {

        try {
            
            $this->project->whereCode($task)->onlyTrashed()->firstOrFail()->restore();

            toast('Projeto restaurado com sucesso!', 'success', 'top-right');
            
            return redirect()->route('home');

        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();
        }
    }

}
