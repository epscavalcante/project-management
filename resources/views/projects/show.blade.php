@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>{{ $project->name }}</h1>   
	<p class="lead">{{ $project->description }}</p>

    <div class="d-flex flex-column flex-sm-row justify-content-between small">
        <span>Responsável principal: {{ $project->owner->name }}</span>
        <span>Criado em: {{ $project->created_at }}</span>
        <span>Última atualização: {{ $project->updated_at }}</span>
    </div>
</div>

<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('projects.tasks', $project->code) }}">Tarefas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{-- route('projects.tasks', $project->code) --}}">Membros</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{-- {{ route('projects.activities') }} --}}" role="tab" aria-controls="activity" aria-selected="false">Atualizações</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{-- route('projects.tasks', $project->code) --}}">Editar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{-- {{ route('projects.activities') }} --}}" role="tab" aria-controls="activity" aria-selected="false">Excluir</a>
    </li>
</ul>
@endsection