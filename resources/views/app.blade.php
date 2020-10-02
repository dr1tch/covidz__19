<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>COVIDZ-19</title>

    <!-- Scripts -->
    {{-- <script src="https://kit.fontawesome.com/97a6e3f48a.js" crossorigin="anonymous"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script>
        window.csrf_token = "{{ csrf_token() }}"
        window.asset = '{{ asset('') }}';
    </script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">

</head>
<body>
    <div id="app" class="container-fluid" style="height: 100%"></div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
