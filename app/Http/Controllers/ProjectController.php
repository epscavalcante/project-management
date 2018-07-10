<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\User;
use App\Http\Services\ProjectService;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, ProjectService $projectService)
    {
        $this->user = $user;
        $this->projectService = $projectService;
    }

    
    public function index()
    {
        return view('home');
    }

    public function show($project)
    {
        $response = $this->projectService->getWith('slug', $project);

        if($response['status']){
            
            return view('projects.show')->with([
                'project' => $response['project']
            ]);

        }else{

            toast($response['message'], 'error', 'top-right');
            return back();

        }  	
    }

    public function create()
    {
    	return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $response = $this->projectService->store($request->all());

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return redirect()->route('projects.show', $response['project']);
    }

    public function edit($project)
    {
        $project = $this->projectService->get('slug', $project);

        return view('projects.edit')->with(['project' => $project]);
    } 

    public function update(UpdateProjectRequest $request, $project)
    {   

        $response = $this->projectService->update($request->all(), $project);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return redirect()->route('projects.show', $response['project']);
    }

    public function destroy($project)
    {
        $response = $this->projectService->delete($project);

        if($response['status']){
            toast($response['message'], 'success', 'top-right');
        }else{
            toast($response['message'], 'error', 'top-right');
        }

        return redirect()->route('home');
    }

    public function restore(Request $request, $project)
    {
        dd($request->all());

        // try {
            
        //     $this->project->whereCode($project)->onlyTrashed()->firstOrFail()->restore();

        //     toast('Projeto restaurado com sucesso!', 'success', 'top-right');
            
        //     return redirect()->route('home');

        // } catch (Exception $e) {
            
        //     toast($e->getMessage(), 'error', 'top-right');

        //     return back();
        // }
    }

    public function members($project)
    {

        $response = $this->projectService->getWith('slug', $project, ['members']);

        if($response['status']){
            return view('projects.members.index')->with([
                'project' => $response['project']
            ]);
        }

        toast($response['message'], 'error', 'top-right');
        return back();

        try {
            
            $project = $this->project->whereCode($project)->firstOrFail();

            $project->members()->sync($request->members);

            toast('Alterações nos membros realizadas com sucesso', 'success', 'top-right');

            return back();


        } catch (Exception $e) {
            
            toast($e->getMessage(), 'error', 'top-right');

            return back();
            
        }
    }

    public function tasks($project)
    {
        $response = $this->projectService->getWith('slug', $project, ['tasks', 'tasks.members']);

        if($response['status']){
            return view('projects.tasks.index')->with([
                'project' => $response['project']
            ]);
        }

        toast($response['message'], 'error', 'top-right');
        return back();
        
    }

}
