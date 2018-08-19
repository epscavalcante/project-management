@extends('layouts.app')

@section('content')
<div class="container">
	<div class="mt-3 p-3 bg-light rounded shadow-sm border">
		<h2 class="border-bottom pb-2 mb-2"> Editar tarefa ☕</h2>

		<form action="{{ route('tasks.update', [$task->project, $task]) }}" method="POST">
			@csrf
			<input type="hidden" value="{{ $project->id }}" name="project_id">
    		<input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

			@include('components.task.form')

		</form>
	</div>
</div>
@endsection