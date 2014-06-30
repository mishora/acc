<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}" ></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/global.js') }}" ></script>
    <script type="text/javascript">
        var issue_date = '';
        var pay_date = '';
    </script>
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
                <p id="hello">Operator: {{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
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

