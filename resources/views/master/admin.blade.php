<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Igor Rinkovec">

    <title>@yield('header') - FOI Buraz</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/admin.css") }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset("font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->

</head>

<body style="@yield('bodyStyle')">

    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <img class="logo" src="{{ asset('img/logo.png') }}">
            </li>
            <li>
                <a href="{{ route('admin.statistics') }}">Statistika</a>
            </li>
            <li>
                <a href="{{ route('admin.faces.little') }}">Mali burazi</a>
            </li>
            <li>
                <a href="{{ route('admin.faces.big') }}">Veliki burazi</a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}">Postavke</a>
            </li>
            <li>
                <a href="{{ route('admin.email') }}">Slanje mailova</a>
            </li>
            <li>
                <a href="{{ route('auth.logout') }}">Odjavi se</a>
            </li>
        </ul>
    </div>

    <div id="wrapper" class="container">
        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="{{ asset("js/jquery.js") }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset("js/bootstrap.min.js") }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset("js/jquery.easing.min.js") }}"></script>

</body>

</html>
