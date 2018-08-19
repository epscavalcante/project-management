<div class="form-group row align-items-center">
    <label class="col-3">Tipo da tarefa</label>
    
    <select name="task_type_id" id="" class="custom-select col" required>
        @foreach($task_types as $type)
        <option value="{{ $type->id }}" {{ ($type->id == old('task_type_id')) ? 'selected' : '' }}> {{ $type->name }}</option>
        @endforeach
    </select>

    @if ($errors->has('task_type_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('task_type_id') }}</strong>
        </span>
    @endif
</div>
<div class="form-group row">
    <label class="col-3">Descrição</label>

    <textarea name="description" placeholder="Descreva o conteúdo" class="form-control col" rows="10" required>{{ old('description') }}</textarea>
    	{{ $task->description ?? old("description") }}
    </textarea>
    @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

<div class="alert alert-warning text-small" role="alert">
    <span> <i class="fas fa-exclamation-triangle"></i> Não se preocupe, isso pode ser alterado em qualquer momento.</span>
</div>

<button role="button" class="btn btn-primary" type="submit">Salvar</button>