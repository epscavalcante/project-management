@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>{{ $project->name }}</h1>   
	<p class="lead">{{ $project->description }}</p>
    <ul class="list-unstyled">
        <li class="list-unstyled-item font-weight-bold">Responsável principal: {{ $project->owner->name }}</li>
        <li class="list-unstyled-item">Criado em: {{ $project->created_at }}</li>
        <li class="list-unstyled-item">Última atualização: {{ $project->updated_at }}</li>
    </ul>
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
        <a class="nav-link" href="{{-- route('projects.tasks', $project->code) --}}">Excluir</a>
    </li>
</ul>
@endsection