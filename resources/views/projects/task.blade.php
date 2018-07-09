@extends("layouts.app")

@section('config')
<div class="dropdown">
    <button class="btn btn-round" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">

        <a href="{{ route('projects.edit', $task->project->code) }}" class="dropdown-item">Editar</a>
        
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
        	<h2 class="mb-0"> {{ $task->name }}</h2>   

        	<span class="text-muted">Tarefa #{{ $task->code }}</span>
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
    
    <div class="progress">
        <div class="progress-bar bg-success" style="width:{{-- $project->progress($project->tasks_finished_count, $project->tasks_count) --}}50%;"></div>
    </div>
    <div class="d-flex justify-content-between small">
        <span data-toggle="tooltip" title="Início em {{ $task->end }}">
            <i class="fas fa-flag"></i>
        </span>

        <div>
            <i class="fas fa-tasks"></i> 
            {{-- $project->tasks_finished_count }} / {{ $project->tasks_count --}}</span>
        </div>
            
        <span data-toggle="tooltip" title="Término em {{ $task->end }}">
            <i class="fas fa-trophy"></i>
        </span>
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
@endsection