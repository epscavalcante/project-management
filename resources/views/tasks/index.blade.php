@extends("layouts.app")

@section('title')
Tarefas -
@endsection

@section('content')
<div class="container">
	@include('components.task.list')
</div>
@endsection