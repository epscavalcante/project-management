@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    @include('profile.menu')
    <div class="col-xl-8 col-lg-9">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group row align-items-center">
                        <label class="col-3">Senha atual</label>
                        <div class="col">
                            <input type="password" placeholder="Digite sua senha atual" name="password-current" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-3">Nova senha</label>
                        <div class="col">
                            <input type="password" placeholder="Nova senha" name="password-new" class="form-control">
                            <small class="small text-muted">A senha deve ter no mínimo 8 caracteres.</small>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-3">Confirmar senha</label>
                        <div class="col">
                            <input type="password" placeholder="Confirme a nova senha" name="password-new-confirm" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Alterar senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection