@extends('layouts.app')

@section('content')
<div class="mt-3">
    

@include('layouts.partials.menu')
@include('layouts.partials.tasks')
</div>
@endsection

@section('sidebar')
<button class="btn btn-primary btn-round btn-floating btn-lg d-lg-none" type="button" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="false" aria-controls="sidebar-floating-chat">
    <i class="material-icons">more_horiz</i>
    <i class="material-icons">close</i>
</button>
<div class="sidebar collapse p-3" id="sidebar-collapse">
    <div class="sidebar-content">
        @include('layouts.partials.project')
    </div>
</div>
@endsection