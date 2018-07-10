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
@endsection