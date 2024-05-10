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
                                GESTIÓN DE USUARIOS Y ROLES
                            </h2>
                        </div>
                        <div class="body">
                            <div class="panel-group" id="accordion_2" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-success">
                                    <div class="panel-heading" role="tab" id="headingOne_2">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion_2"
                                                href="#collapseOne_2" aria-expanded="false" aria-controls="collapseOne_2"
                                                class="collapsed">
                                                ADMINISTRADORES
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_2" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingOne_2" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <ol>
                                                @foreach ($administradores as $item)
                                                    {{-- @php
                                                    $o_modulo::getMenuUsuario($item);
                                                @endphp --}}
                                                    <li>
                                                        {{ $item->full_name }} <button
                                                            class="btn bg-warning btn-circle waves-effect waves-circle waves-float"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapse{{ $item->id }}" aria-expanded="true"
                                                            aria-controls="collapse{{ $item->id }}">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>

                                                        <div class="collapse" id="collapse{{ $item->id }}"
                                                            aria-expanded="true" style="">
                                                            <ul class="list-group group_user">
                                                                @foreach ($item->user_modulos as $value)
                                                                    @if ($value->modulo->url != 'reportes' && $value->modulo->url != 'eventos_setguridads')
                                                                        <li class="list-group-item modulos">
                                                                            {{ $value->modulo->titulo }}
                                                                            <div class="acciones">
                                                                                Permisos:&nbsp;&nbsp;
                                                                                <span>
                                                                                    <input type="checkbox"
                                                                                        class="check_permiso"
                                                                                        data-user="{{ $item->id }}"
                                                                                        data-usermodulo="{{ $value->id }}"
                                                                                        data-opcion="crear"
                                                                                        data-value="{{ $value->crear }}"
                                                                                        id="CR{{ $item->id . $value->id }}"
                                                                                        class="filled-in"
                                                                                        {{ $value->crear == 1 ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="CR{{ $item->id . $value->id }}">Crear</label>

                                                                                </span>
                                                                                <span>
                                                                                    <input type="checkbox"
                                                                                        class="check_permiso"
                                                                                        data-user="{{ $item->id }}"
                                                                                        data-usermodulo="{{ $value->id }}"
                                                                                        data-opcion="editar"
                                                                                        data-value="{{ $value->editar }}"
                                                                                        id="ED{{ $item->id . $value->id }}"
                                                                                        class="filled-in"
                                                                                        {{ $value->editar == 1 ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="ED{{ $item->id . $value->id }}">Editar</label>

                                                                                </span>
                                                                                <span>
                                                                                    <input type="checkbox"
                                                                                        class="check_permiso"
                                                                                        data-user="{{ $item->id }}"
                                                                                        data-usermodulo="{{ $value->id }}"
                                                                                        data-opcion="eliminar"
                                                                                        data-value="{{ $value->eliminar }}"
                                                                                        id="EL{{ $item->id . $value->id }}"
                                                                                        class="filled-in"
                                                                                        {{ $value->eliminar == 1 ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="EL{{ $item->id . $value->id }}">Eliminar</label>

                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-success">
                                    <div class="panel-heading" role="tab" id="headingTwo_2">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion_2" href="#collapseTwo_2" aria-expanded="false"
                                                aria-controls="collapseTwo_2">
                                                ALMACENEROS
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo_2" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingTwo_2" aria-expanded="false">
                                        <div class="panel-body">
                                            <ol>
                                                @foreach ($almaceneros as $item)
                                                    {{-- @php
                                                    $o_modulo::getMenuUsuario($item);
                                                @endphp --}}
                                                    <li>
                                                        {{ $item->full_name }} <button
                                                            class="btn bg-warning btn-circle waves-effect waves-circle waves-float"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapse{{ $item->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ $item->id }}">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>

                                                        <div class="collapse" id="collapse{{ $item->id }}"
                                                            aria-expanded="true" style="">
                                                            <ul class="list-group group_user">
                                                                @foreach ($item->user_modulos as $value)
                                                                    @if ($value->modulo->url != 'reportes' && $value->modulo->url != 'eventos_setguridads')
                                                                        <li class="list-group-item modulos">
                                                                            {{ $value->modulo->titulo }}
                                                                            <div class="acciones">
                                                                                Permisos:&nbsp;&nbsp;
                                                                                <span>
                                                                                    <input type="checkbox"
                                                                                        class="check_permiso"
                                                                                        data-user="{{ $item->id }}"
                                                                                        data-usermodulo="{{ $value->id }}"
                                                                                        data-opcion="crear"
                                                                                        data-value="{{ $value->crear }}"
                                                                                        id="CR{{ $item->id . $value->id }}"
                                                                                        class="filled-in"
                                                                                        {{ $value->crear == 1 ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="CR{{ $item->id . $value->id }}">Crear</label>

                                                                                </span>
                                                                                <span>
                                                                                    <input type="checkbox"
                                                                                        class="check_permiso"
                                                                                        data-user="{{ $item->id }}"
                                                                                        data-usermodulo="{{ $value->id }}"
                                                                                        data-opcion="editar"
                                                                                        data-value="{{ $value->editar }}"
                                                                                        id="ED{{ $item->id . $value->id }}"
                                                                                        class="filled-in"
                                                                                        {{ $value->editar == 1 ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="ED{{ $item->id . $value->id }}">Editar</label>

                                                                                </span>
                                                                                <span>
                                                                                    <input type="checkbox"
                                                                                        class="check_permiso"
                                                                                        data-user="{{ $item->id }}"
                                                                                        data-usermodulo="{{ $value->id }}"
                                                                                        data-opcion="eliminar"
                                                                                        data-value="{{ $value->eliminar }}"
                                                                                        id="EL{{ $item->id . $value->id }}"
                                                                                        class="filled-in"
                                                                                        {{ $value->eliminar == 1 ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="EL{{ $item->id . $value->id }}">Eliminar</label>

                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
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
            $(document).on("click", ".check_permiso", function() {
                if (!$(this).attr("disabled")) {
                    $(this).prop("disabled", true)
                    let self = $(this);
                    let user_id = $(this).data("user");
                    let usermodulo = $(this).data("usermodulo");
                    let opcion = $(this).data("opcion");
                    let value = $(this).data("value");
                    let valor = value == 1 ? 0 : 1;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "POST",
                        url: "{{ route('usuarios_roles.update') }}",
                        data: {
                            _method: "PUT",
                            user_modulo_id: usermodulo,
                            valor: valor,
                            col: opcion
                        },
                        dataType: "json",
                        success: function(response) {
                            showNotification('alert-success',
                                response.message,
                                'top', 'center', 'animated bounceInTop',
                                'animated bounceOutLeft');
                            self.data("value", response.user_modulo[opcion])
                            setTimeout(() => {
                                self.removeAttr("disabled");
                            }, 200);
                        },
                        error: function(err) {
                            self.prop("checked", value == 1 ? true : false)
                            self.removeAttr("disabled");
                            showNotification('alert-warning',
                                'No se pudo actualizar debido a un error interno',
                                'top', 'center', 'animated bounceInTop',
                                'animated bounceOutLeft');

                            console.log(err)
                        }
                    });
                }

            })
        });
    </script>
@endsection
