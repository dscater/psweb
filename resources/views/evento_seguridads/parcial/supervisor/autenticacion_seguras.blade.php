<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Usuario</th>
            <th>Fecha y Hora</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($autenticacion_seguras as $item)
            <tr>
                <td><a href="{{ route('eventos_seguridads.show', $item->id) }}" class="btn btn-primary btn-xs rounded"><i
                            class=material-icons>remove_red_eye</i></a></td>
                <td>{{ $item->user->full_name }}</td>
                <td>{{ $item->fecha_hora }}</td>
                <td>{{ $item->descripcion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12 paginacion">
        {!! $autenticacion_seguras->links() !!}
    </div>
</div>
