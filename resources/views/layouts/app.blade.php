<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') BKK SMK</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bkk.css') }}">

    @yield('css')

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}"> --}}
</head>
<body class="bg-1">
    <div id="app">
        @include('layouts.navbar')

        @yield('lp')

        <main class="pt-4 bg-1" id="mainapp">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bkk.js') }}"></script>
    @include('layouts.messages')

    @yield('js')

    {{-- <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script> --}}
</body>
</html>
