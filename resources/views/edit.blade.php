@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="mt-3 p-3 bg-light rounded shadow-sm border">
			<h2 class="border-bottom pb-2 mb-2"> Editar projeto ☕</h2>

			<form action="{{ route('projects.update', $project) }}" method="POST">
				@csrf
				@method("PUT")
				
				@include('components.project.form')
			</form>
		</div>
	</div>
@endsection