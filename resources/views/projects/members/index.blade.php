@extends('layouts.app')

@section('content')
@include('layouts.partials.projects.project')

<form class="tab-content" action="{{ route('projects.members.sync', $project->code) }}" method="POST">
@csrf
@method("PUT")
    <div class="tab-pane active show fade" id="members" role="tabpanel" aria-labelledby="members-tab" data-filter-list="list-group-members">
        
    	<div class="input-group input-group-round">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-filter"></i>
                </span>
            </div>
            <input type="search" class="form-control filter-list-input" placeholder="Buscar membro" aria-label="Filter Members" aria-describedby="filter-members">
        </div>
        <div class="form-group-users">
            @foreach($users as $user)
            @if($user->id != auth()->user()->id)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="user-{{ $user->id }}" {{ $project->members->contains($user->id) ? 'checked' : '' }} name="members[]" value="{{ $user->id }}">
                <label class="custom-control-label" for="user-{{ $user->id }}">
                    <div class="d-flex align-items-center">
                        <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
                        <span class="h6 mb-0" data-filter-by="text">{{ $user->name }}</span>
                    </div>
                </label>
            </div>
            @endif
            @endforeach
        </div>
		
		<br>

        <div class="form-group">
        	<button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </div>
</form>
@endsection