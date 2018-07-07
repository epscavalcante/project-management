@extends('layouts.app')

@section('content')
<div class="page-header pt-3">
    <h2>Editar projeto ☕</h2>
</div>
<hr>
<form action="{{ route('projects.edit', $project->code) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="form-group row align-items-center">
        <label class="col-3">Nome</label>
        <input class="form-control col" type="text" placeholder="Nome do projeto" name="name" value="{{ old("name") ?? $project->name }}" />
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group row">
        <label class="col-3">Descrição</label>
        <textarea class="form-control col" rows="3" placeholder="Descrição do projeto" name="description">{{ old("description") ?? $project->description }}</textarea>
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
        <input class="form-control col" type="date" placeholder="Início do projeto" name="start" value="{{ old("start") ?? $project->start }}" />
        @if ($errors->has('start'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('start') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group row align-items-center">
        <label class="col-3">Término</label>
        <input class="form-control col" type="date" placeholder="Término do projeto" name="end" value="{{ old("end")?? $project->end }}" />
        @if ($errors->has('end'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('end') }}</strong>
            </span>
        @endif
    </div>
    <hr>
    <div class="form-group">
        <button role="button" class="btn btn-primary" type="submit">Editar projeto</button>    
    </div>
    
</form>
@endsection