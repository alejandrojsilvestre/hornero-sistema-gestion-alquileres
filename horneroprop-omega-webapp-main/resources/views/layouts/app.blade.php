<!DOCTYPE html>
<html lang="es">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{env('APP_NAME')}} | @yield('title','Dashboard')</title>
		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<!--end::Page Vendors -->
		<link href="{{ asset('plugins/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.bundle.css?' . time()) }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/libs/trumbowyg.min.css?' . time()) }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.css?' . time()) }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/intlTelInput.css?' .time()) }}" rel="stylesheet" type="text/css" />
		<link href="https://cdn.jsdelivr.net/npm/intro.js@4.3.0/introjs.min.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/introjs/themes/introjs-modern.css') }}" rel="stylesheet" type="text/css" />
		
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
		<!--begin::Base Scripts -->
		<script src="{{ asset('plugins/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/intlTelInput.js?' .time()) }}" type="text/javascript"></script>
		<script src="{{ asset('js/scripts.js?'.time()) }}" type="text/javascript"></script>
		<script src="{{ asset('js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/datatable.js?' . time()) }}" type="text/javascript"></script>
		<script src="{{ asset('js/personas.js?' . time()) }}" type="text/javascript"></script>
		<script src="{{ asset('js/eventosForm.js?' . time()) }}" type="text/javascript"></script>
		<script src="{{ asset('js/libs/trumbowyg.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/ubication.js?' . time()) }}" type="text/javascript"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyADVhZvpHCiAAjQKj-gfG2bpHDC7yu0428&libraries=places&callback=initialize"></script>
		<script src="https://cdn.jsdelivr.net/npm/intro.js@4.3.0/intro.min.js" type="text/javascript"></script>
		<style>
			.centerText{text-align:center}
			.m-accordion--default{width:100%!important}
			.dropzone {
				min-height: 150px;
				border: 2px dashed #eee;
				margin-bottom:10px;
				text-align:center;
			}
			.m-brand__logo{width:80%}
			.m-brand__logo img{width:100%}
		</style>
		@yield('assets')
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
        	@section('header')
				@include('layouts.header')
    		@show
			<!-- END: Header -->		
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
        		@section('sidebar')
					@include('layouts.sidebar')
        		@show
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
	        		@section('sub-header')
						@include('layouts.sub-header')
	        		@show
					<div class="m-content">
					@yield('content')
					</div>
				</div>
			</div>
			<!-- end:: Body -->
			<!-- begin::Footer -->
			@include('layouts.footer')
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
    	<!-- begin::Quick Sidebar -->
		<!-- end::Quick Sidebar -->		    
	    <!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- Form Eventos -->	
		@include('eventos.modal._form')
		<!-- Form Personas -->	
		@include('personas.modal._form')
		<!-- Celular Phone -->	
		@include('layouts.celular-phone')
		<div id="ajax-load" style="display: none"></div>
	</body>
	<!-- end::Body -->
</html>

