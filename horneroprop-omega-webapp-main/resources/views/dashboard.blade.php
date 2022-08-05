@extends('layouts.app')
@section('assets')
	<script src="{{ asset('js/dashboard.js?' . time()) }}" type="text/javascript"></script>
 	<script src="{{ asset('js/vendors/custom/jquery-ui/jquery-ui.bundle.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('plugins/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('js/eventos.js?' . time()) }}" type="text/javascript"></script>
  	<link href="{{ asset('plugins/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
	<style>
		.ofHidden{overflow:hidden;}
		.m-widget17__visual{Width: calc(100% + 30px)!important; margin-right: -15px!important;margin-left: -15px!important;}
	</style>
@endsection

@section('content')
<!--Begin::Section-->
<div id="introDashboard" class="row">
	<div class="col-xl-6 mb-3">
		<!--begin:: Widgets/Top Products-->
		<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ofHidden">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Gestión
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<!--begin::Widget5-->
				<div class="m-widget4">
					<div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20" style="height:260px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
						<canvas id="m_chart_trends_stats" width="540" height="260" class="chartjs-render-monitor" style="display: block; width: 540px; height: 260px;"></canvas>
					</div>
					<div class="m-widget4__item">
						<div class="m-widget4__img m-widget4__img--logo">
							<span class="m-widget17__icon">
								<i class="flaticon-interface-5 m--font-success"></i>
							</span>
						</div>
						<div class="m-widget4__info">
							<span class="m-widget4__title">
								Contratos cobrados
							</span>
							<br>
							<span class="m-widget4__sub">
								Cantidad de contratos cobrados en el periodo actual.
							</span>
						</div>
						<span class="m-widget4__ext">
							<span class="m-widget4__number m--font-success">
								{{ $contratosLiquidadosCount }}
							</span>
						</span>
					</div>
					<div class="m-widget4__item">
						<div class="m-widget4__img m-widget4__img--logo">	
							<a href="{{ url('reportes/inquilinos_cobrar') }}" target="_blank">
								<!-- <img src="assets/app/media/img/client-logos/logo2.png" alt=""> -->
								<span class="m-widget17__icon">
									<i class="flaticon-download  m--font-danger"></i>
								</span>
							</a>
						</div>
						<div class="m-widget4__info">
							<span class="m-widget4__title">
								Inquilinos a cobrar
							</span>
							<br>
							<span class="m-widget4__sub">
								Cantidad de inquilinos por cobrar en el periodo actual.
							</span>
						</div>
						<span class="m-widget4__ext">
							<span class="m-widget4__number m--font-danger">
								{{ $contratosPorLiquidarCount }}
							</span>
						</span>
					</div>
					<div class="m-widget4__item">
						<div class="m-widget4__img m-widget4__img--logo">
							<a href="{{ url('reportes/propietarios_pagar') }}" target="_blank">
								<!-- <img src="assets/app/media/img/client-logos/logo2.png" alt=""> -->
								<span class="m-widget17__icon m--font-danger">
									<i class="flaticon-download"></i>
								</span>
							</a>
						</div>
						<div class="m-widget4__info">
							<span class="m-widget4__title">
								Propietarios a pagar
							</span>
							<br>
							<span class="m-widget4__sub">
								Cantidad de propietarios a liquidar en el periodo actual.
							</span>
						</div>
						<span class="m-widget4__ext">
							<span class="m-widget4__number m--font-danger">
								{{ $propietariosPorLiquidarCount }}
							</span>
						</span>
					</div>
				</div>
				<!--end::Widget 5-->
			</div>
		</div>
		<!--end:: Widgets/Top Products-->
	</div>
	<div class="col-xl-6 mb-3">
		<!--begin:: Widgets/Activity-->
		<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text m--font-light">
							Generales
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="m-widget17">
					<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
						<div class="m-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
							<canvas id="m_chart_activities" width="540" height="208" class="chartjs-render-monitor" style="display: block; width: 540px; height: 208px;"></canvas>
						</div>
					</div>
					<div class="m-widget17__stats">
						<div class="m-widget17__items m-widget17__items-col1">
							<div class="m-widget17__item">
								<span class="m-widget17__icon">
									<i class="flaticon-file m--font-success"></i>
								</span>
								<span class="m-widget17__subtitle">
									Contratos activos
								</span>
								<span class="m-widget17__desc">
									{{ $contratosActivosCount }} contratos.
								</span>
							</div>
							<div class="m-widget17__item">
								<span class="m-widget17__icon">
									<i class="flaticon-file m--font-danger"></i>
								</span>
								<span class="m-widget17__subtitle">
									Contratos inactivos
								</span>
								<span class="m-widget17__desc">
									{{ $contratosInactivosCount }} contratos.
								</span>
							</div>
						</div>
						<div class="m-widget17__items m-widget17__items-col2">
							<div class="m-widget17__item">
								<span class="m-widget17__icon">
									<i class="flaticon-users m--font-brand"></i>
								</span>
								<span class="m-widget17__subtitle">
									Personas
								</span>
								<span class="m-widget17__desc">
									{{ $personasCount }} personas.
								
								</span>
							</div>
							<div class="m-widget17__item">
								<span class="m-widget17__icon">
									<i class="flaticon-user-settings m--font-brand"></i>
								</span>
								<span class="m-widget17__subtitle">
									Usuarios
								</span>
								<span class="m-widget17__desc">
									{{ $usuariosCount }} usuarios.
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Activity-->
	</div>
</div>
<!--begin::Portlet-->
<div class="m-portlet" id="m_portlet">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon">
					<i class="flaticon-map-location"></i>
				</span>
				<h3 class="m-portlet__head-text">
					Calendario
				</h3>
			</div>
		</div>
		<div class="m-portlet__head-tools">
			<ul class="m-portlet__nav">
				<li class="m-portlet__nav-item">
					<a href="#" data-toggle="modal" data-target="#_formEvento" class="nuevoEvento abrirEventos btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
						<span>
						<i class="la la-plus-circle"></i>
						<span>
							Nuevo
						</span>
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="m-portlet__body">
		<div id="m_calendar"></div>
	</div>
</div>
<!--end::Portlet-->
<!--End::Section-->
<script src="{{ asset('js/intro/dashboard.js?' . time()) }}" type="text/javascript"></script>
@endsection()