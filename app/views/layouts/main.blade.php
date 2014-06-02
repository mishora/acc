<!DOCTYPE html>
<html>
<head>
    <title>DANS ENERGY - Sign In</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
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
    <div id="dialog-box">
        <div id="dialog-box-msg"></div>
        <div id="dialog-box-cancel">
            <input type="submit" value="Ok" onclick="dialog_box_hide('dialog-box', true);">
        </div>
    </div>
    @if(Session::has('msg-success'))
        <script type="text/javascript">
            dialog_box_show("dialog-box", "{{ Session::get('msg-success') }}", true);
        </script>
    @endif
    @if(Session::has('msg-fail'))
        <script type="text/javascript">
            dialog_box_show("dialog-box", "{{ Session::get('msg-fail') }}", true, '#CC0000');
        </script>
    @endif


    <div class="head gradienr">@include('layouts.navigation')</div>
    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>

