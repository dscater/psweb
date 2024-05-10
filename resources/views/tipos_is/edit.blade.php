@extends('layouts.admin')

@section('css')
    <!-- Waves Effect Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <style type="text/css">
        div.form-group.contenedor_subir {
            position: relative;
        }

        #foto {
            max-width: 100%;
        }

        .subir {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: #f55d3e;
            color: #fff;
            border: 0px solid #fff;
            position: absolute;
            top: 0;
            width: 100%
        }

        .subir span {
            margin-left: 5px;
        }

        .subir:hover {
            cursor: pointer;
            color: #fff;
            background: #F44336;
        }

        .contenedor_foto {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .contenedor_subir .form-line.error {
            position: relative;
        }

        .contenedor_subir label.error {
            position: absolute;
            bottom: -40px;
        }
    </style>
@endsection

@section('nom_empresa')
    {{ $empresa->nom }}
@endsection

@inject('o_modulo', 'App\Models\Modulo')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 botones">
                    <a href="{{ route('tipo_ingreso_salida.index') }}" class="btn bg-deep-purple waves-effect"><i
                            class="material-icons">assignment_turned_in</i><span>Tipos ingresos/salidas</span></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 botones">
                    <a href="{{ route('productos.index') }}" class="btn btn-primary">
                        <i class="material-icons">local_offer</i>
                        <span>Ver productos</span>
                    </a>
                </div>
                {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 botones">
                <a href="{{ route('ventas.index') }}" class="btn btn-success">
                    <i class="material-icons">local_atm</i>
                    <span>Venta de productos</span>
                </a>
            </div> --}}
                @if ($o_modulo::canMod('ingresos', 'crear'))
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 botones">
                        <a href="{{ route('ingresos.create') }}" class="btn btn-info">
                            <i class="material-icons">local_shipping</i>
                            <span>Registrar ingresos</span>
                        </a>
                    </div>
                @endif
                @if ($o_modulo::canMod('salidas', 'crear'))
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 botones">
                        <a href="{{ route('salidas.create') }}" class="btn btn-warning">
                            <i class="material-icons">input</i>
                            <span>Registrar salidas</span>
                        </a>
                    </div>
                @endif
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CAMBIAR INFORMACIÓN</h2>
                            <small>Los campos con * son obligatorios.</small>
                        </div>
                        <div class="body">
                            {!! Form::model($tipo, [
                                'route' => ['tipo_ingreso_salida.update', $tipo->id],
                                'method' => 'put',
                                'files' => 'true',
                                'id' => 'form_validation',
                            ]) !!}
                            @include('tipos_is.forms.form')
                            <button class="btn btn-primary btn-lg waves-effect" type="submit"><i
                                    class="material-icons">save</i><span>GUARDAR</span></button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Select Plugin Js -->
    {{-- <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script> --}}

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery-steps/jquery.steps.js') }}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/node-waves/waves.js') }}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/admin.js') }}"></script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/pages/forms/form-validation.js') }}"></script>

    <script src="{{ asset('AdminBSBMaterialDesign-master/js/pages/ui/notifications.js') }}"></script>
    <script type="text/javascript">
        @if (session('success'))
            showNotification('alert-success', 'REGISTRO ÉXITOSO!!! ', 'top', 'right', 'animated bounceInRight',
                'animated bounceOutRight');
            // showSuccessMessage('Registro éxitoso','');
        @endif

        $('body').on('change', '#foto', function(e) {
            addImage(e);
        });

        function addImage(e) {
            var file = e.target.files[0],
                imageType = /image.*/;

            if (!file.type.match(imageType))
                return;

            var reader = new FileReader();
            reader.onload = fileOnload;
            reader.readAsDataURL(file);
        }

        function fileOnload(e) {
            var result = e.target.result;
            $('#imagen_select').attr("src", result);
        }
    </script>
@endsection
