@extends('layouts.app')

@section('config')
<div class="dropdown">
    <button class="btn btn-round" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
    	<div class="dropdown-header">
    		Projeto
    	</div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#project-edit-modal">Editar</a>
        <form action="{{ route('projects.delete', $project->code) }}" method="POST">
            @csrf
            @method("PATCH")
            <button class="dropdown-item confirmation" type="submit">Arquivar</button>
        </form>
        <div class="dropdown-divider"></div>

        <form action="{{ route('projects.destroy', $project->code) }}" method="POST">
            @csrf
            @method("DELETE")
            <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center">
        <div class="mb-2">
            <span class="text-muted">Projeto #{{ $project->code }}</span>
            <h2 class="mb-0"> {{ $project->name }}</h2>
        </div>
        
        <div class="d-flex align-items-center">
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

            <button class="btn btn-round" data-toggle="modal" data-target="#user-manage-modal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <p class="lead">{{ $project->description }}</p>
    
    <div>
        <div class="progress">
            <div class="progress-bar bg-success" style="width:{{ $project->progress($project->tasks_finished_count, $project->tasks_count) }}%;"></div>
        </div>
        <div class="d-flex justify-content-between small">
            <span data-toggle="tooltip" title="Início em {{ $project->start }}">
                <i class="fas fa-flag"></i>
            </span>

            <div>
                <i class="fas fa-tasks"></i> 
                {{ $project->tasks_finished_count }} / {{ $project->tasks_count }}</span>
            </div>
                
            <span data-toggle="tooltip" title="Término em {{ $project->end }}">
                <i class="fas fa-trophy"></i>
            </span>
        </div>
    </div>
</div>

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

<div class="content-list-body">
    <div class="card-list">
        <div class="card-list-body filter-list-1530819204215">
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
                    </div>
                    <div class="card-meta ">
                        <ul class="avatars">
                            
                            @foreach($task->members as $member)
                            <li>
                                <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                                    <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
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
            @empty
            Não há tarefas
            @endforelse
        </div>
    </div>
</div>

<form class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal" aria-hidden="true" action="{{ route('projects.tasks.store', $project->code) }}" method="POST">
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

<form class="modal fade" id="user-manage-modal" tabindex="-1" role="dialog" aria-labelledby="user-manage-modal" aria-hidden="true" action="{{ route('projects.members', $project->code) }}" method="POST">
@csrf
@method("PUT")
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gerenciar membros</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!--end of modal head-->
            <div class="modal-body">
                <div class="users-manage" data-filter-list="form-group-users">
                    <div class="input-group input-group-round">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-filter"></i>
                            </span>
                        </div>
                        <input type="search" class="form-control filter-list-input" placeholder="Buscar membro" aria-label="Filter Members" aria-describedby="filter-members">
                    </div>
                    <div class="form-group-users">
                        @foreach($users as $user)
                        @if($user->id != auth()->user()->id)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user-{{ $user->id }}" {{ $project->members->contains($user->id) ? 'checked' : '' }} name="members[]" value="{{ $user->id }}">
                            <label class="custom-control-label" for="user-{{ $user->id }}">
                                <div class="d-flex align-items-center">
                                    <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
                                    <span class="h6 mb-0" data-filter-by="text">{{ $user->name }}</span>
                                </div>
                            </label>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</form>
