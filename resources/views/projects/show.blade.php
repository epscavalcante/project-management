@extends('layouts.app')

@section('content')
<div class="page-header">
    
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

    <p class="lead">{{ $project->description }}</p>
    
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
@endsection

