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

        .paginacion a {
            color: black !important;
        }

        .paginacion span {
            color: rgb(114, 113, 113) !important;
        }
    </style>
@endsection


@inject('o_modulo', 'App\Models\Modulo')

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
                                RESPALDO Y RECUPERACIÓN
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table bordered tabla_recuperacion">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre Backup</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($respaldos_db as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nombre }}</td>
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{ $item->hora }}</td>
                                            <td class="accion">
                                                <button class="btn btn-primary" title="Cargar Backup"
                                                    data-id="{{ $item->id }}"
                                                    data-url="{{ route('respaldo_recuperacion.cargaRecuperacion', $item->id) }}"
                                                    data-nombre="{{ $item->nombre }}">
                                                    <i class="material-icons">cloud_upload</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 d-block paginacion text-center">
                                    {{ $respaldos_db->firstItem() }} - {{ $respaldos_db->lastItem() }} de
                                    {{ $respaldos_db->total() }}
                                    <br>
                                    {!! $respaldos_db->links() !!}
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
            $(".tabla_recuperacion").on("click", ".accion button", function() {
                let id = $(this).data("id");
                let url = $(this).data("url");
                let nombre = $(this).data("nombre");

                swal({
                    title: "Cargar Backup",
                    html: true,
                    text: `Esta seguro de cargar el backup:<br/> (${id}) - ${nombre}`,
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "##1f91f3",
                    confirmButtonText: "Si, estoy seguro(a)",
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: false
                }, function() {
                    $(".page-loader-wrapper").show();
                    $.ajax({
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            type: 'POST',
                            dataType: 'JSON',
                        })
                        .done(function(data) {
                            swal("Correcto", "El backup se cargo correctamente",
                                "success"
                            );
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        })
                        .fail(function() {
                            swal("Error", "Algo salió mal",
                                "error"
                            );
                            console.log("error");
                        })
                        .always(function() {
                            $(".page-loader-wrapper").hide();
                            console.log("complete");
                        });

                });
            })
        });
    </script>
@endsection
