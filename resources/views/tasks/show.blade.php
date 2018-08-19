@extends("layouts.app")

@section('content')
<div class="container">
    <div class="mt-3 p-3 bg-light rounded shadow-sm border">
        
        <div class="d-flex justify-content-between">
            <h5 class="font-weight-bold">Projeto:: {{ $task->project->name }}</h5>

            <div class="t">
                @if($task->status->id == 1)
                <a href="#" class="btn btn-primary">Iniciar</a>
                @else
                @endif
                @if($task->user->id == auth()->user()->id)
                <a href="{{ route('tasks.edit', [$task->project, $task]) }}" class="btn btn-outline-dark">Editar</a>
                <a href="#" class="btn btn-outline-danger">Excluir</a>
                @endif
            </div>
            
            

        </div>

        Por: {{ $task->user->name }} em {{ $task->updated_at }} Tipo: {{ $task->type->name }} | Status: {{ $task->status->name }}
        <hr>
        {!! $task->description !!}
    </div>
    <div class="mt-3 p-3 bg-light rounded shadow-sm border">
        
        <div class="d-flex justify-content-between">
            <h5 class="font-weight-bold">Comentários</h5>
        </div>
    </div>
</div>
<form class="modal fade" id="task-edit-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal" aria-hidden="true" action="" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tarefa</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                
                

            </div>
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Criar tarefa
                </button>
            </div>
        </div>
    </div>
</form>
@endsection