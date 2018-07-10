@extends('layouts.app')

@section('content')
<div class="page-header">

    @include('projects.tasks.partials.menu')

    <div class="content-list" data-filter-list="content-list-body">
        <div class="row content-list-head">
            <div class="col-auto">
                <h3>Membros</h3>
            </div>
            <form class="col-md-auto">
                <div class="input-group input-group-round">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-filter"></i>
                        </span>
                    </div>
                    <input type="search" class="form-control filter-list-input" placeholder="Filter membros" aria-label="Filter membros" aria-describedby="filter-membros">
                </div>
            </form>
        </div>
        
        <div class="content-list-body">
		    <div class="card-list">
		        <div class="card-list-body">
					<ul class="list-group ">
						@forelse($task->project->members as $member)
		            	<li class="list-group-item" data-t="null" data-i="null" data-l="null" data-e="null">
			                <div class="media align-items-center">
			                    <img alt="{{ $member->name }}" src="{{ asset($member->image) }}" class="avatar avatar-lg">
			                    <div class="media-body d-flex justify-content-between align-items-center">
			                        
			                        <div>
			                        	<h6 class="mb-0">{{ $member->name }}</h6>
			                        	<small>{{ $member->email }}</small>
			                        </div>
			                        @if($task->members->contains($member->id))
                                    <form action="{{ route('projects.tasks.members.dettach', [$task->project, $task, $member->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger confirmation">Remover</button>
                                    </form>
                                    @else
                                    <form action="{{ route('projects.tasks.members.attach', [$task->project, $task, $member->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success confirmation">Adicionar</button>
                                    </form>
                                    @endif
			                    </div>
			                </div>
			            </li>
			            @empty
			            @endforelse
			        </ul>
		        </div>
		    </div>
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
@endsection