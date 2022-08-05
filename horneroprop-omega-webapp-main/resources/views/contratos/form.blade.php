@extends('layouts.app')

@section('title')
  {{ (($contrato->id)?'Editar':'Nuevo').' Contrato' }}
@endsection
@section('breadcrumbs')
  {{Breadcrumbs::render('contratos')}}
@endsection

@section('assets')
<script src="{{ asset('js/contratos.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/inmuebles.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/gastos.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/impuestos.js?' . time()) }}" type="text/javascript"></script>
@endsection
@section('content')
<div class="m-portlet m-portlet--mobile">
  <div class="m-portlet__body">
    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--brand" role="tablist">
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#generales" role="tab">
          <i class="flaticon-interface-1"></i>
          Generales
        </a>
      </li>
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#montos" role="tab">
          <i class="flaticon-interface-9"></i>
          Montos
        </a>
      </li><!-- 
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#partidas" role="tab">
          <i class="flaticon-interface-9"></i>
          Partidas
        </a>
      </li> -->
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#avanzados" role="tab">
          <i class="flaticon-cogwheel-2"></i>
          Avanzados
        </a>
      </li>
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#notas" role="tab">
          <i class="flaticon-book"></i>
          Notas
        </a>
      </li>
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#gestion" role="tab">
          <i class="flaticon-coins"></i>
          Gestion
        </a>
      </li>
      <!-- <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#archivos" role="tab">
          <i class="flaticon-file"></i>
          Archivos
        </a>
      </li>
      <li class="nav-item m-tabs__item">
        <a class="nav-link m-tabs__link" data-toggle="tab" href="#historia" role="tab">
          <i class="flaticon-calendar"></i>
          Historia
        </a>
      </li> -->
    </ul>
    {!! Form::open(['id' => 'formContrato', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
    {!! Form::hidden('id',$contrato->id) !!}
    <div class="m-portlet__body">
      <div class="tab-content">
        <div class="tab-pane active" id="generales" role="tabpanel">
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              {!! Form::label('carpeta', 'Caperta') !!}
              <div class="input-group m-input-group m-input-group--square">
                <span class="input-group-addon">
                  <i class="la la-folder"></i>
                </span>
                {!! Form::text('carpeta', $contrato->carpeta, ['class' => 'form-control m-input txt-a-center', 'placeholder' => 'Carpeta']) !!}
              </div>
            </div>
            <div class="col-lg-8">
                {!! Form::label('', 'Inmueble') !!}
                <div class="input-group m-input-group m-input-group--square">
                  <span class="input-group-addon">
                    <i class="la la-home"></i>
                  </span>
                  {!! Form::hidden('inmueble_id',$contrato->inmueble_id) !!}
                  {!! Form::text('', (isset($contrato->inmueble->direccion)?$contrato->inmueble->direccion:''), ['class' => 'form-control m-input disabled txt-a-center', 'placeholder' => 'Direccion del Inmueble','disabled', 'required', 'id' => 'formContratoDireccion']) !!}
                  <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip m-left-5 addInmueble" data-toggle="modal" data-target="#_formInmueble" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo">
                    <i class="fa fa-plus"></i>
                  </a>
                  <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip m-left-5 searchInmueble" data-toggle="modal" data-target="#_buscarInmueble" data-skin="dark" data-placement="top" title="" data-original-title="Buscar">
                    <i class="fa fa-search"></i>
                  </a>
                </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              {!! Form::label('inicio', 'Fecha de Inicio') !!}
              <div class="input-group date">
                {!! Form::text('inicio', $contrato->inicio, ['class' => 'form-control m-input', 'tabindex' => '1', 'placeholder' => 'Inicio del Contrato', 'required', 'id' => 'formContratoInicio']) !!}
                <span class="input-group-addon">
                  <i class="la la-calendar"></i>
                </span>
              </div>  
            </div>
            <div class="col-lg-4">
              {!! Form::label('fin', 'Fecha de Finalizacion') !!}
              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    +
                  </button>
                  <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -191px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" onClick="addMonthToFin(3)">
                      3 meses
                    </a>
                    <a class="dropdown-item" onClick="addMonthToFin(6)">
                      6 meses
                    </a>
                    <a class="dropdown-item" onClick="addMonthToFin(12)">
                      1 a&ntilde;o
                    </a>
                    <a class="dropdown-item" onClick="addMonthToFin(24)">
                      2 a&ntilde;os
                    </a>
                    <a class="dropdown-item" onClick="addMonthToFin(36)">
                      3 a&ntilde;os
                    </a>
                    <a class="dropdown-item" onClick="addMonthToFin(48)">
                      4 a&ntilde;os
                    </a>
                  </div>
                </div>
                {!! Form::text('fin', $contrato->fin, ['class' => 'form-control m-input date', 'tabindex' => '2', 'placeholder' => 'Fin del Contrato', 'required', 'id' => 'formContratoFin']) !!}
                <span class="input-group-addon">
                  <i class="la la-calendar"></i>
                </span>
              </div>
            </div>
            <div class="col-lg-4">
              {!! Form::label('rescision', 'Fecha de Rescisión') !!}
              <div class="input-group date">
                {!! Form::text('rescision', $contrato->rescision, ['class' => 'form-control m-input', 'placeholder' => 'Rescision del Contrato','disabled' => 'disabled']) !!}
                <span class="input-group-addon">
                  <i class="la la-calendar"></i>
                </span>
              </div>  
            </div>
          </div>   
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              <div class="col-lg-12 m-left-porc-10">
                {!! Form::label('propitarios', 'Propietarios') !!}
                <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip addPersona" data-toggle="modal" data-target="#_formPersona" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo" data-field="propietarios">
                  <i class="fa fa-plus"></i>
                </a>
                <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip searchPersona" data-toggle="modal" data-target="#_buscarPersona" data-skin="dark" data-placement="top" title="" data-original-title="Buscar" data-field="propietarios">
                  <i class="fa fa-search"></i>
                </a>
              </div>
              <div class="col-lg-12 propietariosContrato">
                @isset($propietarios)
                  @foreach ($propietarios as $propietario)
                    <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">
                      <input type="hidden" name="propietarios[]" value="{{ $propietario->id }}">
                      <div class="card-header">{{ $propietario->getFullName() }}</div>
                      <div class="card-body">
                        <p class="cardNombre"></p>
                        <p class="cardTelefono"><i class="la la-phone"></i>{{ $propietario->telefono ? $propietario->telefono : 'Sin dato' }}</p>
                        <p class="cardTelefono"><i class="la la-mobile-phone"></i> {{ $propietario->celular ? $propietario->celular : 'Sin dato' }}</p>
                        <p class="cardEmail"><i class="la la-envelope"></i> {{ $propietario->email ? $propietario->email : 'Sin dato' }}</p>
                        <p>
                          <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom editarPersona" data-remote="{{ route('personas.show',$propietario->id) }}">Ver</button>
                          <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom deleteCard">Eliminar</button>
                        </p>
                      </div>
                    </div>
                  @endforeach
                @endisset
              </div>  
            </div>  
            <div class="col-lg-4">
              <div class="col-lg-12 m-left-porc-10">
                {!! Form::label('inquilinos', 'Inquilinos') !!}
                <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip addPersona" data-toggle="modal" data-target="#_formPersona" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo" data-field="inquilinos">
                  <i class="fa fa-plus"></i>
                </a>
                <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip searchPersona" data-toggle="modal" data-target="#_buscarPersona" data-skin="dark"\ data-placement="top" title="" data-original-title="Buscar" data-field="inquilinos">
                  <i class="fa fa-search"></i>
                </a>
              </div>
              <div class="col-lg-12 inquilinosContrato">
                @isset($inquilinos)
                  @foreach ($inquilinos as $inquilino)
                    <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">
                      <input type="hidden" name="inquilinos[]" value="{{ $inquilino->id }}">
                      <div class="card-header">{{ $inquilino->getFullName() }}</div>
                      <div class="card-body">
                        <p class="cardNombre"></p>
                        <p class="cardTelefono"><i class="la la-phone"></i>{{ $inquilino->telefono ? $inquilino->telefono : 'Sin dato'}}</p>
                        <p class="cardTelefono"><i class="la la-mobile-phone"></i> {{ $inquilino->celular ? $inquilino->celular : 'Sin dato' }}</p>
                        <p class="cardEmail"><i class="la la-envelope"></i> {{ $inquilino->email ? $inquilino->email : 'Sin dato' }}</p>
                        <p>
                          <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom editarPersona" data-remote="{{ route('personas.show',$inquilino->id) }}">Ver</button>
                          <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom deleteCard">Eliminar</button>
                        </p>
                      </div>
                    </div>
                  @endforeach
                @endisset
              </div>  
            </div> 
            <div class="col-lg-4">
              <div class="col-lg-12 m-left-porc-10">
                {!! Form::label('garantes', 'Garantes') !!}
                <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip addPersona" data-toggle="modal" data-target="#_formPersona" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo" data-field="garantes">
                  <i class="fa fa-plus"></i>
                </a>
                <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip searchPersona" data-toggle="modal" data-target="#_buscarPersona" data-skin="dark" data-placement="top" title="" data-original-title="Buscar" data-field="garantes">
                  <i class="fa fa-search"></i>
                </a> 
              </div>
              <div class="col-lg-12 garantesContrato">
                @isset($garantes)
                  @foreach ($garantes as $garante)
                    <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">
                      <input type="hidden" name="garantes[]" value="{{ $garante->id }}">
                      <div class="card-header">{{ $garante->getFullName() }}</div>
                      <div class="card-body">
                        <p class="cardNombre"></p>
                        <p class="cardTelefono"><i class="la la-phone"></i>{{ $garante->telefono ? $garante->telefono : 'Sin dato' }}</p>
                        <p class="cardTelefono"><i class="la la-mobile-phone"></i> {{ $garante->celular ? $garante->celular : 'Sin dato' }}</p>
                        <p class="cardEmail"><i class="la la-envelope"></i> {{ $garante->email ? $garante->email : 'Sin dato' }}</p>
                        <p>
                          <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom editarPersona" data-remote="{{ route('personas.show',$garante->id) }}">Ver</button>
                          <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom deleteCard">Eliminar</button>
                        </p>
                      </div>
                    </div>
                  @endforeach
                @endisset
              </div>  
            </div>
          </div>   
        </div>
        <div class="tab-pane" id="montos" role="tabpanel">
          <div class="form-group m-form__group row">
            <div class="col-lg-4">
              {!! Form::label('montos', 'Monto de Inicio') !!}
              <div class="input-group mb-3">
                <div class="input-group-prepend-select">
                  {!! Form::select('moneda_id', $monedas, $contrato->moneda_id, ['class' => 'form-control col-xs-2 m-select2', 'tabindex' => '3', 'required'])!!}
                </div>
                {!! Form::text('monto', isset($montos[0]->monto) ? $montos[0]->monto:'', ['class' => 'form-control', 'tabindex' => '4', 'required', 'placeholder' => 'Monto', 'id' => 'monto_inicial']) !!}
              </div>
            </div>
            <div class="col-lg-4">
              {!! Form::label('cada', 'Escalonamiento') !!}
              <div class="input-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">
                    Rango
                  </span>
                  {!! Form::text('cada', $contrato->cada, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Meses', 'maxlength' => '2', 'id' => 'formContratoCada']) !!}
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">
                    %
                  </span>
                  {!! Form::text('porcentaje', $contrato->porcentaje, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Porcentaje']) !!}
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              {!! Form::label('monto_garantia', 'Monto de Garantia') !!}
              <div class="input-group mb-3">
                <div class="input-group-prepend-select">
                  {!! Form::select('moneda_garantia', $monedas, $contrato->moneda_garantia, ['class' => 'form-control m-input'])!!}
                </div>
                {!! Form::text('monto_garantia', $contrato->monto_garantia, ['class' => 'form-control m-input', 'placeholder' => 'Monto']) !!}
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row montosContrato">
            @isset($montos)
              @php $i=1; @endphp
              @foreach ($montos as $monto)
                <div class="col-lg-3">
                  <input type="hidden" name="montos[{{ $i }}][monto]" value="{{ $monto->monto }}">
                  <input type="hidden" name="montos[{{ $i }}][desde]" value="{{ $monto->desde }}">
                  <input type="hidden" name="montos[{{ $i }}][hasta]" value="{{ $monto->hasta }}">
                  <div class="card border-danger mb-3" id="cardMonto" style="max-width: 18rem;">
                  <div class="card-header">Periodo {{ $i }}</div>
                  <div class="card-body text-danger">
                    <h5 class="card-title">
                      <div class="modificarMonto" data-id="{{ $monto->id }}" id="monto_{{ $monto->id }}">
                          <a class="m-tooltip"  data-skin="dark" data-placement="top" title="Modificar monto">
                              <b>{{ $monto->monto }}</b>
                          </a>
                      </div>
                      <div style="display: none" id="monto_input_{{ $monto->id }}">
                        <div class="input-group">
                          {!! Form::text('', null, ['class' => 'form-control m-input input-medium', 'placeholder' => $monto->monto, 'id' => 'monto_value_'.$monto->id]) !!}
                          <span class="input-group-addon" id="basic-addon1">
                            <a class="m-tooltip guardarMonto" data-id="{{ $monto->id }}" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Guardar monto">
                                <i class="la la-save"></i>
                            </a>
                          </span>
                        </div>
                      </div>
                    </h5>
                    <p class="card-text">Desde: {{ $monto->desde }}</p>
                    <p class="card-text">Hasta: {{ $monto->hasta }}</p>
                  </div>
                </div>
                </div>
                @php $i++; @endphp
              @endforeach
            @endisset
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-12">
              {!! Form::label('interes', 'Punitorios') !!}
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-3">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  %
                </span>
                {!! Form::text('interes', $contrato->interes, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Porcentaje']) !!}
              </div>
            </div>
            <div class="col-lg-3">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  Vencimiento
                </span>
                {!! Form::text('interes_vencimiento', $contrato->interes_vencimiento, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Dia venc.']) !!}
              </div>
            </div>
            <div class="col-lg-3">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  Inicio
                </span>
                {!! Form::text('interes_inicio', $contrato->interes_inicio, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Dia inicio']) !!}
              </div>
            </div>
            <div class="col-lg-3">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  Monto Fijo
                </span>
                {!! Form::text('interes_fijo', $contrato->interes_fijo, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Monto']) !!}
              </div>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-12">
              {!! Form::label('honorarios', 'Honorarios') !!}
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-3">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  %
                </span>
                {!! Form::text('honorarios', $contrato->honorarios, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Porcentaje', 'required']) !!}
              </div>
            </div>
            <div class="col-lg-3">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  Monto Fijo
                </span>
                {!! Form::text('honorarios_fijos', $contrato->honorarios_fijos, ['class' => 'form-control m-input input-medium', 'placeholder' => 'Monto']) !!}
              </div>
            </div>
          </div>
        </div>
       <!--  <div class="tab-pane" id="partidas" role="tabpanel">
        </div> -->
        <div class="tab-pane" id="avanzados" role="tabpanel">
          <div class="m-form__section m-form__section--first">
            <div class="m-form__heading">
              <h3 class="m-form__heading-title">
                Movimientos
              </h3>
            </div> 
            <div class="form-group m-form__group row">
              <div class="col-lg-3">
                {!! Form::label('caja_id', 'Caja') !!}
                {!! Form::select('caja_id', $cajas, $contrato->caja_id, ['class' => 'form-control m-input', 'tabindex' => '5', 'required'])!!}
              </div>
              <div class="col-lg-3">
                {!! Form::label('cuenta_ingreso_id', 'Cuenta de Ingresos') !!}
                {!! Form::select('cuenta_ingreso_id', $cuentas, $contrato->cuenta_ingreso_id, ['class' => 'form-control m-input', 'tabindex' => '6', 'required'])!!}
              </div>
              <div class="col-lg-3">
                {!! Form::label('cuenta_egreso_id', 'Cuenta de Egreso') !!}
                {!! Form::select('cuenta_egreso_id', $cuentas, $contrato->cuenta_egreso_id, ['class' => 'form-control m-input', 'tabindex' => '7', 'required'])!!}
              </div>
              <div class="col-lg-3">
                {!! Form::label('cuenta_honorarios_id', 'Cuenta de Honorarios') !!}
                {!! Form::select('cuenta_honorarios_id', $cuentas, $contrato->cuenta_honorarios_id, ['class' => 'form-control m-input', 'tabindex' => '8', 'required'])!!}
              </div>
            </div>
          </div>
          <div class="m-form__section m-form__section--first">
            <div class="m-form__heading">
              <h3 class="m-form__heading-title">
                Variantes
              </h3>
            </div> 
            <div class="form-group m-form__group row">
              <div class="col-lg-4 m-checkbox-inline">
                <label for="imputa_iva" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Imputa I.V.A. al monto del periodo
                  {!! Form::checkbox('imputa_iva', $contrato->imputa_iva, $contrato->imputa_iva, ['class' => 'form-control m-input', 'id' =>'imputa_iva'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="imputa_iva_honorarios" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Imputa I.V.A. a los honorarios del propietario
                  {!! Form::checkbox('imputa_iva_honorarios', $contrato->imputa_iva_honorarios, $contrato->imputa_iva_honorarios, ['class' => 'form-control m-input', 'id' =>'imputa_iva_honorarios'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="imputa_iva_punitorios" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Imputa I.V.A. sobre los punitorios
                  {!! Form::checkbox('imputa_iva_punitorios', $contrato->imputa_iva_punitorios, $contrato->imputa_iva_punitorios, ['class' => 'form-control m-input', 'id' =>'imputa_iva_punitorios'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="punitorios_administracion" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Imputa punitorios a la administracion
                  {!! Form::checkbox('punitorios_administracion', $contrato->punitorios_administracion, $contrato->punitorios_administracion, ['class' => 'form-control m-input', 'id' =>'punitorios_administracion'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="honorarios_sobre_cobrado" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Calcula honorarios sobre lo cobrado 
                  {!! Form::checkbox('honorarios_sobre_cobrado', $contrato->honorarios_sobre_cobrado, $contrato->honorarios_sobre_cobrado, ['class' => 'form-control m-input', 'id' =>'honorarios_sobre_cobrado'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="honorarios_sobre_punitorios" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Calcula honorarios sobre los punitorios
                  {!! Form::checkbox('honorarios_sobre_punitorios', $contrato->honorarios_sobre_punitorios, $contrato->honorarios_sobre_punitorios, ['class' => 'form-control m-input', 'id' =>'honorarios_sobre_punitorios'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="punitorios_habil" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Imputa punitorios en dia habil
                  {!! Form::checkbox('punitorios_habil', $contrato->punitorios_habil, $contrato->punitorios_habil, ['class' => 'form-control m-input', 'id' =>'punitorios_habil'])!!}
                  <span></span>
                </label>
              </div>
              <div class="col-lg-4 m-checkbox-inline">
                <label for="interes_acumulativo" class="m-checkbox m-checkbox--solid m-checkbox--brand">
                  Calcula punitorios de forma acumulativa
                  {!! Form::checkbox('interes_acumulativo', $contrato->interes_acumulativo, $contrato->interes_acumulativo, ['class' => 'form-control m-input', 'id' =>'interes_acumulativo'])!!}
                  <span></span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane textarea-contrato" id="notas" role="tabpanel">
          {!! Form::textarea('notas', $contrato->notas, ['class' => 'form-control m-input'])!!}
        </div>
        <div class="tab-pane" id="gestion" role="tabpanel">
          <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
            <!--begin::Item-->
            <div class="m-accordion__item">
              <div class="m-accordion__item-head collapse collapsed"  role="tab" id="m_accordion_1_item_1_head" data-toggle="collapse" href="#m_accordion_1_item_1_body" aria-expanded="  false">
                <span class="m-accordion__item-icon">
                  <i class="fa flaticon-medical"></i>
                </span>
                <span class="m-accordion__item-title">
                  Cobros
                  <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip" data-skin="dark" data-placement="top" title="" onclick="generarCuotas()" data-original-title="Generar Cuotas">
                    <i class="fa fa-refresh"></i>
                  </button>
                  <button type="button" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip" data-skin="dark" data-placement="top" title="" onclick="eliminarCuotas()" data-original-title="Eliminar Cuotas">
                    <i class="fa fa-trash"></i>
                  </button>
                </span>
                <span class="m-accordion__item-mode">
                  <i class="la la-plus"></i>
                </span>
              </div>
              <div class="m-accordion__item-body collapse" id="m_accordion_1_item_1_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_1_head" data-parent="#m_accordion_1">
                <!--begin::Content-->
                <div class="tab-content  m--padding-30">
                  <div class="form-group m-form__group row contratoCuotas">
                  @isset($cobros)
                    @php $i=1; @endphp
                    @foreach ($cobros as $cuota)
                    <div class="col-lg-3">
                      <div class="card border-warning mb-3" id="cardImpuesto" style="max-width: 18rem;">
                          <div class="card-header">{{ ($cuota->is_deuda) ? 'Deuda' : 'Cuota '.$i }}</div>
                          <div class="card-body">
                            <p class="card-text">{{$meses[$cuota->mes].' '.$cuota->ano }}</p>
                            <p class="card-text text-danger">Monto: {{ $cuota->monto }}</p>
                            <p class="card-text text-danger">Honorarios: {{ $cuota->honorarios }}</p>
                            @if (!$cuota->liquidado)
                              <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--pill m-tooltip setLiquidado" data-skin="dark" data-placement="bottom" title="" data-id="{{ $cuota->id }}" data-original-title="Marcar como Cobrado">
                                <i class="fa fa-check"></i>
                              </a>
                            @endif
                          </div>
                      </div>
                    </div>
                    @php $i = ((!$cuota->is_deuda) ? $i+1 : $i)  @endphp
                    @endforeach
                  @endisset
                  </div>
                </div>
                <!--end::Section-->
              </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="m-accordion__item">
              <div class="m-accordion__item-head collapse collapsed" role="tab" id="m_accordion_1_item_2_head" data-toggle="collapse" href="#m_accordion_1_item_2_body" aria-expanded="    false">
                <span class="m-accordion__item-icon">
                  <i class="fa  flaticon-medical"></i>
                </span>
                <span class="m-accordion__item-title">
                  Pagos
                </span>
                <span class="m-accordion__item-mode">
                  <i class="la la-plus"></i>
                </span>
              </div>
              <div class="m-accordion__item-body collapse" id="m_accordion_1_item_2_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_2_head" data-parent="#m_accordion_1">
                <!--begin::Content-->
                <div class="tab-content  m--padding-30">
                </div>
                <!--end::Content-->
              </div>
            </div>
            <!--end::Item--> 
            <!--begin::Item-->
            <div class="m-accordion__item">
              <div class="m-accordion__item-head collapse collapsed" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="true">
                <span class="m-accordion__item-icon">
                  <i class="fa flaticon-medical"></i>
                </span>
                <span class="m-accordion__item-title">
                  Gastos
                  <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip nuevoGasto" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo Gasto">
                    <i class="fa fa-plus"></i>
                  </button>
                </span>
                <span class="m-accordion__item-mode">
                  <i class="la la-plus"></i>
                </span>
              </div>
              <div class="m-accordion__item-body collapse" id="m_accordion_1_item_3_body" role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_3" style="">
                <!--begin::Content-->
                <div class="tab-content  m--padding-30">
                  <div class="form-group m-form__group row  listGastos">
                    @isset($gastos)
                      @foreach ($gastos as $gasto)
                        <div class="col-lg-4">
                          <div class="card border-warning mb-3" id="cardGasto" style="max-width: 18rem;">
                              <div class="card-header"><button type="button" data-id="{{$gasto->id}}" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-edit-gasto editarGasto" data-skin="dark" data-placement="top" title="" data-original-title="Editar Gasto">
                            <i class="fa fa-edit"></i>  
                          </button>{{ $gasto->concepto->nombre }}</div>
                              <div class="card-body">
                                <p class="card-text">{{ $meses[$gasto->cobro->mes].' '.$gasto->cobro->ano }}</p>
                                <p class="card-text">Encargado: {{ $tiposPersonaGasto[$gasto->encargado] }}</p>
                                <p class="card-text">Pagado por {{ $tiposPersonaGasto[$gasto->pagado_por] }}</p>
                                <p class="card-text text-danger">Monto: {{ $gasto->monto }}</p>
                              </div>
                          </div>
                        </div>
                      @endforeach
                    @endisset
                  </div>
                </div>
                <!--end::Section-->
              </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="m-accordion__item">
              <div class="m-accordion__item-head collapse collapsed" role="tab" id="m_accordion_1_item_4_head" data-toggle="collapse" href="#m_accordion_1_item_4_body" aria-expanded="true">
                <span class="m-accordion__item-icon">
                  <i class="fa flaticon-medical"></i>
                </span>
                <span class="m-accordion__item-title">
                  Impuestos
                  <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip nuevoImpuesto" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo Impuesto">
                    <i class="fa fa-plus"></i>
                  </button>
                </span>
                <span class="m-accordion__item-mode">
                  <i class="la la-plus"></i>
                </span>
              </div>
              <div class="m-accordion__item-body collapse" id="m_accordion_1_item_4_body" role="tabpanel" aria-labelledby="m_accordion_1_item_4_head" data-parent="#m_accordion_4" style="">
                <!--begin::Content-->
                <div class="tab-content  m--padding-30">
                  <div class="form-group m-form__group row listImpuestos">
                    @isset($impuestos)
                      @foreach ($impuestos as $impuesto)
                        <div class="col-lg-4">
                          <div class="card border-success mb-3" id="cardImpuesto" style="max-width: 18rem;">
                              <div class="card-header">
                                <button type="button" data-id="{{$impuesto->id}}" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-edit-impuesto editarImpuesto" data-skin="dark" data-placement="top" title="" data-original-title="Editar Impuesto">
                                  <i class="fa fa-edit"></i>  
                               </button>
                              {{ $impuesto->servicio->nombre }}
                              </div>
                              <div class="card-body">
                                <p class="card-text">{{ $meses[$impuesto->cobro->mes].' '.$impuesto->cobro->ano }}</p>
                                <p class="card-text text-danger">Monto: {{ $impuesto->monto }}</p>
                              </div>
                          </div>
                        </div>
                      @endforeach
                    @endisset
                  </div>
                </div>
                <!--end::Section-->
              </div>
            </div>
            <!--end::Item-->
          </div>
        </div>
      </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
      <div class="m-form__actions m-form__actions--solid">
        <div class="row">
          <div class="col-lg-12 centerText">
            {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
            <a href="{{ route('contratos.index') }}" class="btn btn-secondary"> Volver</a>
          </div>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  </div>
</div>
<!--Modals -->
@include('personas.modal._search')
@include('inmuebles.modal._search')
@include('inmuebles.modal._form')
@include('gastos.modal._form', ['periodos' => (isset($periodos))?$periodos:array()])
@include('impuestos.modal._form', ['periodos' => (isset($periodos))?$periodos:array()])
@endsection

