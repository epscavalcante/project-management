@extends('layouts.app')

@section('content')
<div class="page-header">
	@include('projects.partials.menu')	
	<div class="d-flex justify-content-between align-items-center content-list-head">
	    <div class="col">
	        <h3 class="d-inline">Tarefas</h3>
	        <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
	            <i class="fas fa-plus"></i>
	        </button>
	    </div>
	    <form class="">
	        <div class="input-group input-group-round">
	            <div class="input-group-prepend">
	                <span class="input-group-text">
	                    <i class="fas fa-filter"></i>
	                </span>
	            </div>
	            <input type="search" class="form-control filter-list-input" placeholder="Procurar tarefa" aria-label="Procurar tarefa" aria-describedby="procurar-tarefa">
	        </div>
	    </form>
	</div>
</div>

<div class="content-list-body">
    <div class="card-list">
        <div class="card-list-body">

            @forelse($project->tasks as $task)
            <div class="card card-task">
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <a href="{{ route('projects.tasks.show', [$project, $task]) }}">
                            <h5 data-filter-by="text" class="mb-0">{{ $task->name }}</h5>
                            <p class="small text-muted">{{ $task->description }}</p>
                        </a>
                    </div>
                    <div class="card-meta d-flex justify-content-between">
                        <ul class="avatars">
                            
                            @foreach($task->members as $member)
                            <li>
                                <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                                    <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                                </a>
                            </li>
                            @endforeach

                        </ul>
                        
                        <span class="mr-2"><i class="fas fa-tasks"></i> 3/4</span>
                            
                        
                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST">
                            @csrf
                            @method("PATCH")
                            <button class="btn btn-sm btn-danger confirmation" type="submit">Excluir</button>    
                        </form>

                    </div>
                </div>
            </div>
            @empty
            Não há tarefas
            @endforelse
        </div>
    </div>
</div>

