@extends('layouts.app')

@section('content')
<div class="page-header pt-3">
	<h2>Editar projeto ☕</h2>
</div>
<hr>
<form action="{{ route('projects.update', $project) }}" method="POST">
	@csrf
	@method("PUT")
	
	@include('projects.partials.form')

	
</form>
@endsection