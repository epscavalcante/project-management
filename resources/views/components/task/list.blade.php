<div class="mt-3 p-3 bg-light rounded shadow-sm border">
    <div class="d-flex justify-content-between border-bottom mb-3 pb-2">
        <h5 class="font-weight-bold mb-0">Tarefas </h5>

        <a href="{{ route('tasks.create', $project) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Nova tarefa</a>
    </div>
    
    <ul class="list-group">
        @foreach($project->tasks as $task)
        <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="">
        <li class="list-group-item">
            <h5 class="text-truncate">
                 {{ $task->description }}
            </h5>
            
            <span class="badge badge-success">
                {{ $task->status->name }}
            </span> 
            |
            {{ $task->type->name }}
            |
            Feita por: {{ $task->user->name }}
            
            <div class="float-right small text-muted">{{ $task->updated_at }}</div>
        </li>
        </a>
        @endforeach
    </ul>
</div>