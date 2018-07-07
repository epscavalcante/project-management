@extends("layouts.app")

@section('content')
<div class="mt-3">
	@include('layouts.partials.menu')

	<div class="page-header pt-3">
	    <div class="d-flex justify-content-between flex-column flex-sm-row">
	        <h1>{{ $task->name }}</h1>   
	        <div class="">
	            <a href="{{ route('projects.edit', $task->code) }}" class="btn btn-sm btn-primary">editar</a>
	            <form action="{{ route('projects.tasks.destroy', [$project->code, $task->code]) }}" method="POST" class="d-inline">
	                @csrf
	                @method("DELETE")
	                <button class="btn btn-sm btn-danger confirmation" type="submit">excluir</button>
	            </form>
	        </div>
	    </div>

	    <p class="lead">{{ $task->description }}</p>
	    
	    <ul class="avatars my-2">
	        @foreach($task->members as $member)
	        <li>
	            <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $member->name }} - membro">
	                <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
	            </a>
	        </li>
	        @endforeach
	    </ul>

	    <button class="btn btn-round d-inline-block" data-toggle="modal" data-target="#task-user-manage-modal">
	        <i class="material-icons">add</i>
	    </button>

	</div>	
</div>
<form class="modal fade" id="task-user-manage-modal" tabindex="-1" role="dialog" aria-labelledby="user-manage-modal" aria-hidden="true" action="#" method="POST">
@csrf
@method("PUT")
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Gerenciar usuários</h5>
            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
        </div>
        <!--end of modal head-->
        <div class="modal-body">
            <div class="users-manage" data-filter-list="form-group-users">
                <div class="mb-3">
                    <ul class="avatars text-center">

                        @foreach($task->members as $member)
                        <li>
                            <img alt="{{ $member->name }}" src="{{ asset($member->image) }}" class="avatar" data-toggle="tooltip" data-title="{{ $member->name }}">
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="input-group input-group-round">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">filter_list</i>
                        </span>
                    </div>
                    <input type="search" class="form-control filter-list-input" placeholder="Buscar membro" aria-label="Filter Members" aria-describedby="filter-members">
                </div>
                <div class="form-group-users filter-list-1530921809543">
                    @foreach($project->members as $user)
                    @if($user->id != auth()->user()->id)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="task-user-{{ $user->id }}" {{ $task->members->contains($user->id) ? 'checked' : '' }} name="members[]" value="{{ $user->id }}">
                        <label class="custom-control-label" for="task-user-{{ $user->id }}">
                            <div class="d-flex align-items-center">
                                <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
                                <span class="h6 mb-0" data-filter-by="text">{{ $user->name }}</span>
                            </div>
                        </label>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!--end of modal body-->
        <div class="modal-footer">
            <button role="button" class="btn btn-primary" type="submit">
                Finalizar
            </button>
        </div>
    </div>
</div>
</form>
@endsection

@section('sidebar')
<button class="btn btn-primary btn-round btn-floating btn-lg d-lg-none" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="false" aria-controls="sidebar-floating-chat">
    <i class="material-icons">more_horiz</i>
    <i class="material-icons">close</i>
</button>
<div class="sidebar collapse p-3" id="sidebar-collapse">
    <div class="sidebar-content">
        @include('layouts.partials.project')
    </div>
</div>
@endsection