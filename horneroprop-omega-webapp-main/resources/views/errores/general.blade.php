<!DOCTYPE html>
<html lang="es" >
	<head>
		<meta charset="utf-8" />
		<title>{{$code}} - {{env('APP_NAME')}}</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
		<link href="{{ asset('plugins/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
        <style>
            .m-error-6 .m-error_container .m-error_subtitle > h1{margin-top:6rem;}
        </style>
	</head>
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid  m-error-6" style="background-image: url({{url('images/bg6.jpg')}});">
				<div class="m-error_container">
					<div class="m-error_subtitle m--font-light">
						<h1>
                            <img style="width:200px;display:block;margin:0 auto;" alt="{{env('APP_NAME')}}" src="{{url('images/logo-full-white.png')}}" />
							Ups...
                        </h1>
					</div>
					<p class="m-error_description m--font-light">
                        Parece que algo salió mal.
                        <br>
                        Estamos trabajando en ello.
                        <br>
                        <small>{{$code}}</small>
					</p>
				</div>
			</div>
		</div>
		<script src="{{ asset('plugins/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('js/scripts.bundle.js')}}" type="text/javascript"></script>
	</body>
</html>