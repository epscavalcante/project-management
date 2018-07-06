@extends('layouts.app')

@section('content')
<div class="mt-3">
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('projects.tasks', $project->code) }}">Tarefas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.members', $project->code) }}">Membros</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.activities', $project->code) }}" >Atualizações</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.edit', $project->code) }}">Editar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Excluir</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tasks" role="tabpanel" aria-labelledby="tasks-tab" data-filter-list="card-list-body">
            <div class="row content-list-head">
                <div class="col-auto">
                    <h3>Tarefas</h3>
                    <a class="btn btn-round" href="{{ route('projects.tasks.create', $project->code) }}">
                        <i class="material-icons">add</i>
                    </a>
                </div>
                <form class="col-md-auto">
                    <div class="input-group input-group-round">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">filter_list</i>
                            </span>
                        </div>
                        <input type="search" class="form-control filter-list-input" placeholder="Procurar tarefa" aria-label="Procurar tarefa" aria-describedby="procurar-tarefa">
                    </div>
                </form>
            </div>
            <!--end of content list head-->
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
                                    <a href="#">
                                        <h6 data-filter-by="text" class="H6-filter-by-text">Client objective meeting</h6>
                                    </a>
                                    <span class="text-small">Today</span>
                                </div>
                                <div class="card-meta">
                                    <ul class="avatars">
                                        
                                        @foreach($project->tasks as $task)
                                        <li>
                                            <a href="#" data-toggle="tooltip" title="Kenny">
                                                <img alt="Kenny Tran" class="avatar" src="assets/img/avatar-male-6.jpg">
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <div class="d-flex align-items-center">
                                        <i class="material-icons">playlist_add_check</i>
                                        <span>3/4</span>
                                    </div>
                                    <div class="dropdown card-options">
                                        <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Mark as done</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Archive</a>
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
                                    
        <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab" data-filter-list="list-group-activity">
            <div class="content-list">
                <div class="row content-list-head">
                    <div class="col-auto">
                        <h3>Activity</h3>
                    </div>
                    <form class="col-md-auto">
                        <div class="input-group input-group-round">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">filter_list</i>
                                </span>
                            </div>
                            <input type="search" class="form-control filter-list-input" placeholder="Filter activity" aria-label="Filter activity" aria-describedby="filter-tasks">
                        </div>
                    </form>
                </div>
                <div class="content-list-body">
                    <ol class="list-group list-group-activity filter-list-1530819204204">
                        <li class="list-group-item">
                            <div class="media align-items-center">
                                <ul class="avatars">
                                    <li>
                                        <div class="avatar bg-primary">
                                            <i class="material-icons">playlist_add_check</i>
                                        </div>
                                    </li>
                                    <li>
                                        <img alt="Claire" src="assets/img/avatar-female-1.jpg" class="avatar filter-by-alt" data-filter-by="alt">
                                    </li>
                                </ul>
                                <div class="media-body">
                                    <div>
                                        <span class="h6 SPAN-filter-by-text" data-filter-by="text">Claire</span>
                                        <span data-filter-by="text" class="SPAN-filter-by-text">completed the task</span><a href="#" data-filter-by="text" class="A-filter-by-text">Set up client chat channel</a>
                                    </div>
                                    <span class="text-small SPAN-filter-by-text" data-filter-by="text">Just now</span>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('sidebar')
<button class="btn btn-primary btn-round btn-floating btn-lg d-lg-none" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="false" aria-controls="sidebar-floating-chat">
    <i class="material-icons">more_horiz</i>
    <i class="material-icons">close</i>
</button>
<div class="sidebar collapse p-3" id="sidebar-collapse">
    <div class="sidebar-content">
        
        <div class="page-header">
    
            <h2>{{ $project->name }}</h2>   
            <p class="">{{ $project->description }}</p>
            <ul class="list-unstyled small">
                <li class="list-unstyled-item font-weight-bold">Responsável principal: {{ $project->owner->name }}</li>
                <li class="list-unstyled-item">Criado em: {{ $project->created_at }}</li>
                <li class="list-unstyled-item">Última atualização: {{ $project->updated_at }}</li>
            </ul>

            <div class="d-flex align-items-center">
                <ul class="avatars">
                    @foreach($project->members as $user)
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $user->name }}">
                            <img alt="{{ $user->name }}" class="avatar" src="{{ asset($user->image) }}">
                        </a>
                    </li>
                    @endforeach
                </ul>
                <button class="btn btn-round" data-toggle="modal" data-target="#user-invite-modal">
                    <i class="material-icons">add</i>
                </button>
            </div>
            <div>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:25%;"></div>
                </div>
                <div class="d-flex justify-content-between text-small">
                    <div class="d-flex align-items-center">
                        <i class="material-icons">playlist_add_check</i>
                        <span>3/12</span>
                    </div>
                    <span>Due 9 days</span>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="modal fade" id="user-invite-modal" tabindex="-1" role="dialog" aria-labelledby="user-invite-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Convidar usuário</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <!--end of modal head-->
            <div class="modal-body">
                <p>Envie o convite por e-mail: </p>
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">email</i>
                            </span>
                        </div>
                        <input type="email" class="form-control" placeholder="Digite o e-mail do usuario" aria-label="Digite o e-mail do usuario" aria-describedby="Digite o e-mail do usuario">
                    </div>
                    <div class="text-right text-small mt-2">
                        <a href="{{ route('users.invite') }}" role="button">Procurar mais</a>
                    </div>
                </div>
            </div>
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Convidar usuário
                </button>
            </div>
        </div>
    </div>
</form>
@endsection