<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @component('layouts.menu')@endcomponent
        <!-- /sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            @component('layouts.topnav')@endcomponent
            <div class="container-fluid">
                    <div style="height: 10px"></div>
                    

                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script> 
    <script src="{{ asset('/js/custom.js') }}"></script> 

</body>

</html>