<form class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal" aria-hidden="true" action="{{ route('projects.tasks.store', $project) }}" method="POST">
    @csrf
    @method("POST")
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova tarefa</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a class="nav-link active" id="task-add-details-tab" data-toggle="tab" href="#task-add-details" role="tab" aria-controls="task-add-details" aria-selected="true">Detalhes da tarefa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="task-add-members-tab" data-toggle="tab" href="#task-add-members" role="tab" aria-controls="task-add-members" aria-selected="false">Membros dessa tarefa</a>
                </li>
            </ul>

            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="task-add-details" role="tabpanel" aria-labelledby="task-add-details-tab">
                        
                        <div class="form-group row align-items-center">
                            <label class="col-3">Nome</label>
                            <input class="form-control col" type="text" placeholder="Task name" name="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Descrição</label>
                            <textarea class="form-control col" rows="3" placeholder="Task description" name="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col col-sm-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-3">Início</label>
                                    <input class="form-control col" type="date" placeholder="Task start" name="start">
                                    @if ($errors->has('start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-3">Término</label>
                                    <input class="form-control col" type="date" placeholder="Task due" name="end">
                                    @if ($errors->has('end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="task-add-members" role="tabpanel" aria-labelledby="task-add-members-tab">
                        <h6>Membros para essa tarefa</h6>

                        <div class="alert alert-warning">
                            <p>Se algum usuário não estiver na lista abaixo. Adicione ele ao projeto!</p>
                        </div>

                        <div class="users-manage" data-filter-list="form-group-users">
                            <div class="input-group input-group-round">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-filter"></i>
                                    </span>
                                </div>
                                <input type="search" class="form-control filter-list-input" placeholder="Buscar usuário" aria-label="Buscar usuário" aria-describedby="buscar-usuario">
                            </div>
                            
                            <div class="form-group-users ">
                                @foreach($project->members as $user)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="user{{ $user->id }}" name="members[]" value="{{ $user->id }}">
                                    <label class="custom-control-label" for="user{{ $user->id }}">
                                        <div class="d-flex align-items-center">
                                            <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
                                            <span class="h6 mb-0" data-filter-by="text">{{ $user->name }}</span>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Criar tarefa
                </button>
            </div>
        </div>
    </div>
</form>

<button class="btn btn-primary btn-round btn-floating btn-lg" type="button" data-toggle="collapse" data-target="#floating-chat" aria-expanded="false" aria-controls="sidebar-floating-chat">
    <i class="fas fa-star"></i>
    <i class="fas fa-times"></i>
</button>
<div class="collapse sidebar-floating" id="floating-chat">
    <div class="sidebar-content p-2">
        <div class="page-header">
	        <h2>{{ $project->name }}</h2>
		    <p class="lead">{{ $project->description }}</p>
		    <ul class="avatars">
	                <li>
	                    <a href="#" data-toggle="tooltip" title="{{ $project->owner->name }}">
	                        <img alt="{{ $project->owner->name }}" class="avatar" src="{{ asset($project->owner->image) }}">
	                    </a>
	                </li>                      
	                @foreach($project->members as $member)
	                <li>
	                    <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
	                        <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
	                    </a>
	                </li>
	                @endforeach
            </ul>
	            
		    <div>
		        <div class="progress">
		            <div class="progress-bar bg-success" style="width:{{ $project->progress($project->tasks_finished_count, $project->tasks_count) }}%;"></div>
		        </div>
		        <div class="d-flex justify-content-between small">
		            <span data-toggle="tooltip" title="Início em @unless(empty($project->start)){{ $project->start->format('d/m/Y') }} @endunless">
		                <i class="fas fa-flag"></i>
		            </span>

		            <div>
		                <i class="fas fa-tasks"></i> 
		                {{ $project->tasks_finished_count }} / {{ $project->tasks_count }}</span>
		            </div>
		                
		            <span data-toggle="tooltip" title="Término em @unless(empty($project->end)){{ $project->end->format('d/m/Y') }} @endunless">
		                <i class="fas fa-trophy"></i>
		            </span>
		        </div>
		    </div>
		</div>
    </div>
</div>
@endsection

{{-- @section('sidebar')
    <button class="btn btn-primary btn-round btn-floating btn-lg d-lg-none" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="false" aria-controls="sidebar-floating-chat">
        <i class="material-icons">more_horiz</i>
        <i class="material-icons">close</i>
    </button>
    <div class="sidebar collapse" id="sidebar-collapse">
        <div class="sidebar-content">
        
        <div class="page-header px-2">
            <div class="d-flex justify-content-between align-items-center content-list-head">
                    <h3 class="d-inline">Tarefas</h3>
                    <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
                        <i class="fas fa-plus"></i>
                    </button>
                
            </div>

            <form class="form-group">
                <div class="input-group input-group-round">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-filter"></i>
                        </span>
                    </div>
                    <input type="search" class="form-control filter-list-input" placeholder="Procurar tarefa" aria-label="Procurar tarefa" aria-describedby="procurar-tarefa">
                </div>
            </form>

            <div class="content-list-body">
                <div class="card-list">
                    <div class="card-list-body">

                        @forelse($project->tasks as $task)
                        <div class="card card-task">
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <a href="{{ route('projects.tasks.show', [$project->code, $task->code]) }}">
                                        <h5 data-filter-by="text" class="mb-0">{{ $task->name }}</h5>
                                        <p class="small text-muted">{{ $task->description }}</p>
                                    </a>
                                    <div class="card-meta ">
                                    <ul class="avatars">
                                        
                                        @foreach($task->members as $member)
                                        <li>
                                            <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                                                <img alt="{{ $member->name }}" class="avatar avatar-sm" src="{{ asset($member->image) }}">
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                    
                                    <span><i class="fas fa-tasks"></i> 3/4</span>
                                        
                                    <div class="dropdown card-options">
                                        <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="{{ route('projects.tasks.delete', [$project->code, $task->code]) }}" method="POST">
                                                @csrf
                                                @method("PATCH")
                                                <button class="dropdown-item confirmation" type="submit">Arquivar</button>    
                                            </form>

                                            <div class="dropdown-divider"></div>
                                            
                                            <form action="{{ route('projects.tasks.destroy', [$project->code, $task->code]) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>    
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        @empty
                        Não há tarefas
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
            


        </div>
    </div>
@endsection --}}