@extends('layouts.app')

@section('title',' Ajustes')

@section('breadcrumbs')
  {{Breadcrumbs::render('ajustes')}}
@endsection

@section('assets')
<script src="{{ asset('js/ajustes.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          @if($sucursal->logo)
            <div class="m-card-profile__pic logo-img">
                <button type="button" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-edit-logo" data-skin="dark" data-placement="top" title="" data-original-title="Cambiar logo">
                    <i class="fa fa-refresh"></i>  
                </button>
                <img src="{{ $sucursal->logo() }}" class="m--img-rounded m--marginless m--img-centered img-logo" alt="Logo de Inmobiliaria"/>
            </div>
          @endif
          <form method="post" action="{{route('ajustes/uploadLogo')}}" enctype="multipart/form-data" class="dropzone logo-new {{ ($sucursal->logo)?'hide':'' }}" id="dropzonePhoto">
            <div class="dz-message" data-dz-message><span>Arrastra o haz click aqui para subir tu LOGO</span></div>
          </form> 
        </div>
      </div>
    </div>
    <!-- <div class="m-portlet">
      <div class="m-portlet__body">
        Mi alquiler
      </div>
    </div>
    <div class="m-portlet">
      <div class="m-portlet__body">
        Consulta Web
      </div>
    </div>
    <div class="m-portlet">
      <div class="m-portlet__body">
        Mensajes de texto
      </div>
    </div>
    <div class="m-portlet">
      <div class="m-portlet__body">
        SMTP
      </div>
    </div> -->
  </div>
  <div class="col-xl-9 col-lg-8">
    {!! Form::open(['id' => 'formAjustes', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
    {!! Form::hidden('sucursal_id', Auth::user()->sucursal_id ) !!}
    <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
      <div class="m-portlet__head">
        <div class="m-portlet__head-tools">
          <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab" aria-selected="false">
                <i class="flaticon-share m--hide"></i>
                Generales
              </a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab" aria-selected="false">
                Facturación
              </a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab" aria-selected="true">
                Correo electrónico
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="tab-content">
        <div class="tab-pane active" id="m_user_profile_tab_1">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="m-alert m-alert--icon m-alert--outline alert alert-accent alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                  <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                  <strong>
                    Info:
                  </strong>
                  Los datos se visualizaran en reportes de la forma en que son cargados en este formulario (recibos, facturas, resumenes, etc).
                </div>
                <div class="m-alert__close">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-6">
                {!! Form::label('razon_social', 'Razón social') !!}
                <div class="input-group m-input-group m-input-group--square">
                  <span class="input-group-addon">
                    <i class="la la-building"></i>
                  </span>
                  {!! Form::text('razon_social', $sucursal->razon_social, ['class' => 'form-control m-input', 'placeholder' => 'Razon social','required']) !!}
                </div>
              </div>
              <div class="col-lg-6">
                {!! Form::label('telefono', 'Teléfono') !!}
                <div class="input-group m-input-group m-input-group--square">
                  <span class="input-group-addon">
                    <i class="la la-phone"></i>
                  </span>
                  {!! Form::text('telefono', $sucursal->telefono, ['class' => 'form-control m-input', 'placeholder' => 'Telefono','required']) !!}
                </div>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-6">
                {!! Form::label('email', 'E-mail') !!}
                <div class="input-group m-input-group m-input-group--square">
                  <span class="input-group-addon">
                    <i class="la la-at"></i>
                  </span>
                   {!! Form::email('email', $sucursal->email, ['class' => 'form-control m-input', 'placeholder' => 'Correo electronico', 'required']) !!}
                </div>
              </div>
              <div class="col-lg-6">
                {!! Form::label('web', 'Página web') !!}
                <div class="input-group m-input-group m-input-group--square">
                  <span class="input-group-addon">
                    <i class="la la-code"></i>
                  </span>
                  {!! Form::text('web', $sucursal->web, ['class' => 'form-control m-input', 'placeholder' => 'Pagina web']) !!}
                </div>
              </div>
            </div>
            
            <div class="form-group m-form__group row">
							<div class="col-lg-8">
								{!! Form::label('direccion', 'Dirección') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-home"></i>
									</span>
									{!! Form::text('direccion', $sucursal->direccion, ['class' => 'form-control m-input', 'placeholder' => 'Calle, nro, piso, depto.', 'autocomplete' => 'off', 'id' => 'userAddress']) !!}
                </div>
								<div class="form-control-feedback addressValidate hide text-danger">La ubicacion es incorrecta.</div>
              </div>
              <div class="col-lg-4">
                {!! Form::label('cod_postal', 'Cod. Postal') !!}
                <div class="input-group m-input-group m-input-group--square">
                  <span class="input-group-addon">
                    <i class="la la-bookmark-o"></i>
                  </span>
                  {!! Form::text('cod_postal', $sucursal->cod_postal, ['class' => 'form-control m-input', 'placeholder' => 'Código Postal']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="m_user_profile_tab_2">
          <div class="form-group m-form__group row">
            <div class="col-lg-6">
              {!! Form::label('inicio_actividades', 'Inicio de actividades') !!}
              <div class="input-group m-input-group m-input-group--square">
                <span class="input-group-addon">
                  <i class="la la-calendar"></i>
                </span>
                {!! Form::text('inicio_actividades', $sucursal->inicio_actividades, ['class' => 'form-control m-input date', 'placeholder' => 'Inicio de actividades','required']) !!}
              </div>
            </div>
            <div class="col-lg-6">
              {!! Form::label('tipo_iva_id', 'Condición I.V.A.') !!}
              <div class="input-group mb-3">
                <div class="input-group-prepend-select">
                  {!! Form::select('tipo_iva_id', $tiposIva, $sucursal->tipo_iva_id, ['class' => 'form-control m-input','id'=>'tipoIvaSucursal','required'])!!} 
                </div>
                {!! Form::tel('nro_cui', $sucursal->nro_cui, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de C.U.I.', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'sucursalNroCui','required']) !!}
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-6">
              {!! Form::label('ingresos_brutos', 'Ingresos brutos') !!}
              <div class="input-group m-input-group m-input-group--square">
                {!! Form::text('ingresos_brutos', $sucursal->ingresos_brutos, ['class' => 'form-control m-input', 'placeholder' => 'Ingresos brutos', 'id'=>'ingresos_brutos','required']) !!}
              </div>
            </div>
            <div class="col-lg-3">
              {!! Form::label('punto_venta', 'Punto de venta') !!}
              <div class="input-group mb-3">
                {!! Form::text('punto_venta', $sucursal->punto_venta, ['class' => 'form-control m-input', 'placeholder' => 'Punto de venta', 'maxlength' => '4','id'=>'punto_venta','required']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="m_user_profile_tab_3">
          <div class="form-group m-form__group row">
            <div class="m-alert m-alert--icon m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">
              <div class="m-alert__icon">
                <i class="la la-warning"></i>
              </div>
              <div class="m-alert__text">
                <strong>
                  Info:
                </strong>
                Es de mucha importacia configurar su servidor de salidad (SMTP) para que los correos se envien correctamente. <strong>Si no tiene podemos ofrecerle uno para mejorar su servicio.</strong>
              </div>
              <div class="m-alert__close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-6">
              {!! Form::label('smtp_server', 'Servidor', ['class' => 'col-3 col-form-label']) !!}
              <div class="input-group m-input-group m-input-group--square">
                <span class="input-group-addon">
                  <i class="la la-code"></i>
                </span>
                {!! Form::text('smtp_server', $sucursal->smtp_server, ['class' => 'form-control m-input', 'placeholder' => 'Servidor','id'=>'smtp_server']) !!}
              </div>
            </div>
            <div class="col-lg-6">
              {!! Form::label('smtp_user', 'Usuario', ['class' => 'col-3 col-form-label']) !!}
              <div class="input-group m-input-group m-input-group--square">
                <span class="input-group-addon">
                  <i class="la la-user"></i>
                </span>
                {!! Form::text('smtp_user', $sucursal->smtp_user, ['class' => 'form-control m-input', 'placeholder' => 'Usuario', 'id'=>'smtp_user']) !!}
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-6">
                {!! Form::label('smtp_pass', 'Contraseña', ['class' => 'col-3 col-form-label']) !!}
              <div class="input-group m-input-group m-input-group--square">
                <span class="input-group-addon">
                  <i class="la la-key"></i>
                </span>
                {!! Form::text('smtp_pass', $sucursal->smtp_pass, ['class' => 'form-control m-input', 'placeholder' => 'Contraseña', 'id'=>'smtp_pass']) !!}
              </div>
            </div>
            <div class="col-lg-6">
            {!! Form::label('smtp_port', 'Puerto', ['class' => 'col-3 col-form-label']) !!}
              <div class="input-group m-input-group m-input-group--square">
                <span class="input-group-addon">
                  #
                </span>
                {!! Form::text('smtp_port', $sucursal->smtp_port, ['class' => 'form-control m-input', 'placeholder' => 'Puerto', 'maxlength' => '5', 'id'=>'smtp_port']) !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
          <div class="row">
            <div class="col-12">
              {!! Form::submit('Guardar',['class'=>'btn btn-success m-btn m-btn--air m-btn--custom']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection

