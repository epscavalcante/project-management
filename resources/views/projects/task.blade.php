@extends("layouts.app")

@section('config')
<div class="dropdown">
    <button class="btn btn-round" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header">
            Tarefa
        </div>

        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#task-edit-modal">Editar</a>
        
        <form action="{{ route('projects.tasks.delete', [$task->project->code, $task->code]) }}" method="POST" class="">
            @csrf
            @method("PATCH")
            <button class="dropdown-item confirmation" type="submit">Arquivar</button>
        </form>

        <div class="dropdown-divider"></div>

        <form action="{{ route('projects.tasks.destroy', [$task->project->code, $task->code]) }}" method="POST">
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
            <span class="text-muted">Tarefa #{{ $task->code }}</span>
        	<h2> {{ $task->name }}</h2>   
        </div>

        <div class="d-flex align-items-center">
            <ul class="avatars">
                @foreach($task->members as $member)
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

    <p class="lead">{{ $task->description }}</p>
    
    <div>
        <div class="progress">
            <div class="progress-bar bg-success" style="width:{{-- $project->progress($project->tasks_finished_count, $project->tasks_count) --}}50%;"></div>
        </div>
        
        <div class="d-flex justify-content-between small mb-3">
            <span data-toggle="tooltip" title="Início em @unless(empty($task->start)) {{ $task->start->format('d/m/Y') }} @endunless">
                <i class="fas fa-flag"></i>
            </span>

            <div>
                <i class="fas fa-tasks"></i> 
                {{-- $project->tasks_finished_count }} / {{ $project->tasks_count --}}</span>
            </div>
                
            <span data-toggle="tooltip" title="Término em @unless(empty($task->end)) {{ $task->end->format('d/m/Y') }} @endunless">
                <i class="fas fa-trophy"></i>
            </span>
        </div>
    </div>

    <hr>

    <div class="content-list" data-filter-list="content-list-body">
        <div class="row content-list-head">
            <div class="col-auto">
                <h3>Checklist</h3>
                <button class="btn btn-round" data-toggle="modal" data-target="#todo-add-modal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <form class="col-md-auto">
                <div class="input-group input-group-round">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-filter"></i>
                        </span>
                    </div>
                    <input type="search" class="form-control filter-list-input" placeholder="Filter notes" aria-label="Filter notes" aria-describedby="filter-notes">
                </div>
            </form>
        </div>
        <!--end of content list head-->
        <div class="content-list-body">
            @foreach($task->todos as $todo)
            <div class="card card-note">
                <div class="card-header">
                    <div class="media align-items-center">
                        <img alt="{{ $todo->author->name }}" src="{{ asset($todo->author->image) }}" class="avatar filter-by-alt" data-toggle="tooltip" data-title="{{ $todo->author->name }}" data-filter-by="alt">
                        <div class="media-body">
                            <h6 class="mb-0 H6-filter-by-text" data-filter-by="text">{{ $todo->author->name }}</h6>
                            <span class="text-muted small">
                            {{ $todo->created_at->diffForHumans() }}
                        </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        @if($todo->finished)
                        <span class="text-success mr-2">
                            <i class="fas fa-check-circle"></i> Feito
                        </span>
                        @endif
                        
                        <div class="ml-3 dropdown card-options">
                            <button class="btn-options" type="button" id="note-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#todo-edit-modal-{{ $todo->id }}" data-toggle="modal">Editar</a>
                                <a class="dropdown-item text-success" href="#">Finzalizar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body DIV-filter-by-text" data-filter-by="text">
                    {{ $todo->description }}
                </div>
            </div>
            <form class="modal fade" id="todo-edit-modal-{{ $todo->id }}" tabindex="-1" role="dialog" aria-labelledby="todo-add-modal" action="{{ route('projects.tasks.todos.update', [$task->project->code, $task->code, $todo->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar item</h5>
                            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea class="form-control" rows="6" placeholder="Digite aqui o quê írá fazer" name="description" autofocus="autofocus" required>{{ $todo->description }}</textarea>
                                @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('end') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button role="button" class="btn btn-primary" type="submit">
                                Editar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>

</div>

<button class="btn btn-primary btn-round btn-floating btn-lg collapsed" type="button" data-toggle="collapse" data-target="#floating-project-details" aria-expanded="false" aria-controls="sidebar-project-detail">
    <i class="fas fa-star"></i>
    <i class="fas fa-times"></i>
</button>

<div class="sidebar-floating collapse" id="floating-project-details" style="">
    <div class="sidebar-content p-4">
    	<h3> {{ $task->project->name }}</h3>

    	<p class="lead">{{ $task->project->description }}</p>

        <ul class="avatars">
            @foreach($task->project->members as $member)
            <li>
                <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                    <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                </a>
            </li>
            @endforeach
            
        </ul>
    </div>
</div>

<form class="modal fade" id="user-manage-modal" tabindex="-1" role="dialog" aria-labelledby="user-manage-modal" aria-hidden="true" action="{{ route('projects.tasks.members', [$task->project->code, $task->code]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gerenciar usuários</h5>
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
                    <div class="form-group-users filter-list-1530996857159">
                        @foreach($task->project->members as $user)
                        @if($user->id != auth()->user()->id)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user-{{ $user->id }}" {{ $task->members->contains($user->id) ? 'checked' : '' }} name="members[]" value="{{ $user->id }}">
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
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</form>

<form class="modal fade" id="task-edit-modal" tabindex="-1" role="dialog" aria-labelledby="project-edit-modal" action="{{ route('projects.tasks.update', [$task->project->code, $task->code]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar projeto</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <h6>Detalhes</h6>
                <div class="form-group row align-items-center">
                    <label class="col-3">Nome</label>
                    <input class="form-control col" type="text" placeholder="Nome do tarefa" name="name" value="{{ old("name") ?? $task->name }}" />
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="col-3">Descrição</label>
                    <textarea class="form-control col" rows="3" placeholder="Descrição da tarefa" name="description">{{ old("description") ?? $task->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <hr>
                <h6>Prazo</h6>
                <div class="form-group row align-items-center">
                    <label class="col-3">Início</label>
                    <input class="form-control col" type="date" placeholder="Início da tarefa" name="start" value="{{ $task->start }}" />
                    @if ($errors->has('start'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-3">Término</label>
                    <input class="form-control col" type="date" placeholder="Término da tarefa" name="end" value="{{ $task->end }}" />
                    @if ($errors->has('end'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Editar
                </button>
            </div>
        </div>
    </div>
</form>

<form class="modal fade" id="todo-add-modal" tabindex="-1" role="dialog" aria-labelledby="todo-add-modal" action="{{ route('projects.tasks.todos.store', [$task->project->code, $task->code]) }}" method="POST">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo item</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" rows="6" placeholder="Digite aqui o quê írá fazer" name="description" autofocus="autofocus" required>{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('end') }}</strong>
                    </span>
                    @endif
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
@endsection