<ul class="nav nav-tabs nav-fill mb-2">
    <li class="nav-item">
        <a class="nav-link {{ Nav::isRoute('projects.tasks.show') }}" href="{{ route('projects.tasks.show', [$task->project, $task]) }}">Visão geral</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link {{ Nav::hasSegment('membros', 4) }}" href="{{ route('projects.tasks.members', [$task->project, $task]) }}">Membros</a>
    </li>
</ul>