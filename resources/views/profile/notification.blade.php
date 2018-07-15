@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    @include('profile.menu')
    <div class="col-xl-8 col-lg-9">
        <div class="card">
            <div class="card-body">
                <form>
                    <h6>Notificações</h6>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-checkbox-switch">
                            <input type="checkbox" class="custom-control-input" id="notify-1" checked="">
                            <label class="custom-control-label" for="notify-1">Quando me adiconarem em algum projeto</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-checkbox-switch">
                            <input type="checkbox" class="custom-control-input" id="notify-2" checked="">
                            <label class="custom-control-label" for="notify-2">Quando me adiconarem em alguma tarefa</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-checkbox-switch">
                            <input type="checkbox" class="custom-control-input" id="notify-3" checked="">
                            <label class="custom-control-label" for="notify-3">Quando criarem tarefas nos meus projetos</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-checkbox-switch">
                            <input type="checkbox" class="custom-control-input" id="notify-3" checked="">
                            <label class="custom-control-label" for="notify-3">Quando me removerem de projetos</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-checkbox-switch">
                            <input type="checkbox" class="custom-control-input" id="notify-3" checked="">
                            <label class="custom-control-label" for="notify-3">Quando me removerem de tarefas</label>
                        </div>
                    </div>
                    
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar preferências</button>
                    </div>
                </form>
	        </div>
        </div>
    </div>
</div>
@endsection