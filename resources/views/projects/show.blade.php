@extends('layouts.app')

@section('title')
{{ $project->name }}
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2 class="mb-0">{{ $project->name }}</h2>    
    <div class="">
        <a class="btn btn-outline-primary" href="{{ route('projects.edit', $project) }}">Editar</a>
        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
            @csrf
            @method("DELETE")
            <button class="btn btn-outline-danger confirmation" type="submit">Excluir</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-8"> 

        <div class="mt-3 p-3 bg-light rounded shadow-sm border">

            <h5 class="font-weight-bold">
                Tarefas 
                <a href="#tasks-new-modal" data-toggle="modal" class="btn btn-outline-primary btn-sm rounded-circle ml-2"><i class="fas fa-plus"></i></a>
            </h5>
            
            
            <ul class="list-group">
                @foreach($project->tasks as $task)
                <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="">
                <li class="list-group-item">
                    <h5 class="text-truncate">
                         {{ $task->description }}
                    </h5>
                    
                    <span class="badge badge-success">
                        {{ $task->status->name }}
                    </span> 
                    |
                    {{ $task->type->name }}
                    |
                    Feita por: {{ $task->user->name }}
                    
                    <div class="float-right small text-muted">{{ $task->updated_at }}</div>
                </li>
                </a>
                @endforeach
            </ul>
         </div>

        <form class="modal fade" id="tasks-new-modal" tabindex="-1" role="dialog" aria-labelledby="user-invite-modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova tarefa</h5>
                        <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!--end of modal head-->
                    <div class="modal-body">
                        <p>Descreva a tarefa abaixo</p>
                        <div class="form-group">
                            <select name="task_type" id="" class="custom-select">
                            @foreach($task_types as $type)
                            <option value="{{ $type->id }}"> {{ $type->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group">
                            <textarea name="description" placeholder="Descreva o conteúdo" class="form-control" rows="10"></textarea>
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

        <form class="modal fade" id="invite-user-modal" tabindex="-1" role="dialog" aria-labelledby="user-invite-modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Convite</h5>
                        <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!--end of modal head-->
                    <div class="modal-body">
                        <p>Envie um convite para algum colega colaborar neste projeto</p>
                        <div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" placeholder="Recipient email address" aria-label="Recipient email address" aria-describedby="recipient-email-address">
                            </div>
                            <small class="form-text text-muted text-right">Separe por <strong>;</strong> cada e-mail</small>
                        </div>
                    </div>
                    <!--end of modal body-->
                    <div class="modal-footer">
                        <button role="button" class="btn btn-primary" type="submit">
                            Enviar convite
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-12 col-lg-4">
        <div class="mt-3 p-3 bg-light rounded shadow-sm border">
            {!! $project->description !!}
        </div> 

        <div class="mt-3 p-3 bg-light rounded shadow-sm border">
            <h5 class="font-weight-bold">Progresso</h5>
        
            <div class="progress">
                <div class="progress-bar bg-success" style="height:2px; width:{{ $project->progress($project->tasks_finished_count, $project->tasks_count) }}%;"></div>
            </div>
        </div>

        <div class="mt-3 p-3 bg-light rounded shadow-sm border">
            <h5 class="font-weight-bold">Membros</h5>
            
            <ul class="list-group">
                
            @forelse($project->members as $member)
            <li class="list-group-item p-1">
                <div class="media-body d-flex justify-content-between align-items-center">
                    
                    <h6 class="mb-0">{{ $member->name }}</h6>
                    
                    <div>
                        @foreach($member->role as $role)
                        <strong>{{ $role->name }}</strong>
                        @endforeach
                    </div>

                    <div class="dropleft">
                        
                        <button class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i> </button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="">Editar</a>
                            <form action="" method="POST" class="">
                                @csrf
                                @method("DELETE")
                                <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            
            {{-- <div class="media align-items-center border-bottom">
                <div class="media-body d-flex justify-content-between align-items-center">
                    
                    <h6 class="mb-0">{{ $member->name }}</h6>
                    
                    <div>
                        @foreach($member->role as $role)
                        <strong>{{ $role->name }}</strong>
                        @endforeach
                    </div>

                    <div class="dropdown">
                        
                        <button class="btn btn-sm btn-secondary px-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i> </button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="">Editar</a>
                            <form action="" method="POST" class="">
                                @csrf
                                @method("DELETE")
                                <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            @empty
            @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

