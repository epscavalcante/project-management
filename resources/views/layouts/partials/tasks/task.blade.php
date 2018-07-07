<div class="page-header">
    <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center">
        <h2> {{ $task->name }}</h2>   

        <span class="text-muted">
            Tarefa #{{ $task->code }}
        </span>
    </div>
    

    <p class="lead">{{ $task->description }}</p>
    
    <div class="d-flex align-items-center justify-content-between">
        <ul class="avatars">
            @foreach($task->members as $member)
            <li>
                <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                    <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                </a>
            </li>
            @endforeach
            
        </ul>

        {{-- <div class="btn-group" role="group" aria-label="Editar ou Excluir projeto">
            <a href="{{ route('projects.edit', $project->code) }}" class="btn btn-sm btn-secondary">Editar</a>
            <form action="{{ route('projects.destroy', $project->code) }}" method="POST" class="d-inline">
                @csrf
                @method("DELETE")
                <button class="btn btn-sm btn-danger confirmation" type="submit">Excluir</button>
            </form> 
            </div>
        --}}
    </div>
    
    
    <div>
        <div class="progress">
            <div class="progress-bar bg-success" style="width:25%;"></div>
        </div>
        <div class="d-flex justify-content-between text-small">
            <div class="d-flex align-items-center">
                <i class="material-icons">playlist_add_check</i>
                <span>3/12</span>
            </div>
            <span>Due 9 days</span>
        </div>
    </div>
</div>

@include('layouts.partials.tasks.menu')