<form class="modal fade" id="project-edit-modal" tabindex="-1" role="dialog" aria-labelledby="project-edit-modal" >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Project</h5>
                                            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </div>
                                        <!--end of modal head-->
                                        <ul class="nav nav-tabs nav-fill">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="project-edit-details-tab" data-toggle="tab" href="#project-edit-details" role="tab" aria-controls="project-edit-details" aria-selected="true">Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="project-edit-members-tab" data-toggle="tab" href="#project-edit-members" role="tab" aria-controls="project-edit-members" aria-selected="false">Members</a>
                                            </li>
                                        </ul>
                                        <div class="modal-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="project-edit-details" role="tabpanel" aria-labelledby="project-edit-details-tab">
                                                    <h6>General Details</h6>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-3">Name</label>
                                                        <input class="form-control col" type="text" value="Brand Concept and Design" name="project-name">
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-3">Description</label>
                                                        <textarea class="form-control col" rows="3" placeholder="Project description" name="project-description">Research, ideate and present brand concepts for client consideration</textarea>
                                                    </div>
                                                    <hr>
                                                    <h6>Timeline</h6>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-3">Start Date</label>
                                                        <input class="form-control col" type="date" placeholder="Project start" name="project-start">
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-3">Due Date</label>
                                                        <input class="form-control col" type="date" placeholder="Project due" name="project-due">
                                                    </div>
                                                    <div class="alert alert-warning text-small" role="alert">
                                                        <span>You can change due dates at any time.</span>
                                                    </div>
                                                    <hr>
                                                    <h6>Visibility</h6>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="visibility-everyone" name="visibility" class="custom-control-input" checked="">
                                                                <label class="custom-control-label" for="visibility-everyone">Everyone</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="visibility-members" name="visibility" class="custom-control-input">
                                                                <label class="custom-control-label" for="visibility-members">Members</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="visibility-me" name="visibility" class="custom-control-input">
                                                                <label class="custom-control-label" for="visibility-me">Just me</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="project-edit-members" role="tabpanel" aria-labelledby="project-edit-members-tab">
                                                    <div class="users-manage" data-filter-list="form-group-users">
                                                        <div class="mb-3">
                                                            <ul class="avatars text-center">

                                                                <li>
                                                                    <img alt="Claire Connors" src="assets/img/avatar-female-1.jpg" class="avatar" data-toggle="tooltip" data-title="Claire Connors">
                                                                </li>

                                                                <li>
                                                                    <img alt="Marcus Simmons" src="assets/img/avatar-male-1.jpg" class="avatar" data-toggle="tooltip" data-title="Marcus Simmons">
                                                                </li>

                                                                <li>
                                                                    <img alt="Peggy Brown" src="assets/img/avatar-female-2.jpg" class="avatar" data-toggle="tooltip" data-title="Peggy Brown">
                                                                </li>

                                                                <li>
                                                                    <img alt="Harry Xai" src="assets/img/avatar-male-2.jpg" class="avatar" data-toggle="tooltip" data-title="Harry Xai">
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="input-group input-group-round">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="material-icons">filter_list</i>
                                                                </span>
                                                            </div>
                                                            <input type="search" class="form-control filter-list-input" placeholder="Filter members" aria-label="Filter Members" aria-describedby="filter-members">
                                                        </div>
                                                        <div class="form-group-users filter-list-1531103195726"><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-1" checked="">
                                                                <label class="custom-control-label" for="project-user-1">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Claire Connors" src="assets/img/avatar-female-1.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Claire Connors</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-2" checked="">
                                                                <label class="custom-control-label" for="project-user-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Marcus Simmons" src="assets/img/avatar-male-1.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Marcus Simmons</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-3" checked="">
                                                                <label class="custom-control-label" for="project-user-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Peggy Brown" src="assets/img/avatar-female-2.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Peggy Brown</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-4" checked="">
                                                                <label class="custom-control-label" for="project-user-4">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Harry Xai" src="assets/img/avatar-male-2.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Harry Xai</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-5">
                                                                <label class="custom-control-label" for="project-user-5">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Sally Harper" src="assets/img/avatar-female-3.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Sally Harper</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-6">
                                                                <label class="custom-control-label" for="project-user-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Ravi Singh" src="assets/img/avatar-male-3.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Ravi Singh</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-7">
                                                                <label class="custom-control-label" for="project-user-7">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Kristina Van Der Stroem" src="assets/img/avatar-female-4.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Kristina Van Der Stroem</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-8">
                                                                <label class="custom-control-label" for="project-user-8">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="David Whittaker" src="assets/img/avatar-male-4.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">David Whittaker</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-9">
                                                                <label class="custom-control-label" for="project-user-9">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Kerri-Anne Banks" src="assets/img/avatar-female-5.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Kerri-Anne Banks</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-10">
                                                                <label class="custom-control-label" for="project-user-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Masimba Sibanda" src="assets/img/avatar-male-5.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Masimba Sibanda</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-11">
                                                                <label class="custom-control-label" for="project-user-11">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Krishna Bajaj" src="assets/img/avatar-female-6.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Krishna Bajaj</span>
                                                                    </div>
                                                                </label>
                                                            </div><div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="project-user-12">
                                                                <label class="custom-control-label" for="project-user-12">
                                                                    <div class="d-flex align-items-center">
                                                                        <img alt="Kenny Tran" src="assets/img/avatar-male-6.jpg" class="avatar mr-2">
                                                                        <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">Kenny Tran</span>
                                                                    </div>
                                                                </label>
                                                            </div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end of modal body-->
                                        <div class="modal-footer">
                                            <button role="button" class="btn btn-primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
</form>
@endsection

