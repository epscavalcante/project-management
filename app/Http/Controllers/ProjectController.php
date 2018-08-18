<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;

use App\Http\Services\ProjectService;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    
    public function index()
    {
        return view('home');
    }

    public function show(Project $project)
    {

        return view('projects.show')->with([
            'project' => $project,
        ]);

    }

    public function create()
    {
    	return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->all());
        $project->members()->attach(auth()->user(), ['role' => 'OWNER', 'created_at' => \Carbon\Carbon::now()]);
        toast('Projeto criado com sucesso', 'success', 'top-right');
        return redirect()->route('projects.show', $project);
    }

    public function edit(Project $project)
    {
        return view('projects.edit')->with(['project' => $project]);
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

    public function members(Project $project)
    {

        return view('projects.members.index')->with([
            'project' => $project,
            'members' => $project->members
        ]);

        // try {
            
        //     $project = $this->project->whereCode($project)->firstOrFail();

        //     $project->members()->sync($request->members);

        //     toast('Alterações nos membros realizadas com sucesso', 'success', 'top-right');

        //     return back();


        // } catch (Exception $e) {
            
        //     toast($e->getMessage(), 'error', 'top-right');

        //     return back();
            
        // }
    }

    public function tasks(Project $project)
    {


        return view('projects.tasks.index')->with([
            'project' => $project,
            'tasks' => $project->tasks
        ]);

        /**
        *
        *   Retorna um objeto do model Project com os relacionamentos:
            Tasks => [
                        Membros
                        Itens
                        ItensFinalizados
                    ];
            Membros;
            Owner
            Melhora: Retornar para cada task trazer a quantidade todal e quantidade de itens finalizados.
            Hoje esta trazendo objetos ao inves da quantidade. Esta é obtida com o count na view.
        *
        */

        // $response = $this->projectService->getWith('slug', $project, ['tasks','tasks.members', 'tasks.todos', 'tasks.todosFinished']);

        // if($response['status']){
        //     return view('projects.tasks.index')->with([
        //         'project' => $response['project']
        //     ]);
        // }

        // toast($response['message'], 'error', 'top-right');
        // return back();
        
    }

}
