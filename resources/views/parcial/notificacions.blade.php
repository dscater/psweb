@foreach ($notificacion_users as $nu)
    <li class="notificacion">
        <a href="{{ route('eventos_seguridads.show', $nu->id) }}" class=" waves-effect waves-block">
            <div class="icon-circle bg-light-green">
                <i class="material-icons">info</i>
            </div>
            <div class="menu-info">
                <p class="desc_notificacion {{ $nu->visto == 0 ? 'sin_ver' : '' }}">{{ $nu->descripcion }}</p>
                <p>
                    <i class="material-icons">access_time</i> {{ $nu->created_at->diffForHumans() }}
                </p>
            </div>
        </a>
    </li>
@endforeach
