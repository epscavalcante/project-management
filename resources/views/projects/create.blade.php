@extends('layouts.app')

@section('content')
<div class="page-header pt-3">
	<h2>Novo projeto ☕</h2>
</div>
<hr>
<form action="{{ route('projects.store') }}" method="POST">
	@csrf
	
	@include('projects.partials.form')

</form>
@endsection