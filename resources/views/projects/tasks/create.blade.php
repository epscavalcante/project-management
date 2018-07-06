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
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tasks" role="tabpanel" aria-labelledby="tasks-tab" data-filter-list="card-list-body">
            <div class="content-list-head">
                <h3>Nova tarefa</h3>
            </div>
            <!--end of content list head-->
            <div class="content-list-body">
                <div class="card-list">
                    <div class="card-list-body pr-2">
                        <h6>Detalhes</h6>
                        <div class="form-group row align-items-center">
                            <label class="col-3">Nome</label>
                            <input class="form-control col" type="text" placeholder="Task name" name="task-name">
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Descrição</label>
                            <textarea class="form-control col" rows="3" placeholder="Task description" name="task-description"></textarea>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="card-list">
                    <div class="card-list-body pr-2">
                        <h6>Período</h6>
                        <div class="form-group row align-items-center">
                            <label class="col-3">Início</label>
                            <input class="form-control col" type="date" placeholder="Task start" name="task-start">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-3">Término</label>
                            <input class="form-control col" type="date" placeholder="Task due" name="task-due">
                        </div>
                        <div class="alert alert-warning text-small" role="alert">
                            <span>Poderá ser alterado posteriormente</span>
                        </div>
                    </div>
                </div>
                    
                <h6>Membros para essa tarefa</h6>
                <div class="users-manage" data-filter-list="form-group-users">
                    <div class="input-group input-group-round">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">filter_list</i>
                            </span>
                        </div>
                        <input type="search" class="form-control filter-list-input" placeholder="Buscar usuário" aria-label="Buscar usuário" aria-describedby="buscar-usuario">
                    </div>
                    <div class="form-group-users ">
                        @foreach($users as $user)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user{{ $user->id }}">
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
    
            <h3>
                {{ $project->name }}
                
            </h3>   
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
            <div class="mb-4">
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

            <div class="text-center">
                <button type="button" class="btn btn-sm btn-primary">Editar</button>
                <button type="button" class="btn btn-sm btn-danger">Excluir</button>
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