@extends('layouts.app')

@section('title','Perfil de '.$persona->getFullName())

@section('breadcrumbs')
  {{Breadcrumbs::render('usuarios')}}
@endsection

@section('assets')
<script src="{{ asset('js/personas.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
	<div class="col-xl-12">
		{!! Form::open(['id' => 'formPersona', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
	    {!! Form::hidden('user_id',$persona->id) !!}
		<div class="m-portlet m-portlet--full-height m-portlet--tabs">
			<div class="m-portlet__head">
				<div class="m-portlet__head-tools">
					<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
								<i class="flaticon-share m--hide"></i>
								Datos generales
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
								<i class="flaticon-share m--hide"></i>
								APP
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
								<i class="flaticon-share m--hide"></i>
								Notas
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
									{!! Form::text('nombre', $persona->nombre, ['class' => 'form-control m-input', 'placeholder' => 'Nombre','required']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('apellido', 'Apellido') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('apellido', $persona->apellido, ['class' => 'form-control m-input', 'placeholder' => 'Apellido','required']) !!}
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
									{!! Form::tel('telefono', $persona->telefono, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Teléfono', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('celular', 'Celular') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-mobile-phone"></i>
									</span>
									{!! Form::tel('celular', $persona->celular, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Celular', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
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
									{!! Form::text('email', $persona->email, ['class' => 'form-control m-input', 'disabled']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="la la-calendar"></i>
									</span>
									{!! Form::text('fecha_nacimiento', $persona->fecha_nacimiento, ['class' => 'form-control m-input  m-birthdate', 'placeholder' => 'Fecha de Nacimiento','id'=>'userFecNacimiento']) !!}
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
									{!! Form::text('direccion', $persona->direccion, ['class' => 'form-control m-input', 'placeholder' => 'Calle, nro, piso, depto.', 'autocomplete' => 'off', 'id' => 'peopleAddress']) !!}
								</div>
								<div class="form-control-feedback addressValidate hide text-danger">La ubicacion es incorrecta.</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('cod_postal', 'Cod. Postal') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-bookmark-o"></i>
									</span>
								{!! Form::text('cod_postal', $persona->cod_postal, ['class' => 'form-control m-input', 'placeholder' => 'Código Postal']) !!}
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
								{!! Form::label('tipo_documento_id', 'Documento') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_documento_id', $tiposDocumento, $persona->tipo_documento_id, ['class' => 'form-control m-input','id'=>'userTipoDoc'])!!}
					                </div>
				                	{!! Form::tel('nro_documento', $persona->nro_documento, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Documento', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'userNroDoc']) !!}
				              	</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('tipo_iva_id', 'Condicion I.V.A.') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_iva_id', $tiposIva, $persona->tipo_iva_id, ['class' => 'form-control m-input','id'=>'userTipoIva'])!!} 
					                </div>
									{!! Form::tel('nro_cui', $persona->nro_cui, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de C.U.I.T', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'userNroCui']) !!}
				              	</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="m_user_profile_tab_2">
					<div class="form-group m-form__group row">
		              <div class="m-alert m-alert--icon m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">
		                <div class="m-alert__icon">
		                  <i class="la la-warning"></i>
		                </div>
		                <div class="m-alert__text">
		                  <strong>
		                    Importante:
		                  </strong>
		                  Recomendamos que tanto usuario como contraseña contengan letras y numeros.
		                </div>
		                <div class="m-alert__close">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
		                </div>
		              </div>
		            </div>
					<div class="form-group m-form__group row">
			            <div class="col-lg-6">
							{!! Form::label('api_user', 'Usuario') !!}
			              	<div class="input-group m-input-group m-input-group--square">
								<span class="input-group-addon">
									<i class="la la-user"></i>
								</span>
								{!! Form::text('api_user', null, ['class' => 'form-control m-input', 'placeholder' => 'Usuario','id'=>'personaUsuario']) !!}
							</div>
			            </div>
			            <div class="col-lg-6">
							{!! Form::label('api_pass', 'Contraseña') !!}
			              	<div class="input-group m-input-group m-input-group--square">
								<span class="input-group-addon">
									<i class="la la-key"></i>
								</span>
								{!! Form::text('api_pass', null, ['class' => 'form-control m-input', 'placeholder' => 'Contraseña','id'=>'personaContraseña']) !!}
							</div>
			            </div>
					</div>
				</div>
				<div class="tab-pane" id="m_user_profile_tab_3">
					<div class="form-group m-form__group row">
						{!! Form::textarea('notas', $persona->notas, ['class' => 'form-control m-input'])!!}
					</div>
				</div>
				<div class="tab-pane" id="m_user_profile_tab_4">
					<div class="form-group m-form__group row">
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions">
						<div class="row">
							<div class="col-lg-12 centered">
								{!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
    							<a href="{{ route('personas.index') }}" class="btn btn-secondary"> Volver</a>
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
