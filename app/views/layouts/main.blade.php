<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}" ></script>
    <!--
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,800italic,600,800,700' rel='stylesheet' type='text/css'>
    -->
    <script type="text/javascript" src="{{ URL::asset('js/global.js') }}" ></script>
    <!--[if gte IE 9]>
        <style type="text/css">
            .gradient {
                filter: none;
            }
        </style>
    <![endif]-->
</head>
<body>
    <div id="overlay"></div>
    @if(Session::has('msg-success'))
        <script type="text/javascript">
            alertify.alert("{{ Session::get('msg-success') }}");
            alertify.success("{{ Session::get('msg-success') }}");
        </script>
    @endif
    @if(Session::has('msg-fail'))
        <script type="text/javascript">
            alertify.alert("{{ Session::get('msg-fail') }}");
        </script>
    @endif
    <div class="head gradient">
        <div class="hello">
            @if(Auth::check())
                Operator: {{ Auth::user()->name }} {{ Auth::user()->last_name }}
            @endif
        </div>
        @include('layouts.navigation')
    </div>
    <div class="container">
        <div class="content">
            @yield('content')
        </div>
        <div class="push"></div>
        <div class="footer"></div>
    </div>
</body>
</html>

