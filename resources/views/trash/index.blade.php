@extends('layouts.app')

@section('content')
<div class="page-header">
	<h2>Lixeira</h2>
</div>

<div class="content-list-body">
    <div class="card-list">
		<h5>Projetos</h5>
        <div class="card-list-body">
            @foreach($projects as $project)
                <div class="card card-project">
                    <div class="card-body">
                        <div class="card-title">
                        	<div class="d-flex flex-md-row flex-column justify-content-between align-items-center">
                        		<h5 data-filter-by="text" class="H5-filter-by-text">{{ $project->name }}</h5>

                        		<span>Arquivado em: {{ $project->deleted_at->format('d/m/Y H:i') }}</span>

                        		<div class="btn-group" role="group" aria-label="Basic example">
								  	
								  	<form action="{{ route('projects.restore', $project->code) }}" method="POST">
								  		@csrf
								  		@method("PATCH")
								  		<button type="submit" class="btn btn-sm btn-primary confirmation">Restaurar</button>
								  	</form>

								  	<form action="{{ route('projects.destroy', $project->code) }}" method="POST">
							            @csrf
							            @method("DELETE")
								  		<button type="submit" class="btn btn-sm btn-danger confirmation">Excluir</button>
								  	</form>
								</div>
                        	</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="content-list-body">
    <div class="card-list">
		<h5>Tarefas</h5>
        <div class="card-list-body">
            @foreach($tasks as $task)
                <div class="card card-task">
                    <div class="card-body">
                        <div class="card-title">
                            <h5 data-filter-by="text" class="H5-filter-by-text mb-0">{{ $task->name }}</h5>
                            <h6 class="text-muted">{{ $task->project->name }}</h6>
                        </div>
                        <div class="card-meta ">
                            
                            <span>Arquivado em: {{ $task->deleted_at->format('d/m/Y H:i') }}</span>

                            <div class="dropdown card-options">

                                <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <form action="{{ route('projects.tasks.restore', [$task->project->code, $task->code]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <button class="dropdown-item confirmation" type="submit">Restaurar</button>    
                                    </form>

                                    <div class="dropdown-divider"></div>
                                    
                                    <form action="{{ route('projects.tasks.destroy', [$task->project->code, $task->code]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection