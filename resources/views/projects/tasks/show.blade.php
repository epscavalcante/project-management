@extends("layouts.app")

@section('content')

<div class="page-header">
    
    @include('projects.tasks.partials.menu')

    <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center">
    	<div class="mb-2">
            
            <h2> {{ $task->name }}</h2>
            @if($task->user_id == auth()->user()->id)
            <div class="btn-group btn-group-sm" role="group" aria-label="Controle do projeto">
                <a class="btn btn-sm btn-outline-primary" href="#task-edit-modal" data-toggle="modal">Editar</a>
                <form action="{{ route('projects.tasks.destroy', [$task->project, $task]) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-sm btn-outline-danger confirmation" type="submit">Excluir</button>    
                </form>
            </div>
            @endif
               
        </div>

        <ul class="avatars">
            @foreach($task->members as $member)
            <li>
                <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                    <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <p class="lead">{{ $task->description }}</p>
    
    <div>
        <div class="progress">
            <div class="progress-bar bg-success" style="width:{{ $task->progress($task->todos_finished_count, $task->todos_count) }}%;"></div>
        </div>
        
        <div class="d-flex justify-content-between small mb-3">
            <span data-toggle="tooltip" title="Início em @unless(empty($task->start)) {{ $task->start->format('d/m/Y') }} @endunless">
                <i class="fas fa-flag"></i>
            </span>

            <div>
                <i class="fas fa-tasks"></i> 
                {{ $task->todos_finished_count }} / {{ $task->todos_count }}</span>
            </div>
                
            <span data-toggle="tooltip" title="Término em @unless(empty($task->end)) {{ $task->end->format('d/m/Y') }} @endunless">
                <i class="fas fa-trophy"></i>
            </span>
        </div>
    </div>
    
    <hr>
    
    <div class="content-list">
        <div class="row content-list-head">
            <div class="col-auto">
                <h3>Lista de afazeres</h3>
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
            
            <form action="{{ route('projects.tasks.todos.store', [$task->project, $task]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="description" class="form-control form-control-lg" placeholder="O que você tem que fazer?">
                </div>
            </form>

            @foreach($task->todos as $todo)
            <div class="card card-note ">
                <div class="card-body d-flex align-items-center p-2">
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('projects.tasks.todo.mark',[$task->project, $task, $todo]) }}" method="POST" class="mr-2">
                            @csrf
                            @method("PATCH")
                            @if($todo->finished)
                            <button class="btn btn-sm btn-outline-success confirmation" type="submit" data-toggle="tooltip" title="Reabrir item"><i class="fas fa-check"></i> feito</button>
                            @else
                            <button class="btn btn-sm btn-outline-danger confirmation" type="submit" data-toggle="tooltip" title="Finalizar item"><i class="fas fa-times"></i> a fazer</button>
                            @endif
                        </form>

                        <p>{{ $todo->description }}</p>
                    </div>
                    <div class="pl-5 ml-3 dropdown card-options">
                        <button class="btn-options" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @unless($todo->finished)
                            <a class="dropdown-item" href="#todo-edit-modal-{{ $todo->id }}" data-toggle="modal">Editar</a>
                            @endunless
                            

                            <form action="{{ route('projects.tasks.todo.destroy',[$task->project, $task, $todo]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="dropdown-item text-danger confirmation" type="submit">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @unless($todo->finished)
            <form class="modal fade" id="todo-edit-modal-{{ $todo->id }}" tabindex="-1" role="dialog" aria-labelledby="todo-add-modal" action="{{ route('projects.tasks.todos.update', [$task->project, $task, $todo]) }}" method="POST">
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
            @endunless
            @endforeach
        </div>
    </div>
</div>

<button class="btn btn-primary btn-round btn-floating btn-lg" type="button" data-toggle="collapse" data-target="#floating-chat" aria-expanded="false" aria-controls="sidebar-floating-chat">
    <i class="fas fa-star"></i>
    <i class="fas fa-times"></i>
</button>
<div class="collapse sidebar-floating" id="floating-chat">
    <div class="sidebar-content p-2">
        <div class="page-header">
            <h2>{{ $task->project->name }}</h2>
            <p class="lead">{{ $task->project->description }}</p>
            <ul class="avatars">
                <li>
                    <a href="#" data-toggle="tooltip" title="{{ $task->project->owner->name }}">
                        <img alt="{{ $task->project->owner->name }}" class="avatar" src="{{ asset($task->project->owner->image) }}">
                    </a>
                </li>                      
                @foreach($task->project->members as $member)
                <li>
                    <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                        <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                    </a>
                </li>
                @endforeach
            </ul>
                
            <div>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:{{ $task->project->progress($task->project->tasksFinished->count(), $task->project->tasks->count()) }}%;"></div>
                </div>
                <div class="d-flex justify-content-between small">
                    <span data-toggle="tooltip" title="Início em @unless(empty($task->project->start)){{ $task->project->start->format('d/m/Y') }} @endunless">
                        <i class="fas fa-flag"></i>
                    </span>

                    <div>
                        <i class="fas fa-tasks"></i> 
                        {{ $task->project->tasksFinished->count() }} / {{ $task->project->tasks->count() }}</span>
                    </div>
                        
                    <span data-toggle="tooltip" title="Término em @unless(empty($task->project->end)){{ $task->project->end->format('d/m/Y') }} @endunless">
                        <i class="fas fa-trophy"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="modal fade" id="task-edit-modal" tabindex="-1" role="dialog" aria-labelledby="project-edit-modal" action="{{ route('projects.tasks.update', [$task->project, $task]) }}" method="POST">
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
                    <input class="form-control col" type="date" placeholder="Início da tarefa" name="start" value="{{ (empty($task->start)) ? '' : $task->start->format('Y-m-d') }}" />
                    @if ($errors->has('start'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-3">Término</label>
                    <input class="form-control col" type="date" placeholder="Término da tarefa" name="end" value="{{ (empty($task->end)) ? '' : $task->end->format('Y-m-d') }}" />
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
@endsection