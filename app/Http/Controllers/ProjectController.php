<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use App\Project;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function index()
    {
        return view('index')->with(['projects' => $this->project->all()]);
    }

    public function show(Project $project)
    {
        return view('show', compact('project'));

    }

    public function create()
    {
        return view('create');
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->all());
        $project->members()->attach(auth()->user(), ['role_id' => '1', 'created_at' => \Carbon\Carbon::now()]);
        toast('Projeto criado com sucesso', 'success', 'top-right');
        return redirect()->route('projects.show', $project);
    }

    public function edit(Project $project)
    {
        return view('edit')->with(['project' => $project]);
    } 

    public function update(UpdateProjectRequest $request, Project $project)
    {   
        $status = $project->update($request->all());

        if($status){
            toast('Projeto editado com sucesso', 'success', 'top-right');
        } else{
            toast('Erro ao tentar alterar projeto', 'error', 'top-right');
            return back();
        }

        return redirect()->route('projects.show', $project);
    }

    public function destroy(Project $project)
    {

        if($project->delete()){
            toast('Projeto movido para lixeira', 'success', 'top-right');
        }else{
            toast('Erro ao tentar mover projeto para lixeira', 'error', 'top-right');
        }

        return redirect()->route('home');
        
    }
}
