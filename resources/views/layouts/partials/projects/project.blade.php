<div class="page-header">
    <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center">
        <h2> {{ $project->name }}</h2>   

        <span class="text-muted">
            Projeto #{{ $project->code }}
        </span>
    </div>
    

    <p class="lead">{{ $project->description }}</p>
    
    <div class="d-flex align-items-center justify-content-between">
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
            <a href="{{ route('projects.edit', $project->code) }}" class="btn btn-sm btn-secondary">Editar</a>
            <form action="{{ route('projects.destroy', $project->code) }}" method="POST" class="d-inline">
                @csrf
                @method("DELETE")
                <button class="btn btn-sm btn-danger confirmation" type="submit">Excluir</button>
            </form>
        </div>
    </div>
    
    
    <div>
        <div class="progress">
            <div class="progress-bar bg-success" style="width:{{ $project->progress($project->tasks_trashed_count, $project->tasks_count) }}%;"></div>
        </div>
        <div class="d-flex justify-content-between small">
            <span data-toggle="tooltip" title="Início em {{ $project->start }}">
                <i class="fas fa-flag"></i>
            </span>

            <div>
                <i class="fas fa-tasks"></i> 
                {{ $project->tasks_trashed_count }} / {{ $project->tasks_count }}</span>
            </div>
                
            <span data-toggle="tooltip" title="Término em {{ $project->start }}">
                <i class="fas fa-trophy"></i>
            </span>
        </div>
    </div>
</div>

@include('layouts.partials.projects.menu')

{{-- <form class="modal fade" id="user-manage-modal" tabindex="-1" role="dialog" aria-labelledby="user-manage-modal" aria-hidden="true" action="{{ route('projects.members', $project->code) }}" method="POST">
@csrf
@method("PUT")
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Gerenciar usuários</h5>
            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
        </div>
        <!--end of modal head-->
        <div class="modal-body">
            <div class="users-manage" data-filter-list="form-group-users">
                <div class="mb-3">
                    <ul class="avatars text-center">

                        @foreach($project->members as $member)
                        <li>
                            <img alt="{{ $member->name }}" src="{{ asset($member->image) }}" class="avatar" data-toggle="tooltip" data-title="{{ $member->name }}">
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="input-group input-group-round">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">filter_list</i>
                        </span>
                    </div>
                    <input type="search" class="form-control filter-list-input" placeholder="Buscar membro" aria-label="Filter Members" aria-describedby="filter-members">
                </div>
                <div class="form-group-users filter-list-1530921809543">
                    @foreach($users as $user)
                    @if($user->id != auth()->user()->id)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="user-{{ $user->id }}" {{ $project->members->contains($user->id) ? 'checked' : '' }} name="members[]" value="{{ $user->id }}">
                        <label class="custom-control-label" for="user-{{ $user->id }}">
                            <div class="d-flex align-items-center">
                                <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
                                <span class="h6 mb-0" data-filter-by="text">{{ $user->name }}</span>
                            </div>
                        </label>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!--end of modal body-->
        <div class="modal-footer">
            <button role="button" class="btn btn-primary" type="submit">
                Finalizar
            </button>
        </div>
    </div>
</div>
</form> --}}