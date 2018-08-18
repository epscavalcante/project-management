@extends('layouts.app')

@section('content')
<section class=" card mt-2 mt-lg-5">
    
    <div class="card-header d-flex justify-content-between">
        <h4>Projetos</h3>
        <form class="">
            <div class="input-group input-group-round">
                
                <input type="search" class="form-control filter-list-input" placeholder="Buscar projeto" aria-label="Buscar projeto" aria-describedby="buscar-projeto">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        @foreach($projects as $project)
            <div class="card">
                <div class="card-body p-2">
                    <a href="{{ route('projects.show', $project) }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class=""> {{ $project->name }}</h4>

                            <div class="progress w-50">
                              <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                            </div>
                        </div>
                        
                        {!! $project->description !!}

                    </a>
                </div>
            </div>
        @endforeach
        {{-- @foreach(auth()->user()->projects as $project)
        <div class="col-lg-6">
            <div class="card card-project">
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="card-body">
                    <div class="card-title">
                        <a href="{{ route('projects.show', $project) }}">
                            <h5 data-filter-by="text" class="H5-filter-by-text">{{ $project->name }}</h5>
                            <p>{{ $project->description }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach --}}
    </div>
</section>
@endsection
