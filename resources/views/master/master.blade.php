<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Igor Rinkovec">
    <meta property="og:title" content="FOI Buraz" />
    <meta property="og:url" content="http://buraz.foi.rocks/" />
    <meta property="og:description" content="Neslužbeni program studenskog mentorstva Fakulteta organizacije i informatike." />
    <meta property="og:image" content="{{ asset('img/fb-thumbnail.png') }}">

    <title>@yield('header') - FOI Buraz</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset("css/grayscale.css") }}" rel="stylesheet">

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

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <img style="height: 30px; widht: auto;" src="{{ asset("img/logo.png") }}">
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">O Projektu</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#get-a-bro">Dodjeli Mi Velikog Buraza</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; FOI Rocks 2017</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset("js/jquery.js") }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset("js/bootstrap.min.js") }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset("js/jquery.easing.min.js") }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset("js/grayscale.js") }}"></script>

</body>

</html>
