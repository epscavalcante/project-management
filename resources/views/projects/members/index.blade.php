@extends('layouts.app')

@section('content')
<div class="page-header">
	@include('projects.partials.menu')	
	<div class="d-flex justify-content-between align-items-center content-list-head">
	    <div class="col">
	        <h3 class="d-inline">Membros</h3>
	        @if(auth()->user()->id == $project->owner_id)
	        <button class="btn btn-round" data-toggle="modal" data-target="#invite-user-modal">
	            <i class="fas fa-plus"></i>
	        </button>
	        @endif
	    </div>
	    <form class="">
	        <div class="input-group input-group-round">
	            <div class="input-group-prepend">
	                <span class="input-group-text">
	                    <i class="fas fa-filter"></i>
	                </span>
	            </div>
	            <input type="search" class="form-control filter-list-input" placeholder="Procurar membro" aria-label="Procurar membro" aria-describedby="procurar-membro">
	        </div>
	    </form>
	</div>
</div>

<div class="content-list-body">
    <div class="card-list">
        <div class="card-list-body">
			<ul class="list-group ">
				@forelse($project->members as $member)
            	<li class="list-group-item" data-t="null" data-i="null" data-l="null" data-e="null">
	                <div class="media align-items-center">
	                    <img alt="{{ $member->name }}" src="{{ asset($member->image) }}" class="avatar avatar-lg">
	                    <div class="media-body d-flex justify-content-between align-items-center">
	                        
	                        <div>
	                        	<h6 class="mb-0">{{ $member->name }}</h6>
	                        	<small>{{ $member->email }}</small>
	                        </div>
	                        @if(auth()->user()->id == $project->owner_id)
	                        <form action="{{ route('projects.members.destroy', [$project, $member]) }}" method="POST">
	                        	@csrf
	                        	@method("DELETE")
	                        	<button class="btn btn-sm btn-outline-danger confirmation">Remover</button>
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
@endif
@endsection