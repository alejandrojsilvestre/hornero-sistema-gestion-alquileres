<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{$code}} - {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link type="text/css" media="all" href="{{url('assets/404/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link type="text/css" media="all" href="{{url('assets/404/css/style.css')}}?1" rel="stylesheet" />
    <link type="text/css" media="all" href="{{url('assets/404/css/respons.css')}}?1" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>
<body>
    <div id="wrapper">
        <div class="container">
            <img class="logo logoWhite" alt="{{env('APP_NAME')}}" src="{{url('images/logo-full-white.png')}}" />
            <img class="logo logoBlack" alt="{{env('APP_NAME')}}" src="{{url('images/logo-full.png')}}" />
            <div class="switcher">
                <input id="sw" type="checkbox" class="switcher-value">
                <label for="sw" class="sw_btn"></label>
                <div class="bg"></div>
                <div class="text"><span class="text-l">Apagar</span><span class="text-d">Prender</span><br />la luz</div>
            </div>

            <div id="dark" class="row text-center">
                <div class="info">
                    <img src="{{url('assets/404/img/404-dark.png')}}" />
                </div>
            </div>

            <div id="light" class="row text-center">
                <div class="info">
                    <img src="{{url('assets/404/img/404-light.gif')}}" />
                    <p>La página que está buscando fue movida, eliminada,<br />
                    renombrada ó puede ser que nunca haya existido.</p>
                    <a href="{{url('/')}}" class="btn">Volver al inicio</a>
                    <a href="mailto:fgandolfo@horneroprop.com" class="btn btn-brown">Soporte</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('assets/404/js/jquery-2.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/404/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/404/js/modernizr.custom.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/404/js/jquery.nicescroll.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/404/js/scripts.js')}}" type="text/javascript"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</body>
</html>