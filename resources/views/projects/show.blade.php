@extends('layouts.app')

@section('content')

@include('layouts.partials.project')

<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="true">Tasks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Files</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="false">Activity</a>
    </li>
</ul>

@include('layouts.partials.tasks')

@endsection

