<li class="{{ request()->is('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}">
        <i class="material-icons">home</i>
        <span>Inicio</span>
    </a>
</li>

@inject('o_modulo', 'App\Models\Modulo')

@php
    $user_modulos = $o_modulo::getMenuUsuario(Auth::user());
@endphp

@foreach ($user_modulos as $um)
    @if ($um->modulo->url != 'ingresos' && $um->modulo->url != 'salidas' && $um->modulo->url != 'tipo_ingreso_salida')
        <li class="{{ request()->is($um->modulo->url . '*') ? 'active' : '' }}">
            <a href="{{ route($um->modulo->slug) }}">
                <i class="material-icons">{{ $um->modulo->icon }}</i>
                <span>{{ $um->modulo->titulo }}</span>
            </a>
        </li>
    @endif
@endforeach
