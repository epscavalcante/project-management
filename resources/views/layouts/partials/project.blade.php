<div class="page-header">
    <div class="d-flex justify-content-between flex-column flex-sm-row">
        <h2>{{ $project->name }}</h2>   
        <div class="d-flex align-items-center">
            <a href="{{ route('projects.edit', $project->code) }}" class="btn btn-round btn-primary">
                <i class="material-icons">edit</i>
            </a>
            <form action="{{ route('projects.destroy', $project->code) }}" method="POST" class="d-inline">
                @csrf
                @method("DELETE")
                <button class="btn btn-danger btn-round  confirmation" type="submit">
                    <i class="material-icons">delete</i>
                </button>
            </form>
        </div>
    </div>

    <p class="lead">{{ $project->description }}</p>

    <div class="small">
        Timeline: {{ $project->start }} - {{ $project->end }}
        {{-- <br>
        Criado em: {{ $project->created_at }}
        <br>
        Última atualização: {{ $project->updated_at }} --}}
    </div>
    
    <ul class="avatars my-2">
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Gerente - {{ $project->owner->name }}">
                <img alt="{{ $project->owner->name }}" class="avatar" src="{{ asset($project->owner->image) }}">
            </a>
        </li>
        @foreach($project->members as $member)
        <li>
            <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $member->name }} - membro">
                <img alt="{{ $member->name }}" class="avatar" src="{{ asset($member->image) }}">
            </a>
        </li>
        @endforeach
    </ul>

    <button class="btn btn-round d-inline-block" data-toggle="modal" data-target="#user-manage-modal">
        <i class="material-icons">add</i>
    </button>

</div>
<form class="modal fade" id="user-manage-modal" tabindex="-1" role="dialog" aria-labelledby="user-manage-modal" aria-hidden="true" action="{{ route('projects.members', $project->code) }}" method="POST">
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
</form>