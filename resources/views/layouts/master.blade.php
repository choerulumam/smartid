<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <title>SMARTID - @yield('title') </title>
</head>

<body class="sidebar-mini fixed">
    <div class="wrapper">
        @include('components.header')
        @if(Auth::guard('admin')->check())
            @include('components.sidebar-0')
        @elseif(Auth::guard('dosen')->check())
            @include('components.sidebar-1')
        @elseif(Auth::guard('mahasiswa')->check())
            @include('components.sidebar-2')
        @endif
        @yield('content')
    </div>
</body>

</html>