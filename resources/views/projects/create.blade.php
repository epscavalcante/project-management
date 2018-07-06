@extends('layouts.app')

@section('content')
<div class="page-header pt-3">
	<h2>Novo projeto ☕</h2>
</div>
<hr>
<form action="{{ route('projects.store') }}" method="POST">
	@csrf
	<div class="form-group row align-items-center">
	    <label class="col-3">Nome</label>
	    <input class="form-control col" type="text" placeholder="Nome do projeto" name="name" value="{{ old("name") }}" />
	    @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>
	<div class="form-group row">
	    <label class="col-3">Descrição</label>
	    <textarea class="form-control col" rows="3" placeholder="Descrição do projeto" name="description">{{ old("description") }}</textarea>
	    @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
	</div>
	<hr>
	<h6>Prazo</h6>
	<div class="form-group row align-items-center">
	    <label class="col-3">Início</label>
	    <input class="form-control col" type="date" placeholder="Início do projeto" name="start" value="{{ old("start") }}" />
	    @if ($errors->has('start'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('start') }}</strong>
            </span>
        @endif
	</div>
	<div class="form-group row align-items-center">
	    <label class="col-3">Término</label>
	    <input class="form-control col" type="date" placeholder="Término do projeto" name="end" value="{{ old("end") }}" />
	    @if ($errors->has('end'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('end') }}</strong>
            </span>
        @endif
	</div>
	<div class="alert alert-warning text-small" role="alert">
	    <span> <i class="fas fa-exclamation-triangle"></i> Não se preocupe, isso pode ser alterado em qualquer momento.</span>
	</div>
	
	<hr>
{{-- 
	<h6>Visibilidade</h6>
	<div class="form-group">
		<select name="visibility" id="visibility" class="custom-control custom-select">
			<option value="private">Somente eu e membros</option>
			<option value="public" selected="selected">Público</option>
		</select>
		@if ($errors->has('visibility'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('visibility') }}</strong>
            </span>
        @endif
	</div>

	<hr> --}}

	<div class="users-manage" data-filter-list="form-group-users">
	    <div class="input-group input-group-round">
	        <div class="input-group-prepend">
	            <span class="input-group-text">
	                <i class="material-icons">filter_list</i>
	            </span>
	        </div>
	        <input type="search" class="form-control filter-list-input" placeholder="Filter members" aria-label="Filter Members" aria-describedby="filter-members">
	    </div>
	    <div class="form-group-users filter-list-1530803579233">
	    	@foreach($users as $user)
	    	<div class="custom-control custom-checkbox">
	            <input type="checkbox" class="custom-control-input" id="{{ $user->id }}" {{ ($user->id == auth()->user()->id) ? 'checked readonly' : '' }} name="members[]" value="{{ $user->id }}">
	            <label class="custom-control-label" for="{{ $user->id }}">
	                <div class="d-flex align-items-center">
	                    <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
	                    <span class="h6 mb-0 SPAN-filter-by-text" data-filter-by="text">{{ $user->name }}</span>
	                </div>
	            </label>
	        </div>
	        @endforeach
	    </div>
	</div>

	<hr>

	<button role="button" class="btn btn-primary" type="submit">Criar projeto</button>
</form>
@endsection