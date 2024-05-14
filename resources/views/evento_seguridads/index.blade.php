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

        .paginacion a,
        .paginacion span {
            color: black;
        }

        .paginacion span {
            color: rgb(160, 160, 160);
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
                                <div class="col-md-12" id="gestion_roles">
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
                                <div class="col-md-12" id="autenticacion_seguras">
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
                                <div class="col-md-12" id="autorizacion_adecuadas">
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
                                <div class="col-md-12" id="prevension_ataques">

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
                                <div class="col-md-12" id="alertas_notificaciones">
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
                                <div class="col-md-12" id="escaneo_vulnerabilidades">
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
                                <div class="col-md-12" id="capacitacion_seguridads">
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
    <script>
        $(document).ready(function() {
            gestion_roles();
            autenticacion_seguras();
            autorizacion_adecuadas();
            prevension_ataques();
            alertas_notificaciones();
            escaneo_vulnerabilidades();
            capacitacion_seguridads();

            $("#gestion_roles").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                gestion_roles(array_url[1]);
            })
            $("#autenticacion_seguras").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                autenticacion_seguras(array_url[1]);
            })
            $("#autorizacion_adecuadas").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                autorizacion_adecuadas(array_url[1]);
            })
            $("#prevension_ataques").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                prevension_ataques(array_url[1]);
            })
            $("#alertas_notificaciones").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                alertas_notificaciones(array_url[1]);
            })
            $("#escaneo_vulnerabilidades").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                escaneo_vulnerabilidades(array_url[1]);
            })
            $("#capacitacion_seguridads").on("click", ".paginacion a", function(e) {
                e.preventDefault();
                let array_url = $(this).attr("href").split("=");
                capacitacion_seguridads(array_url[1]);
            })

        });

        function gestion_roles(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.gestion_roles') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#gestion_roles").html(response);
                }
            });
        }

        function autenticacion_seguras(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.autenticacion_seguras') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#autenticacion_seguras").html(response);
                }
            });
        }

        function autorizacion_adecuadas(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.autorizacion_adecuadas') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#autorizacion_adecuadas").html(response);
                }
            });
        }

        function prevension_ataques(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.prevension_ataques') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#prevension_ataques").html(response);
                }
            });
        }

        function alertas_notificaciones(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.alertas_notificaciones') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#alertas_notificaciones").html(response);
                }
            });
        }

        function escaneo_vulnerabilidades(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.escaneo_vulnerabilidades') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#escaneo_vulnerabilidades").html(response);
                }
            });
        }

        function capacitacion_seguridads(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.capacitacion_seguridads') }}",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    $("#capacitacion_seguridads").html(response);
                }
            });
        }
    </script>
@endsection
