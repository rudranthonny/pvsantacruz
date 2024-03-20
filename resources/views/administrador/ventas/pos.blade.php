<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel=icon href={{ asset('/imagenes/favicon.ico') }}>
    <style>
        .loading_wrap {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #fff;
            display: block;
            position: absolute;
        }

        .loader_logo {
            height: 80px;
            width: 80px;
            position: absolute;
            left: calc(50% - 50px);
            top: 38%;
        }

        .loader_logo img {
            height: 100%;
            width: 100%;
        }

        .loading {
            border: 3px solid rgba(102, 51, 153, 0.45);
            position: absolute;
            left: calc(50% - 40px);
            top: 50%;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border-top-color: #8b5cf6;
            animation: loader 1s ease-in-out infinite;
            -webkit-animation: loader 1s ease-in-out infinite;
        }

        @keyframes loader {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes loader {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        .pos_page {
            min-height: 100vh;
            position: absolute;
            right: 0;
            top: 0;
            width: 100%;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Stocky | Ultimate Inventory With POS</title>
</head>

<body class="text-left">
    <noscript>
        <strong>
            Lo sentimos, pero Stocky no funciona correctamente sin JavaScript habilitado.
            Por favor, activelo para continuar.</strong>
    </noscript>

    <!-- built files will be auto injected -->
    <div class="loading_wrap" id="loading_wrap" style="display: none;">
        <div class="loader_logo">
            <img src="{{ asset('/imagenes/logo.png') }}" class="" alt="logo" />

        </div>

        <div class="loading"></div>
    </div>
    <div id="app">
        <div class="pos_page">
            <div class="container-fluid p-0 app-admin-wrap layout-sidebar-large clearfix">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-order">
                            <div class="main-header">
                                <div class="logo">
                                    <a href="/admin" class="">
                                        <img src="/imagenes/11896760Imagen1.jpg" alt="" width="60"
                                            height="60">
                                    </a>
                                </div>
                                <div class="mx-auto"></div>
                                <div class="header-part-right">
                                    <div class="dropdown">
                                        <div id="dropdown-1"
                                            class="dropdown b-dropdown m-md-2 user col align-self-end btn-group">
                                            <button id="dropdown-1__BV_toggle_" aria-haspopup="true"
                                                aria-expanded="false" type="button"
                                                class="btn dropdown-toggle btn-link text-decoration-none dropdown-toggle-no-caret">
                                                <img src="/images/avatar/no_avatar.png" id="userDropdown" alt=""
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </button>
                                            <ul role="menu" tabindex="-1" aria-labelledby="dropdown-1__BV_toggle_"
                                                class="dropdown-menu dropdown-menu-right">
                                                <div aria-labelledby="userDropdown" class="dropdown-menu-left">
                                                    <div class="dropdown-header">
                                                        <i class="i-Lock-User mr-1"></i>
                                                        <span>William Castillo</span>
                                                    </div>
                                                    <a href="/app/profile" class="dropdown-item">perfil</a>
                                                    <a href="/app/settings/System_settings"
                                                        class="dropdown-item">Configuraciones</a>
                                                    <a href="#" class="dropdown-item">cerrar sesión</a>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
