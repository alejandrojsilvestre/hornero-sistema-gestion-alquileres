@extends('layouts.app')

@section('title')
  {{ (($cobro->liquidado)?'Ver':'Nuevo').' Cobro' }}
@endsection

@section('breadcrumbs')
  {{Breadcrumbs::render('gestiones')}}
@endsection

@section('assets')
<script src="{{ asset('js/gestiones.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/gastos.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/cheques.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/transferencias.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/impuestos.js?' . time()) }}" type="text/javascript"></script>
<script src="{{ asset('js/wizard.js?' . time()) }}" type="text/javascript"></script>
@endsection

@section('content')
@if($cobro->liquidado)
<div class="m-alert m-alert--icon m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">
  <div class="m-alert__icon">
    <i class="la la-warning"></i>
  </div>
  <div class="m-alert__text">
    <strong>
      Info:
    </strong>
    Esta visualizando un cobro para poder liquidar al propietario. <strong>No se podra realizar ningun cambio sobre los valores, forma de pago, gastos o impuestos.</strong>
  </div>
  <div class="m-alert__close">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
@endif
{!! Form::open(['id' => 'm_form' ,'autocomplete'=>'off','class' => 'm-form m-form--label-align-left- m-form--state-']) !!}
<div class="m-portlet m-portlet--mobile hide valoresCobro p-0">
  <div class="m-portlet__body p-1">
    <div class="m-form m-form--label-align-right m--margin-top-5 m--margin-bottom-5">
      <div class="form-group m-form__group row">
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('monto', 'Monto de Alquiler') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('monto', $cobro->monto, ['class' => 'form-control m-input', 'disabled' => '', 'id' => 'montoPeriodo']) !!}
          </div>
        </div>
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('punitorio', 'Punitorios') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('punitorio', $cobro->punitorio, ['class' => 'form-control m-input']) !!}
          </div>
        </div>
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('gastos_inquilinos', 'Gastos Inquilino') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('gastos_inquilinos', isset($totalGastoInq)? $totalGastoInq : '', ['class' => 'form-control m-input', 'disabled' => '']) !!}
          </div>
        </div>
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('monto_total', 'Monto a Cobrar') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('monto_total', $cobro->monto_total, ['class' => 'form-control m-input disabled']) !!}
          </div>
        </div>
      </div>
      <div class="form-group m-form__group row">
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('gastos_propietarios', 'Gastos propietario') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('gastos_propietarios', isset($totalGastoPro)? $totalGastoPro : '', ['class' => 'form-control m-input', 'disabled' => '']) !!}
          </div>
        </div>
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('honorarios', 'Honorarios') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('honorarios', $cobro->honorarios, ['class' => 'form-control m-input disabled']) !!}
          </div>
        </div>
        <div class="col-lg-3 col-lg-3-small">
          {!! Form::label('monto_pagar', 'Monto a Pagar') !!}
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon moneda">
            </span>
            {!! Form::text('monto_pagar', $cobro->monto_pagar, ['class' => 'form-control m-input disabled']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="m-portlet m-portlet--mobile">
  <!--begin: Portlet Body-->
  <div class="m-portlet__body m-portlet__body--no-padding">
    <!--begin: Form Wizard-->
    <div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
      <!--begin: Message container -->
      <div class="m-portlet__padding-x">
        <!-- Here you can put a message or alert -->
      </div>
      <!--end: Message container -->
      <div class="row m-row--no-padding">
        <div class="col-xl-3 col-lg-12 steps-nav">
          <!--begin: Form Wizard Head -->
          <div class="m-wizard__head">
            <!--begin: Form Wizard Progress -->
            <div class="m-wizard__progress">
              <div class="progress">
                <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <!--end: Form Wizard Progress --> 
            <!--begin: Form Wizard Nav -->
            <div class="m-wizard__nav">
              <div class="m-wizard__steps">
                <div class="m-wizard__step m-wizard__step--current" data-wizard-target="#m_wizard_form_step_1">
                  <div class="m-wizard__step-info">
                    <a href="#" class="m-wizard__step-number">
                      <span>
                        <span>
                          1
                        </span>
                      </span>
                    </a>
                    <div class="m-wizard__step-line">
                      <span></span>
                    </div>
                    <div class="m-wizard__step-label">
                      Contrato
                    </div>
                  </div>
                </div>
                <div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_2">
                  <div class="m-wizard__step-info">
                    <a href="#" class="m-wizard__step-number">
                      <span>
                        <span>
                          2
                        </span>
                      </span>
                    </a>
                    <div class="m-wizard__step-line">
                      <span></span>
                    </div>
                    <div class="m-wizard__step-label">
                      Gastos/Impuestos
                    </div>
                  </div>
                </div>
                <div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_3">
                  <div class="m-wizard__step-info">
                    <a href="#" class="m-wizard__step-number">
                      <span>
                        <span>
                          3
                        </span>
                      </span>
                    </a>
                    <div class="m-wizard__step-line">
                      <span></span>
                    </div>
                    <div class="m-wizard__step-label">
                      Forma de Cobro
                    </div>
                  </div>
                </div>
                <div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_4">
                  <div class="m-wizard__step-info">
                    <a href="#" class="m-wizard__step-number">
                      <span>
                        <span>
                          4
                        </span>
                      </span>
                    </a>
                    <div class="m-wizard__step-line">
                      <span></span>
                    </div>
                    <div class="m-wizard__step-label">
                      Liquidar
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end: Form Wizard Nav -->
          </div>
          <!--end: Form Wizard Head -->
        </div>
        <div class="col-xl-9 col-lg-12">
          <!--begin: Form Wizard Form-->
          <div class="m-wizard__form">
              <!--begin: Form Body -->
              <div class="m-portlet__body m-portlet__body--no-padding">
                <!--begin: Form Wizard Step 1-->
                <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                  <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                      <h3 class="m-form__heading-title">
                        Datos de Contrato
                      </h3>
                    </div>
                    <div class="form-group m-form__group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">
                        Contrato:
                      </label>
                      <div class="col-xl-6 col-lg-6">
                        {!! Form::hidden('contrato_id', $cobro->contrato_id, ['required']) !!}
                        {!! Form::text('direccionContrato', isset($cobro->contrato->inmueble->direccion) ? $cobro->contrato->inmueble->direccion :'', ['class' => 'form-control m-input', 'placeholder' => '','required', 'onkeyup' => 'this.value=""', 'disabled']) !!}
                        <span class="m-form__help">
                          Seleccionar Contrato
                        </span>
                      </div>
                      <div class="col-xl-2 col-lg-1">
                        @if(!$cobro->liquidado)
                        <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip searchContrato" data-toggle="modal" data-target="#_buscarContrato" data-skin="dark" data-placement="top" title="" data-original-title="Buscar Contrato" data-field="contrato">
                          <i class="fa fa-search"></i>
                        </a>
                        @endif
                        <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip verContrato" data-skin="dark" data-placement="top" title="" data-original-title="Ver Contrato">
                          <i class="fa fa-eye"></i>
                        </a>
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">
                        Periodo:
                      </label>
                      <div class="col-xl-4 col-lg-4">
                        {!! Form::select('cobro_id', isset($periodo) ? $periodo : [], $cobro->id, ['class' => 'form-control col-xs-2 m-select2 periodos', 'required'])!!}
                        <span class="m-form__help">
                          Seleccionar Periodo
                        </span>
                      </div>
                  	</div>
                  	<div class="form-group m-form__group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">
                        Fecha:
                      </label>
                      <div class="col-xl-3 col-lg-3">
            						<div class="input-group date">
            							<span class="input-group-addon">
            								<i class="la la-calendar"></i>
            							</span>
            							{!! Form::text('fecha', $cobro->fecha, ['class' => 'form-control m-input', 'placeholder' => '','id'=>'fecha', 'required']) !!}
            						</div>	
                        <span class="m-form__help">
                          Fecha de cobro
                        </span>
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">
                        Propietarios:
                      </label>
                      <div class="col-xl-6 col-lg-6">
                        {!! Form::text('propietarios', isset($propietarios) ? implode(',',$namePropietarios):'', ['class' => 'form-control m-input', 'placeholder' => '', 'disabled']) !!}
                        <span class="m-form__help">
                          Datos de los Propietarios
                        </span>
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">
                        Inquilinos:
                      </label>
                      <div class="col-xl-6 col-lg-6">
                        {!! Form::text('inquilinos', isset($inquilinos) ? implode(',',$inquilinos):'', ['class' => 'form-control m-input', 'placeholder' => '', 'disabled']) !!}
                        <span class="m-form__help">
                          Datos de los Inquilinos
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <!--end: Form Wizard Step 1-->
                <!--begin: Form Wizard Step 2-->
                <div class="m-wizard__form-step" id="m_wizard_form_step_2">
                  <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                      <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist"> 
                        <!--begin::Item-->
                        <div class="m-accordion__item">
                          <div class="m-accordion__item-head collapse" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="true">
                            <span class="m-accordion__item-title">
                              Gastos
                              @if(!$cobro->liquidado)
                              <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip nuevoGasto" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo Gasto">
                                <i class="fa fa-plus"></i>
                              </button>
                              @endif
                            </span>
                            <span class="m-accordion__item-mode">
                              <i class="la la-plus"></i>
                            </span>
                          </div>
                          <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_3_body" role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_3" style="">
                            <!--begin::Content-->
                            <div class="tab-content  m--padding-30">
                              <div class="form-group m-form__group row listGastos">
                                @isset($gastos_liquidados)
                                  @foreach ($gastos_liquidados as $gasto_liquidado)
                                    <div class="col-lg-4">
                                      <div class="card border-warning mb-3" id="cardGasto" style="max-width: 18rem;">
                                          <div class="card-header">{{ $gasto_liquidado->concepto->nombre }}</div>
                                          <div class="card-body">
                                            <p class="card-text">{{ $meses[$gasto_liquidado->cobro->mes].' '.$gasto_liquidado->cobro->ano }}</p>
                                            <p class="card-text">Encargado: {{ $tiposPersonaGasto[$gasto_liquidado->encargado] }}</p>
                                            <p class="card-text">Pagado por {{ $tiposPersonaGasto[$gasto_liquidado->pagado_por] }}</p>
                                            <p class="card-text text-danger">Monto: {{ $gasto_liquidado->monto }}</p>
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
                          <div class="m-accordion__item-head collapse" role="tab" id="m_accordion_1_item_4_head" data-toggle="collapse" href="#m_accordion_1_item_4_body" aria-expanded="true">
                            <span class="m-accordion__item-title">
                              Impuestos
                              @if(!$cobro->liquidado)
                              <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip nuevoImpuesto" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo Impuesto">
                                <i class="fa fa-plus"></i>
                              </button>
                              @endif
                            </span>
                            <span class="m-accordion__item-mode">
                              <i class="la la-plus"></i>
                            </span>
                          </div>
                          <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_4_body" role="tabpanel" aria-labelledby="m_accordion_1_item_4_head" data-parent="#m_accordion_4" style="">
                            <!--begin::Content-->
                            <div class="tab-content  m--padding-30">
                              <div class="form-group m-form__group row listImpuestos">
                                @isset($impuestos_entregados)
                                  @foreach ($impuestos_entregados as $impuesto_entregado)
                                    <div class="col-lg-4">
                                      <div class="card border-success mb-3" id="cardImpuesto" style="max-width: 18rem;">
                                          <div class="card-header">
                                          {{ $impuesto_entregado->servicio->nombre }}
                                          </div>
                                          <div class="card-body">
                                            <p class="card-text">{{ $meses[$impuesto_entregado->cobro->mes].' '.$impuesto_entregado->cobro->ano }}</p>
                                            <p class="card-text text-danger">Monto: {{ $impuesto_entregado->monto }}</p>
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
                <!--end: Form Wizard Step 2-->
                <!--begin: Form Wizard Step 3-->
                <div class="m-wizard__form-step" id="m_wizard_form_step_3">
                  <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                      <h3 class="m-form__heading-title">
                        Montos
                      </h3>
                    </div>
                    <div class="form-group m-form__group row">
                      <div class="col-lg-4">
                        {!! Form::label('monto_pagado', 'Monto a Abonar') !!}
                        <div class="input-group m-input-group m-input-group--square">
                          <span class="input-group-addon moneda">
                          </span>
                          {!! Form::text('monto_pagado', $cobro->monto_pagado, ['class' => 'form-control m-input']) !!}
                        </div>
                      </div>
                      <div class="col-lg-4">
                        {!! Form::label('monto_deuda', 'Monto de Deuda') !!}
                        <div class="input-group m-input-group m-input-group--square">
                          <span class="input-group-addon moneda">
                          </span>
                          {!! Form::text('monto_deuda', $cobro->monto_deuda, ['class' => 'form-control m-input disabled']) !!}
                        </div>
                      </div>
                      <!-- <div class="col-lg-4">
                        {!! Form::label('monto_tope', 'Monto de Tope (Pagare)') !!}
                        <div class="input-group m-input-group m-input-group--square">
                          <span class="input-group-addon moneda">
                          </span>
                          {!! Form::text('monto_tope', $cobro->monto_tope, ['class' => 'form-control m-input']) !!}
                        </div>
                      </div> -->
                    </div>
                  </div>
                  <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                      <h3 class="m-form__heading-title">
                        Forma de pago
                      </h3>
                    </div>
                    <div class="form-group m-form__group row">
                      <div class="m-accordion m-accordion--default" id="m_accordion_2" role="tablist"> 
                        <!--begin::Item-->
                        <div class="m-accordion__item">
                          <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_3_head" data-toggle="collapse" href="#m_accordion_2_item_3_body" aria-expanded="true">
                            <span class="m-accordion__item-title">
                              Cheques
                              @if(!$cobro->liquidado)
                              <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip nuevoCheque" data-toggle="modal" data-target="#_formCheque" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo Cheque">
                                <i class="fa fa-plus"></i>
                              </button>
                              @endif
                            </span>
                            <span class="m-accordion__item-mode">
                              <i class="la la-plus"></i>
                            </span>
                          </div>
                          <div class="m-accordion__item-body collapse" id="m_accordion_2_item_3_body" role="tabpanel" aria-labelledby="m_accordion_2_item_3_head" data-parent="#m_accordion_3" style="">
                            <!--begin::Content-->
                            <div class="tab-content  m--padding-30">
                              <div class="form-group m-form__group row listCheques">
                                @isset($cheques)
                                  @foreach ($cheques as $cheque)
                                    <div class="col-lg-12">
                                      <input type="hidden" value="'+data.id+'" name="cheques[]">
                                      <div class="card border-info mb-3" id="cardCheque">
                                          <div class="card-header">{{ $cheque->banco->nombre }}</div>
                                          <div class="card-body">
                                            <p class="card-text">Fecha: {{ $cheque->fecha }}</p>
                                            <p class="card-text">Cuenta: {{ $cheque->nro_cuenta }}</p>
                                            <p class="card-text">Nro: {{ $cheque->nro_cheque }}</p>
                                            <p class="card-text text-danger">Monto: {{ $cheque->monto }}</p>
                                          </div>\
                                      </div>\
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
                          <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_4_head" data-toggle="collapse" href="#m_accordion_2_item_4_body" aria-expanded="true">
                            <span class="m-accordion__item-title">
                              Transferencias
                              @if(!$cobro->liquidado)
                              <button type="button" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip nuevaTransferencia"  data-toggle="modal" data-target="#_formTransferencia" data-skin="dark" data-placement="top" title="" data-original-title="Nueva Transferencia">
                                <i class="fa fa-plus"></i>
                              </button>
                              @endif
                            </span>
                            <span class="m-accordion__item-mode">
                              <i class="la la-plus"></i>
                            </span>
                          </div>
                          <div class="m-accordion__item-body collapse" id="m_accordion_2_item_4_body" role="tabpanel" aria-labelledby="m_accordion_2_item_4_head" data-parent="#m_accordion_4" style="">
                            <!--begin::Content-->
                            <div class="tab-content  m--padding-30">
                              <div class="form-group m-form__group row listTransferencias">
                                @isset($transferencias)
                                  @foreach ($transferencias as $transferencia)
                                    <div class="col-lg-12">
                                      <input type="hidden" value="'+data.id+'" name="transferencias[]">
                                      <div class="card border-info mb-3" id="cardTransferencia">
                                          <div class="card-header">{{ $transferencia->banco->nombre }}</div>
                                          <div class="card-body">
                                            <p class="card-text">Fecha: {{ $transferencia->fecha }}</p>
                                            <p class="card-text">Nro. Transaccion: {{ $transferencia->nro }}</p>
                                            <p class="card-text text-danger">Monto: {{ $transferencia->monto }}</p>
                                          </div>\
                                      </div>\
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
                <!--end: Form Wizard Step 3-->
                <!--begin: Form Wizard Step 4-->
                <div class="m-wizard__form-step" id="m_wizard_form_step_4">
                  <!--begin::Section-->
                  <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
                    <!--begin::Item-->
                    <div class="m-accordion__item active">
                      <div class="m-accordion__item-head"  role="tab" id="m_accordion_1_item_1_head" data-toggle="collapse" href="#m_accordion_1_item_1_body" aria-expanded="  false">
                        <span class="m-accordion__item-icon">
                          <i class="fa flaticon-user-ok"></i>
                        </span>
                        <span class="m-accordion__item-title">
                          1. Inquilinos
                        </span>
                        <span class="m-accordion__item-mode">
                          <i class="la la-plus"></i>
                        </span>
                      </div>
                      <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_1_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_1_head" data-parent="#m_accordion_1">
                        <!--begin::Content-->
                        <div class="tab-content active  m--padding-30">
                          <div class="form-group m-form__group row listInquilinos">
                            @isset($inquilinos)
                              @foreach ($inquilinos as $inquilino)
                                <div class="col-lg-4">
                                <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">
                                  <div class="card-header">{{$inquilino}}</div>
                                  <div class="card-body">
                                    <a href="/gestiones/{{ $cobro->id }}/download-renter-receipt" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--pill m-tooltip" data-skin="dark" data-placement="bottom" title="" data-original-title="Imprimir Recibo">
                                        <i class="la la-print"></i>
                                      </a>
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
                    <div class="m-accordion__item active">
                      <div class="m-accordion__item-head" role="tab" id="m_accordion_1_item_2_head" data-toggle="collapse" href="#m_accordion_1_item_2_body" aria-expanded="    false">
                        <span class="m-accordion__item-icon">
                          <i class="fa  flaticon-users"></i>
                        </span>
                        <span class="m-accordion__item-title">
                          2. Propietarios (Recibo)
                        </span>
                        <span class="m-accordion__item-mode">
                          <i class="la la-plus"></i>
                        </span>
                      </div>
                      <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_2_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_2_head" data-parent="#m_accordion_1">
                        <!--begin::Content-->
                        <div class="tab-content active m--padding-30">
                          <div class="form-group m-form__group row listPropietarios">
                            @isset($propietarios)
                              @foreach ($propietarios as $id => $propietario)
                                <div class="col-lg-4">
                                <div class="card border-warning mb-3" id="cardPersona" style="max-width: 18rem;">
                                  <div class="card-header">{{$propietario['nombre']}}</div>
                                  <div class="card-body">
                                    <span>Porcentaje:</span>
                                    <div class="modificarPorcentaje" data-id="{{$id}}" id="porcentaje_{{$id}}">
                                        <a class="m-tooltip"  data-skin="dark" data-placement="top" title="Modificar porcentaje">
                                            <b>{{ $propietario['porcentaje'] }}%</b>
                                        </a>
                                    </div>
                                    <div style="display: none" id="porcentaje_input_{{$id}}">
                                      <div class="input-group">
                                        {!! Form::text('', null, ['class' => 'form-control m-input input-medium', 'placeholder' => '', 'id' => 'porcentaje_value_'.$id]) !!}
                                        <span class="input-group-addon" id="basic-addon1">
                                          <a class="m-tooltip guardarPorcentaje" data-id="{{ $id }}" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Guardar Porcentaje">
                                              <i class="la la-save"></i>
                                          </a>
                                        </span>
                                      </div>
                                    </div>
                                    <button type="button" class="btn m-btn--pill m-btn--air btn-outline-warning liquidarPropietario" data-id="{{$id}}">
                                    Liquidar
                                    </button>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                            @endisset
                          </div>
                        </div>
                        <!--end::Content-->
                      </div>
                    </div>
                    <div class="m-accordion__item active">
                      <div class="m-accordion__item-head" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="    false">
                        <span class="m-accordion__item-icon">
                          <i class="fa  flaticon-users"></i>
                        </span>
                        <span class="m-accordion__item-title">
                          3. Propietarios (Factura)
                        </span>
                        <span class="m-accordion__item-mode">
                          <i class="la la-plus"></i>
                        </span>
                      </div>
                      <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_3_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_1">
                        <div class="tab-content active m--padding-30">
                          <div class="form-group m-form__group row listOwnersToInvoice">
                            @isset($propietarios)
                              @foreach ($propietarios as $id => $propietario)
                                <div class="col-lg-4">
                                <div class="card border-danger mb-3" id="cardPersona" style="max-width: 18rem;">
                                  <div class="card-header">{{ $propietario['nombre'] }}</div>
                                  <div class="card-body">
                                    <button type="button" class="btn m-btn--pill m-btn--air btn-outline-danger invoiceAfipToOwner" data-id="{{$id}}">
                                      Factura Electronica
                                    </button>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                            @endisset
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Section-->
                </div>
                <!--end: Form Wizard Step 4-->
              </div>
              <!--end: Form Body -->
              <!--begin: Form Actions -->
              <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40 pb-3">
                <div class="m-form__actions">
                  <div class="row">
                    <div class="col-lg-3 m--align-left">
                      <a href="{{route('gestiones.index')}}" class="btn btn-secondary m-btn m-btn--custom m-btn--icon">
                        <span>
                          &nbsp;&nbsp;
                          <span>
                            Volver al listado
                          </span>
                        </span>
                      </a>
                    </div>
                    <div class="col-lg-3 m--align-left">
                      <a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
                        <span>
                          <i class="la la-arrow-left"></i>
                          &nbsp;&nbsp;
                          <span>
                            Volver
                          </span>
                        </span>
                      </a>
                    </div>
                    <div class="col-lg-6 m--align-right">
                      <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
                        <span>
                          <span>
                            Siguiente
                          </span>
                          &nbsp;&nbsp;
                          <i class="la la-arrow-right"></i>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!--end: Form Actions -->
          </div>
          <!--end: Form Wizard Form-->
        </div>
      </div>
    </div>
    <!--end: Form Wizard-->
  </div>
  <!--end: Portlet Body-->
</div>
{!! Form::close() !!}
<!--Modals -->
@include('contratos.modal._search')
@include('gastos.modal._form')
@include('impuestos.modal._form')
@include('cheques.modal._form')
@include('transferencias.modal._form')
@endsection

