<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link {{ Nav::isRoute('projects.show') }}" href="{{ route('projects.show', $project->code) }}">Detalhes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Nav::hasSegment('tarefas', 3) }}" href="{{ route('projects.tasks', $project->code) }}">Tarefas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Nav::hasSegment('membros', 3) }}" href="{{ route('projects.members', $project->code) }}">Membros</a>
    </li>
</ul>