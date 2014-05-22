<!DOCTYPE html>
<html>
<head>
    <title>DANS ENERGY - Sign In</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,800italic,600,800,700' rel='stylesheet' type='text/css'>
    <!--[if gte IE 9]>
        <style type="text/css">
            .gradient {
                filter: none;
            }
        </style>
    <![endif]-->
</head>
<body>
    <div class="head gradienr">@include('layouts.navigation')</div>
    <div class="container">
        <div class="content">
            Content Goes Here
        </div>
    </div>
    @yield('content')
</body>
</html>

