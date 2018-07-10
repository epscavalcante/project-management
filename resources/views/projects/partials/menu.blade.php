<ul class="nav nav-tabs nav-fill mb-2">
    <li class="nav-item">
        <a class="nav-link {{ Nav::isRoute('projects.show') }}" href="{{ route('projects.show', $project) }}">Visão geral</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link {{ Nav::hasSegment('tarefas', 2) }}" href="{{ route('projects.tasks', $project) }}">Tarefas</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Members</a>
    </li>
</ul>
