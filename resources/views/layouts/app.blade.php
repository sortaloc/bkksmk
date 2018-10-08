<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bkk.css') }}">
    @yield('css')
</head>
<body class="bg-1">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-2 navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                            </li>

                            <!-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Register
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('register') }}">
                                        Perusahaan
                                    </a>
                                    <a class="dropdown-item" href="{{ url('registerCP') }}">
                                        Calon Pegawai
                                    </a>
                                </div>
                            </li> -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->id_status === 1)
                                    <a class="dropdown-item" href="{{ url('admin/settings/password') }}">
                                        <i class="fas fa-key"></i>
                                        <span class="ml-2">{{ __('Edit Password') }}</span>
                                    </a>
                                    @elseif(Auth::user()->id_status === 2)
                                    <a class="dropdown-item" href="{{ url('perusahaan/settings/datadiri') }}">
                                        <i class="fas fa-address-card"></i>
                                        <span class="ml-2">{{ __('Edit Data Diri') }}</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ url('perusahaan/settings/password') }}">
                                        <i class="fas fa-key"></i>
                                        <span class="ml-2">{{ __('Edit Password') }}</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @else
                                    <a class="dropdown-item" href="{{ url('cp/settings/datadiri') }}">
                                        <i class="fas fa-address-card"></i>
                                        <span class="ml-2">{{ __('Edit Data Diri') }}</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ url('cp/settings/password') }}">
                                        <i class="fas fa-key"></i>
                                        <span class="ml-2">{{ __('Edit Password') }}</span>
                                    </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 bg-1">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <!-- <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- <script type="text/javascript" src="{{ asset('assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bkk.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        $(document).ready(() => {
            $('#persyaratan').summernote();
            $('#keterangan').summernote();
        });

        $('.jumlahPelamar').on('click', function(e){
            e.preventDefault();
            window.location.replace($(this).attr('href'));
        });

        $('.deleteButton').on('click', function(e){
            e.preventDefault();
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data dihapus maka data yang bersangkutan akan ikut terhapus juga.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okelah, hapus aja!',
            }).then((result) =>{
                window.location.replace($url);
            });
        });
    </script>
</body>
</html>
