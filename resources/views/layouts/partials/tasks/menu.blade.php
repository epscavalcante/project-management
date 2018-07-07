<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link {{ Nav::isRoute('projects.tasks.show') }}" href="{{ route('projects.tasks.show', [$task->project->code, $task->code]) }}">Detalhes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Nav::hasSegment('membros', 3) }}" href="{{ route('projects.members', $task->code) }}">Membros</a>
    </li>
</ul>