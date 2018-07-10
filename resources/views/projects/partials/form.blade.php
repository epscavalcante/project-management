<div class="form-group row align-items-center">
    <label class="col-3">Nome</label>
    <input class="form-control col" type="text" placeholder="Nome do projeto" name="name" value="{{ $project->name ?? old("name") }}" />
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group row">
    <label class="col-3">Descrição</label>
    <textarea class="form-control col" rows="3" placeholder="Descrição do projeto" name="description">
    	{{ $project->description ?? old("description") }}
    </textarea>
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
</div>
<div class="alert alert-warning text-small" role="alert">
    <span> <i class="fas fa-exclamation-triangle"></i> Não se preocupe, isso pode ser alterado em qualquer momento.</span>
</div>

<hr>

<button role="button" class="btn btn-primary" type="submit">Salvar</button>