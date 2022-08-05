<!DOCTYPE html>
<html lang="es" >
	<head>
		<meta charset="utf-8" />
		<title>{{env('APP_NAME')}} | @yield('title','Ingresar')</title>
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
	</head>
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		@yield('content')

		<script src="{{ asset('plugins/base/vendors.bundle.js') }}?1" type="text/javascript"></script>
		<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('plugins/base/login.js') }}?1 type="text/javascript"></script>
	</body>
</html>