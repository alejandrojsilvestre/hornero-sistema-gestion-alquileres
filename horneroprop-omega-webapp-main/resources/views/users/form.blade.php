@extends('layouts.app')

@section('title','Perfil de '.$user->getFullName())

@section('breadcrumbs')
  {{Breadcrumbs::render('usuarios')}}
@endsection

@section('assets')
<script src="{{ asset('js/users.js') }}?b" type="text/javascript"></script>
@endsection

@section('content')

<div class="row">
	<div class="col-xl-3 col-lg-4">
		<div class="m-portlet">
			<div class="m-portlet__body">
				<div class="m-card-profile">
					<div class="m-card-profile__title m--hide">
						Mi perfil
					</div>
					@if($user->foto)
						<div class="m-card-profile__pic profile-img">
							<button type="button" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-edit-profile-img" data-skin="dark" data-placement="top" title="" data-original-title="Cambiar foto">
							<i class="fa fa-refresh"></i>  
							</button>

							<img src="{{ Auth::user()->foto() }}" class="m--img-rounded m--marginless m--img-centered" alt="" />
						</div>
					@endif

					<form method="post" action="{{route('usuarios/uploadPhoto')}}" enctype="multipart/form-data" class="dropzone profile-img-new {{$user->foto ? ' hide' :''}}" id="dropzonePhoto">
      					<div class="dz-message" data-dz-message><span>Arrastra o haz click aqui para subir tu FOTO</span></div>
					</form>
					<div class="m-card-profile__details">
						<span class="m-card-profile__name">
							{{$user->getFullName()}}
						</span>
						<a href="" class="m-card-profile__email m-link">
							{{$user->email}}
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-9 col-lg-8">
		{!! Form::open(['id' => 'formUsuario', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
	    {!! Form::hidden('user_id',$user->id) !!}
		<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-tools">
					<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
								<i class="flaticon-share m--hide"></i>
								Datos generales
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="tab-content">
				<div class="tab-pane active" id="m_user_profile_tab_1">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-10">
								<h3 class="m-form__section">
									1. Detalles personales
								</h3>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								{!! Form::label('nombre', 'Nombre') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('nombre', $user->nombre, ['class' => 'form-control m-input', 'placeholder' => 'Nombre','required']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('apellido', 'Apellido') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('apellido', $user->apellido, ['class' => 'form-control m-input', 'placeholder' => 'Apellido','required']) !!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								{!! Form::label('telefono', 'Teléfono') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-phone"></i>
									</span>
									{!! Form::tel('telefono', $user->telefono, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Telefono', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('celular', 'Celular') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-mobile-phone"></i>
									</span>
									{!! Form::tel('celular', $user->celular, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Celular', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								{!! Form::label('email', 'Email') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-at"></i>
									</span>
									{!! Form::text('email', $user->email, ['class' => 'form-control m-input', 'disabled']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="la la-calendar"></i>
									</span>
									{!! Form::text('fecha_nacimiento', $user->fecha_nacimiento, ['class' => 'form-control m-input m-birthdate', 'placeholder' => 'Fecha de Nacimiento','id'=>'userFecNacimiento']) !!}
								</div>	
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-10">
								<h3 class="m-form__section">
									2. Ubicación
								</h3>
							</div>
						</div>
						<div class="form-group m-form__group row">

							<div class="col-lg-8">
								{!! Form::label('direccion', 'Dirección') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-home"></i>
									</span>
									{!! Form::text('direccion', $user->direccion, ['class' => 'form-control m-input', 'placeholder' => 'Calle, nro, piso, depto.', 'autocomplete' => 'off', 'id' => 'subsidiaryAddress']) !!}
								</div>
								<div class="form-control-feedback addressValidate hide text-danger">La ubicacion es incorrecta.</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('cod_postal', 'Cod. Postal') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-bookmark-o"></i>
									</span>
								{!! Form::text('cod_postal', $user->cod_postal, ['class' => 'form-control m-input', 'placeholder' => 'Codigo Postal']) !!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-10">
								<h3 class="m-form__section">
									3. Datos de gestión
								</h3>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								{!! Form::label('caja_id', 'Caja') !!}
				              	<div class="input-group mb-3">
            					{!! Form::select('caja_id', $cajas, $user->caja_id, ['class' => 'form-control m-input'	])!!}
				              	</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								{!! Form::label('tipo_documento_id', 'Documento') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_documento_id', $tiposDocumento, $user->tipo_documento_id, ['class' => 'form-control m-input','id'=>'userTipoDoc'])!!}
					                </div>
				                	{!! Form::tel('nro_documento', $user->nro_documento, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Documento', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'userNroDoc']) !!}
				              	</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('tipo_iva_id', 'Condicion I.V.A.') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_iva_id', $tiposIva, $user->tipo_iva_id, ['class' => 'form-control m-input','id'=>'userTipoIva'])!!} 
					                </div>
									{!! Form::tel('nro_cui', $user->nro_cui, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de C.U.I.', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'userNroCui']) !!}
				              	</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane active" id="m_user_profile_tab_2">
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions">
						<div class="row">
							<div class="col-lg-12 centered">
								{!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
    							<a href="{{ route('usuarios.index') }}" class="btn btn-secondary"> Volver</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection
