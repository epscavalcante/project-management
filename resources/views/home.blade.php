@extends('layouts.app')

@section('content')
<div class="content-list mt-5">
    <div class="row content-list-head">
        <div class="col-auto">
            <h3>Seus Projetos</h3>
            <a href="{{ route('projects.create') }}" class="btn btn-round"><i class="fas fa-plus"></i></a>
        </div>
        <form class="col-md-auto">
            <div class="input-group input-group-round">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-filter"></i>
                    </span>
                </div>
                <input type="search" class="form-control filter-list-input" placeholder="Buscar projeto" aria-label="Buscar projeto" aria-describedby="buscar-projeto">
            </div>
        </form>
    </div>
    <div class="content-list-body">
        <div class="row">
            @foreach(auth()->user()->myProjects as $project)
            <div class="col-lg-6">
                <div class="card card-project">
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $project->progress(count($project->tasksFinished), count($project->tasks)) }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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
            @endforeach
            @foreach(auth()->user()->projects as $project)
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
            @endforeach
        </div>
    </div>
</div>
@endsection
