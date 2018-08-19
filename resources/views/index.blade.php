@extends('layouts.app')

@section('content')
<div class="container">
    
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project) }}">
            <div class="mt-3 p-3 bg-light rounded shadow-sm border">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-block w-75">
                        <h4 class="mb-0"> {{ $project->name }}</h4>
                        <p class="text-truncate mb-0">{!! $project->description !!}</p> 
                    </div>

                    <i class="fas fa-chevron-right fa-2x"></i>
                </div>
            </div>
        </a>
        @endforeach
</div>
@endsection
