@extends('layouts.app')

@section('content')
<div class="page-header">
	<h2>Lixeira</h2>
</div>

<div class="content-list-body">
    <div class="card-list">
		<h5>Projetos</h5>
        <div class="card-list-body">
        	@foreach($projects as $project)
        	{{ $project->name }}
        	@endforeach
        </div>
    </div>
</div>

	<div class="col-md-6">
		<div class="content-list-head">
		    <div class="col-auto">
		        <h3>Tarefas</h3>
		    </div>
		</div>

		<div class="content-list-body">
		    <div class="card-list">
		        <div class="card-list-body filter-list-1530819204215">
		        </div>
		    </div>
		</div>
	</div>
</div>



@endsection