@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between flex-column flex-sm-row">
        <h1>{{ $task->name }}</h1>   
        <div class="">
            <a href="{{ route('projects.edit', $task->code) }}" class="btn btn-sm btn-primary">editar</a>
            <form action="{{ route('projects.destroy', $task->code) }}" method="POST" class="d-inline">
                @csrf
                @method("DELETE")
                <button class="btn btn-sm btn-danger confirmation" type="submit">excluir</button>
            </form>
        </div>
    </div>

    <p class="lead">{{ $task->description }}</p>

    <div class="small">
        Prazo: {{ $task->start }} - {{ $task->end }}
        <br>
        Criado em: {{ $task->created_at }}
        <br>
        Última atualização: {{ $task->updated_at }}
    </div>
    
    <ul class="avatars my-2">
        {{-- <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Gerente - {{ $project->owner->name }}">
                <img alt="{{ $project->owner->name }}" class="avatar" src="{{ asset($project->owner->image) }}">
            </a>
        </li> --}}
        @foreach($task->members as $member)
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $member->name }} - membro">
                <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
            </a>
        </li>
        @endforeach
    </ul>

    <button class="btn btn-round d-inline-block" data-toggle="modal" data-target="#user-manage-modal">
        <i class="material-icons">add</i>
    </button>

</div>
@endsection