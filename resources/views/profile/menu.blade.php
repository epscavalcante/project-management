<div class="col-lg-3 mb-3">
    <ul class="nav nav-tabs flex-lg-column">
        <li class="nav-item">
            <a class="nav-link {{ Nav::isRoute('profile') }}" href="{{ route('profile') }}">Meu perfil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Nav::isRoute('profile.password') }}" href="{{ route('profile.password') }}">Senha</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Nav::isRoute('profile.notification') }}" href="{{ route('profile.notification') }}">Notificações</a>
        </li>
    </ul>
</div>