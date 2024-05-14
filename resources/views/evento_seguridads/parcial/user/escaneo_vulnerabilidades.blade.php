<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Fecha y Hora</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($escaneo_vulnerabilidades as $item)
            <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                <td><a href="{{ route('eventos_seguridads.show', $item->id) }}" class="btn btn-primary btn-xs rounded"><i
                            class=material-icons>remove_red_eye</i></a></td>
                <td>{{ $item->fecha_hora }}</td>
                <td>{{ $item->descripcion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12 paginacion">
        {!! $escaneo_vulnerabilidades->links() !!}
    </div>
</div>
