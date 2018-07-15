@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    @include('profile.menu')
    <div class="col-xl-8 col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="media mb-4">
                    <img alt="Image" src="{{ asset(auth()->user()->image) }}" class="avatar avatar-lg">
                    <div class="media-body ml-3">
                        <div class="custom-file custom-file-naked d-block mb-1">
                            <input type="file" class="custom-file-input d-none" id="avatar-file">
                            <label class="custom-file-label position-relative" for="avatar-file">
                                <span class="btn btn-primary">
                                    Alterar imagem
                                </span>
                            </label>
                        </div>
                        <small>Formato .jpg ou .png com tamanho de 256px por 256px.</small>
                    </div>
                </div>
                <form>
                    <div class="form-group row align-items-center">
                        <label class="col-3">Nome</label>
                        <div class="col">
                            <input type="text" placeholder="Nome" value="{{ auth()->user()->name }}" name="name" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-3">E-mail</label>
                        <div class="col">
                            <input type="email" placeholder="E-mail" name="email" class="form-control" required="" value="{{ auth()->user()->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Bio</label>
                        <div class="col">
                            <textarea type="text" placeholder="Diga algo sobre você" name="description" class="form-control" rows="4"></textarea>
                            <small>Essa informação será exibida para outros usuários</small>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection