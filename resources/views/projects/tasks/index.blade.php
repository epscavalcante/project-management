@extends('layouts.app')

@section('content')
<section class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        
        <h3>Tarefas</h3>

        <a href="#task-add-modal" data-toggle='modal' class="btn btn-primary"><i class="fas fa-plus"></i> Novo item</a>
                
    </div>
    <div class="card-body">
        
    </div>
</section>

<form class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal" aria-hidden="true" action="" method="POST">
    @csrf
    @method("POST")
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova tarefa</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                
                <

            </div>
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Criar tarefa
                </button>
            </div>
        </div>
    </div>
</form>

{{-- 
<div class="page-header">
	@include('projects.partials.menu')	
	<div class="d-flex justify-content-between align-items-center content-list-head">
	    <div class="col">
	        <h3 class="d-inline">Tarefas</h3>
	        <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
	            <i class="fas fa-plus"></i>
	        </button>
	    </div>
	    <form class="">
	        <div class="input-group input-group-round">
	            <div class="input-group-prepend">
	                <span class="input-group-text">
	                    <i class="fas fa-filter"></i>
	                </span>
	            </div>
	            <input type="search" class="form-control filter-list-input" placeholder="Procurar tarefa" aria-label="Procurar tarefa" aria-describedby="procurar-tarefa">
	        </div>
	    </form>
	</div>
</div>

<div class="content-list-body">
    <div class="card-list">
        <div class="card-list-body">

            @forelse($project->tasks as $task)
                
                @if(auth()->user()->id == $task->user_id || $task->members->contains(auth()->user()->id))
                <div class="card card-task">
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $task->progress(count($task->todosFinished), count($task->todos)) }}%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('projects.tasks.show', [$project, $task]) }}">
                                <h5 data-filter-by="text" class="mb-0">{{ $task->name }}</h5>
                                <p class="small text-muted">{{ $task->description }}</p>
                            </a>
                        </div>
                        <div class="card-meta d-flex justify-content-between">
                            <ul class="avatars">
                                
                                @foreach($task->members as $member)
                                <li>
                                    <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                                        <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                            
                            <div class="mr-2"><i class="fas fa-tasks"></i> {{ count($task->todosFinished) }} / {{ count($task->todos) }}</div>

                        </div>
                    </div>
                </div>
                @endif
            @empty
            Não há tarefas
            @endforelse
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
	        <h2>{{ $project->name }}</h2>
		    <p class="lead">{{ $project->description }}</p>
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
    </div>
</div> --}}
@endsection