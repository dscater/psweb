<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>IVORFID</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ asset('google-fonts/roboto.css') }}">
    <link rel="stylesheet" href="{{ asset('google-fonts/material-icons.css') }}">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    @yield('css')

    <!-- Custom Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <style type="text/css">
        i.editar {
            color: #4E9F18;
        }

        i.eliminar {
            color: #E23949;
        }

        i.editar:hover {
            color: #52C008;
        }

        i.eliminar:hover {
            color: #FF0A22;
        }

        .invalid-feedback {
            color: red;
        }

        .botones a {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .bg-deep-purple:hover {
            color: white;
        }

        .contenedor_notificacions {
            max-width: 500px;
        }

        .contenedor_notificacions .body .slimScrollDiv .menu {
            overflow: auto !important;
        }


        .contenedor_notificacions .body .slimScrollDiv .menu li a {
            display: flex;
        }

        .contenedor_notificacions .body .slimScrollDiv .menu li a .icon-circle {
            width: 36px;
        }

        .contenedor_notificacions .body .slimScrollDiv .menu li a .menu-info {
            width: calc(100% - 66px) !important;
        }

        .contenedor_notificacions .body .slimScrollDiv .menu li a .menu-info .desc_notificacion {
            color: black;
        }

        .desc_notificacion {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .desc_notificacion.sin_ver {
            font-weight: bold;
            color: #4E9F18 !important;
        }
    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ route('home') }}">@yield('nom_empresa')</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="true">
                            <i class="material-icons">notifications</i>
                            <span class="label-count" id="countNotificaciones">0</span>
                        </a>
                        <ul class="dropdown-menu contenedor_notificacions">
                            <li class="header">EVENTOS DE SEGURIDAD</li>
                            <li class="body">
                                <div class="slimScrollDiv"
                                    style="position: relative; overflow: hidden; width: auto; height: 254px;">
                                    <ul class="menu" style="overflow: hidden; width: auto; height: 254px;"
                                        id="contenedor_notificacions">

                                    </ul>
                                    <div class="slimScrollBar"
                                        style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 0px; z-index: 99; right: 1px;">
                                    </div>
                                    <div class="slimScrollRail"
                                        style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                    </div>
                                </div>
                            </li>
                            <li class="footer">
                                <a href="{{ route('eventos_seguridads.index') }}" class=" waves-effect waves-block">Ver
                                    todos los eventos</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">power_settings_new</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('imgs/users/' . Auth::user()->foto) }}" width="55" height="55"
                        alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::user()->datosUsuario)
                            {{ Auth::user()->datosUsuario->nom_u }} {{ Auth::user()->datosUsuario->apep_u }}
                            {{ Auth::user()->datosUsuario->apem_u }}
                        @else
                            {{ Auth::user()->name }}
                        @endif
                    </div>
                    <div class="email">
                        {{ Auth::user()->tipo }}
                    </div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('users.config', Auth::user()->id) }}"><i
                                        class="material-icons">person</i>Perfil</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    <i class="material-icons">input</i>Salir
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    @include('includes.menu_admin')
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">IVORFID</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.6
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <input type="text" value="{{ asset('imgs') }}" id="url_imgs" hidden>
    <input type="text" value="{{ csrf_token() }}" id="token" hidden>
    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/jquery/jquery-3.2.1.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/bootstrap/js/bootstrap.js') }}"></script>

    @yield('scripts')

    <!-- Demo Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/demo.js') }}"></script>

    <script>
        $(document).ready(function() {
            var tiempoInactividad = 5 * 60 * 1000; // 5 minutos
            // var tiempoInactividad = 3000; // 3 segundos
            var temporizador;

            function restablecerTemporizador() {
                clearTimeout(temporizador);
                temporizador = setTimeout(function() {
                    logout();
                }, tiempoInactividad);
            }


            function logout() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "POST",
                    url: "{{ route('logout') }}",
                    data: {
                        inactividad: true,
                    },
                    dataType: "json",
                    success: function(response) {
                        alert('Se acaba de cerrar tu sesión por inactividad');
                        window.location.reload();
                    }
                });
            }

            $(this).mousemove(function() {
                restablecerTemporizador();
            });

            $(this).keypress(function() {
                restablecerTemporizador();
            });

            restablecerTemporizador();
        });

        let id_actual = 0;
        let contenedor_notificacions = $("#contenedor_notificacions");
        let countNotificaciones = $("#countNotificaciones");

        $(document).ready(function() {
            cargaNotificaciones();
            setInterval(() => {
                cargaNotificaciones();
            }, 1500);
        });

        function cargaNotificaciones() {
            $.ajax({
                type: "GET",
                url: "{{ route('eventos_seguridads.byUser') }}",
                data: {
                    id_actual: id_actual,
                },
                dataType: "json",
                success: function(response) {
                    countNotificaciones.text(response.sin_ver);
                    if (response.ultimo_id != id_actual) {
                        id_actual = response.ultimo_id;
                        contenedor_notificacions.prepend(response.html);
                    }
                }
            });
        }
    </script>
</body>

</html>
