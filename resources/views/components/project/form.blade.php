
@if(isset($project) and !empty($project))
<input type="hidden" value="{{ $project->id }}" name="id">
@endif
<div class="form-group">
    <label class="">Nome</label>
    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" placeholder="Nome do projeto" name="name" value="{{ old("name") ?? $project->name }}" />
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label class="">Descrição</label>
    <textarea class="form-control  {{ $errors->has('description ') ? 'is-invalid' : '' }}" rows="3" placeholder="Descrição do projeto" name="description">
    	{{ old("description") ?? $project->description }}
    </textarea>
    @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

{{-- <div class="form-group row align-items-center">
    <label class="col-3">Início</label>
    <input class="form-control col" type="date" placeholder="Início do projeto" name="start" value="{{ $project->start ?? old("start") }}" />
    @if ($errors->has('start'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('start') }}</strong>
        </span>
    @endif
</div>
<div class="form-group row align-items-center">
    <label class="col-3">Término</label>
    <input class="form-control col" type="date" placeholder="Término do projeto" name="end" value="{{ $project->end ?? old("end") }}" />
    @if ($errors->has('end'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('end') }}</strong>
        </span>
    @endif
</div> --}}
<div class="alert alert-warning text-small" role="alert">
    <span> <i class="fas fa-exclamation-triangle"></i> Não se preocupe, isso pode ser alterado em qualquer momento.</span>
</div>

<button role="button" class="btn btn-primary" type="submit">Salvar</button>