<div class="tab-content">
    <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab" data-filter-list="list-group-tasks">
        <div class="row content-list-head">
            <div class="col-auto">
                <h3>Tarefas</h3>
                <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
                    <i class="material-icons">add</i>
                </button>
            </div>
            <form class="col-md-auto">
                <div class="input-group input-group-round">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">filter_list</i>
                        </span>
                    </div>
                    <input type="search" class="form-control filter-list-input" placeholder="Procurar tarefa" aria-label="Procurar tarefa" aria-describedby="procurar-tarefa">
                </div>
            </form>
        </div>
        <!--end of content list head-->
        <div class="content-list-body">
            <div class="card-list">
                <div class="card-list-body filter-list-1530819204215">
                    @forelse($project->tasks as $task)
                    <div class="card card-task">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <a href="#">
                                    <h6 data-filter-by="text" class="H6-filter-by-text">Client objective meeting</h6>
                                </a>
                                <span class="text-small">Today</span>
                            </div>
                            <div class="card-meta">
                                <ul class="avatars">
                                    
                                    @foreach($project->tasks as $task)
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Kenny">
                                            <img alt="Kenny Tran" class="avatar" src="assets/img/avatar-male-6.jpg">
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                                <div class="d-flex align-items-center">
                                    <i class="material-icons">playlist_add_check</i>
                                    <span>3/4</span>
                                </div>
                                <div class="dropdown card-options">
                                    <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Mark as done</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#">Archive</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    Não há tarefas
                    @endforelse
                </div>
            </div>
        </div>
    </div>
                                
    <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab" data-filter-list="list-group-activity">
        <div class="content-list">
            <div class="row content-list-head">
                <div class="col-auto">
                    <h3>Activity</h3>
                </div>
                <form class="col-md-auto">
                    <div class="input-group input-group-round">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">filter_list</i>
                            </span>
                        </div>
                        <input type="search" class="form-control filter-list-input" placeholder="Filter activity" aria-label="Filter activity" aria-describedby="filter-tasks">
                    </div>
                </form>
            </div>
            <div class="content-list-body">
                <ol class="list-group list-group-activity filter-list-1530819204204">
                    <li class="list-group-item">
                        <div class="media align-items-center">
                            <ul class="avatars">
                                <li>
                                    <div class="avatar bg-primary">
                                        <i class="material-icons">playlist_add_check</i>
                                    </div>
                                </li>
                                <li>
                                    <img alt="Claire" src="assets/img/avatar-female-1.jpg" class="avatar filter-by-alt" data-filter-by="alt">
                                </li>
                            </ul>
                            <div class="media-body">
                                <div>
                                    <span class="h6 SPAN-filter-by-text" data-filter-by="text">Claire</span>
                                    <span data-filter-by="text" class="SPAN-filter-by-text">completed the task</span><a href="#" data-filter-by="text" class="A-filter-by-text">Set up client chat channel</a>
                                </div>
                                <span class="text-small SPAN-filter-by-text" data-filter-by="text">Just now</span>
                            </div>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


<form class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal" aria-hidden="true" action="{{ route('projects.tasks.store', $project->code) }}" method="POST">
    @csrf
    @method("POST")
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova tarefa</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <!--end of modal head-->
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a class="nav-link active" id="task-add-details-tab" data-toggle="tab" href="#task-add-details" role="tab" aria-controls="task-add-details" aria-selected="true">Detalhes da tarefa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="task-add-members-tab" data-toggle="tab" href="#task-add-members" role="tab" aria-controls="task-add-members" aria-selected="false">Membros nessa tarefa</a>
                </li>
            </ul>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="task-add-details" role="tabpanel" aria-labelledby="task-add-details-tab">
                        <h6>Detalhes</h6>
                        <div class="form-group row align-items-center">
                            <label class="col-3">Nome</label>
                            <input class="form-control col" type="text" placeholder="Task name" name="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Descrição</label>
                            <textarea class="form-control col" rows="3" placeholder="Task description" name="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <hr>

                        <h6>Período</h6>
                        <div class="form-group row align-items-center">
                            <label class="col-3">Início</label>
                            <input class="form-control col" type="date" placeholder="Task start" name="start">
                            @if ($errors->has('start'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-3">Término</label>
                            <input class="form-control col" type="date" placeholder="Task due" name="end">
                            @if ($errors->has('end'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('end') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="alert alert-warning text-small" role="alert">
                            <span>Poderá ser alterado posteriormente</span>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="task-add-members" role="tabpanel" aria-labelledby="task-add-members-tab">
                        <h6>Membros para essa tarefa</h6>

                        <div class="alert alert-warning">
                            <p>Se algum usuário não estiver na lista abaixo. Adicione ele ao projeto!</p>
                        </div>

                        <div class="users-manage" data-filter-list="form-group-users">
                            <div class="input-group input-group-round">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">filter_list</i>
                                    </span>
                                </div>
                                <input type="search" class="form-control filter-list-input" placeholder="Buscar usuário" aria-label="Buscar usuário" aria-describedby="buscar-usuario">
                            </div>
                            
                            <div class="form-group-users ">
                                @foreach($project->members as $user)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="user{{ $user->id }}" name="members[]" value="{{ $user->id }}">
                                    <label class="custom-control-label" for="user{{ $user->id }}">
                                        <div class="d-flex align-items-center">
                                            <img alt="{{ $user->name }}" src="{{ asset($user->image) }}" class="avatar mr-2">
                                            <span class="h6 mb-0" data-filter-by="text">{{ $user->name }}</span>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary" type="submit">
                    Create Task
                </button>
            </div>
        </div>
    </div>
</form>