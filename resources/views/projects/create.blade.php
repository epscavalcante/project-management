@extends('layouts.app')

@section('content')
<section class="card">
	<div class="card-header">
		<h2 class="font-weight-bold">Novo projeto ☕</h2>
	</div>

	<div class="card-body">
		<form action="{{ route('projects.store') }}" method="POST">
			@csrf
			
			@include('projects.partials.form')

		</form>
	</div>
</section>
@endsection