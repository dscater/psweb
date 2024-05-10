@inject('o_empresa', 'App\Models\Empresa')

@extends('layouts.admin')

@section('css')
    <!-- Waves Effect Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link
        href="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <style>
        .group_user .modulos {
            display: flex;
            justify-content: space-between;
        }

        .group_user .modulos .acciones span {
            display: inline-flex;
            align-items: center;
            margin-right: 5px;
        }

        .debil {
            color: rgb(236, 95, 0);
        }

        .renovar {
            color: red;
        }

        .buena {
            color: blue;
        }

        .fuerte {
            color: green;
        }

        .sin_ver td {
            color: white;
            background: green;
        }
    </style>
@endsection


@inject('o_accion_user', 'App\Models\AccionUser')

@section('nom_empresa')
    {{ $o_empresa::first()->name }}
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-12">
                    <h4 class="text-center">
                        EVENTOS DE SEGURIDAD
                    </h4>
                </div>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            GESTIÓN DE USUARIOS Y ROLES
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha y Hora</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gestion_roles as $item)
                                                <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            AUTENTICACIÓN SEGURA
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha y Hora</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($autenticacion_seguras as $item)
                                                <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            AUTORIZACIÓN ADECUADA
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha y Hora</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($autorizacion_adecuadas as $item)
                                                <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            PREVENCIÓN DE ATAQUES
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha y Hora</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prevension_ataques as $item)
                                                <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            ALERTAS Y NOTIFICACIONES
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha y Hora</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alertas_notificaciones as $item)
                                                <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            ESCANEO DE VULNERABILIDADES
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
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
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            CAPACITACIÓN EN SEGURIDAD
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha y Hora</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($capacitacion_seguridads as $item)
                                                <tr class="{{ $item->visto == 0 ? 'sin_ver' : '' }}">
                                                    <td><a href="{{ route('eventos_seguridads.show', $item->id) }}"
                                                            class="btn btn-primary btn-xs rounded"><i
                                                                class=material-icons>remove_red_eye</i></a></td>
                                                    <td>{{ $item->fecha_hora }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Select Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/node-waves/waves.js') }}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script
        src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}">
    </script>
    <script
        src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}">
    </script>
    <script
        src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}">
    </script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/jszip.min.js') }}">
    </script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}">
    </script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}">
    </script>
    <script
        src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}">
    </script>
    <script
        src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}">
    </script>

    <!-- Custom Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/admin.js') }}"></script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/pages/ui/notifications.js') }}"></script>
    <script></script>
@endsection
