@extends('layouts.app')

@section('title')
{{ $project->name }}
@endsection

@section('content')

<section class="card mb-4">
    <div class="card-header d-flex justify-content-between flex-sm-row flex-column align-items-center">
        <h3>{{ $project->name }}</h3>
        
        <div class="dropdown">
            <button class="btn btn-secondary px-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i> </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('projects.edit', $project) }}">Editar</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="">
                    @csrf
                    @method("DELETE")
                    <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        
        <h6 class="font-weight-bold">Progresso: </h6>
        
        <div class="progress mb-3">
            <div class="progress-bar bg-success" style="height:2px; width:{{ $project->progress($project->tasks_finished_count, $project->tasks_count) }}%;"></div>
        </div>

        <h6 class="font-weight-bold">Descrição:</h6>
        
        {!! $project->description !!}

        <hr>

        <ul class="nav nav-pills nav-fill">
          <li class="nav-item">
            <a class="nav-link active" href="#">Descrição</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.tasks', $project) }}">Tarefas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.members', $project) }}">Membros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Atividades</a>
          </li>
        </ul>
        
    </div>
</section>

{{-- 

@if(auth()->user()->id == $project->owner_id)
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
@endif --}}

{{-- <div class="page-header">
    
    @include('projects.partials.menu')
    
    <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center">
        <div class="mb-2">
            <h2>{{ $project->name }}</h2>
            @if(auth()->user()->id == $project->owner_id)
            <div class="btn-group btn-group-sm" role="group" aria-label="Controle do projeto">
                <a class="btn btn-outline-primary" href="{{ route('projects.edit', $project) }}">Editar</a>
                <form action="{{ route('project.destroy', $project) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-sm btn-outline-danger confirmation" type="submit">Excluir</button>
                </form>
            </div>
            @endif
        </div>
        
        
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
    </div>

    <p class="lead"></p>
    
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
</div> --}}
@endsection

