<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link {{ Nav::hasSegment('tarefas', 3) }}" href="{{ route('projects.tasks', $project->code) }}">Tarefas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="false">Activity</a>
    </li>
</ul>