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
    </style>
@endsection


@inject('o_accion_user', 'App\Models\AccionUser')

@section('nom_empresa')
    {{ $o_empresa::first()->name }}
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EVENTOS DE SEGURIDAD
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Fecha: </strong>{{ $notificacion_user->fecha }}</p>
                                    <p><strong>Hora: </strong>{{ $notificacion_user->hora }}</p>
                                    <p><strong>Descripción: </strong>{{ $notificacion_user->descripcion }}</p>
                                    <p><strong>Tipo Evento: </strong>{{ $notificacion_user->tipo }}</p>
                                </div>
                                <div class="col-3">
                                    <a href="{{route('eventos_seguridads.index')}}" class="btn btn-default">Volver</a>
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
