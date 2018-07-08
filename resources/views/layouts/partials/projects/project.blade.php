@section('config')
<div class="dropdown">
    <button class="btn btn-round" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('projects.edit', $project->code) }}" class="dropdown-item">Editar</a>
        <form action="{{ route('projects.destroy', $project->code) }}" method="POST">
            @csrf
            @method("DELETE")
            <button class="dropdown-item confirmation" type="submit">Arquivar</button>
        </form>
        <div class="dropdown-divider"></div>

        <form action="{{ route('projects.destroy', $project->code) }}" method="POST">
            @csrf
            @method("DELETE")
            <button class="dropdown-item text-danger confirmation" type="submit">Excluir</button>
        </form>
    </div>
</div>
@endsection

<div class="page-header">
    <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center">
        <h2> {{ $project->name }}</h2>   

        <span class="text-muted">
            Projeto #{{ $project->code }}
        </span>
    </div>
    

    <p class="lead">{{ $project->description }}</p>
    
    <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row">
        <ul class="avatars">
            <li>
                <a href="#" data-toggle="tooltip" title="{{ $project->owner->name }}">
                    <img alt="{{ $project->owner->name }}" class="avatar" src="{{ asset($project->owner->image) }}">
                </a>
            </li>                      
            @foreach($project->members as $member)
            <li>
                <a href="#" data-toggle="tooltip" title="{{ $member->name }}">
                    <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
                </a>
            </li>
            @endforeach
            
        </ul>

        <div class="btn-group" role="group" aria-label="Editar ou Excluir projeto">
            
        </div>
    </div>
    
    
    <div>
        <div class="progress">
            <div class="progress-bar bg-success" style="width:{{ $project->progress($project->tasks_finished_count, $project->tasks_count) }}%;"></div>
        </div>
        <div class="d-flex justify-content-between small">
            <span data-toggle="tooltip" title="Início em {{ $project->start }}">
                <i class="fas fa-flag"></i>
            </span>

            <div>
                <i class="fas fa-tasks"></i> 
                {{ $project->tasks_finished_count }} / {{ $project->tasks_count }}</span>
            </div>
                
            <span data-toggle="tooltip" title="Término em {{ $project->end }}">
                <i class="fas fa-trophy"></i>
            </span>
        </div>
    </div>
</div>

@include('layouts.partials.projects.menu')
