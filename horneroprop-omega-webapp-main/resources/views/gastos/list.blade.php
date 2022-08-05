@extends('layouts.app')

@section('title','Gastos | Impuestos')

@section('breadcrumbs')
  {{Breadcrumbs::render('gastos-impuestos')}}
@endsection

@section('assets')
<script src="{{ asset('js/gastos.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/impuestos.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
  <div class="m-portlet__body">
    <!--begin: Search Form -->
    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
      <div class="row align-items-center">
        <div class="col-xl-6 order-2 order-xl-1">
          <div class="form-group m-form__group row align-items-center">
            <div class="col-md-12">
              <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip searchContrato" data-toggle="modal" data-target="#_buscarContrato" data-skin="dark" data-placement="top" title="" data-original-title="Seleccionar Contrato" data-field="contrato">
                <i class="fa fa-search"></i>
              </a>
              <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip verContrato" data-skin="dark" data-placement="top" title="" data-original-title="Ver Contrato">
                <i class="fa fa-eye"></i>
              </a>
              {!! Form::hidden('contrato_id') !!}
            </div>
          </div>
        </div>
        <div class="col-xl-6 order-1 order-xl-2 m--align-right">
          <a class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill nuevoGasto">
            <span>
              <i class="la la-plus-circle white"></i>
              <span class="white">
                Nuevo Gasto
              </span>
            </span>
          </a>
          <a class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill nuevoImpuesto">
            <span>
              <i class="la la-plus-circle white"></i>
              <span class="white">
                Nuevo Impuesto
              </span>
            </span>
          </a>
          <div class="m-separator m-separator--dashed d-xl-none"></div>
        </div>
      </div>
    </div>
    <!--end: Search Form -->
  </div>
</div>
<div class="m-portlet m-portlet--mobile">
  <div class="m-portlet__body">
    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
      <div class="form-group m-form__group row">
        <div class="col-lg-4">
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon">
              Contrato: 
            </span>
            {!! Form::text('direccionContrato', null, ['class' => 'form-control m-input', 'disabled' => '']) !!}
          </div>
        </div>
        <div class="col-lg-4">
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon">
              Propietarios: 
            </span>
            {!! Form::text('propietarios', null, ['class' => 'form-control m-input', 'disabled' => '']) !!}
          </div>
        </div>
        <div class="col-lg-4">
          <div class="input-group m-input-group m-input-group--square">
            <span class="input-group-addon">
              Inquilinos: 
            </span>
            {!! Form::text('inquilinos', null, ['class' => 'form-control m-input', 'disabled' => '']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="m-portlet m-portlet--mobile">
  <div class="m-portlet__body">
    <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist"> 
      <!--begin::Item-->
      <div class="m-accordion__item">
        <div class="m-accordion__item-head collapse collapsed" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="true">
          <span class="m-accordion__item-icon">
            <i class="fa flaticon-medical"></i>
          </span>
          <span class="m-accordion__item-title">
            Gastos
          </span>
          <span class="m-accordion__item-mode">
            <i class="la la-plus"></i>
          </span>
        </div>
        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_3_body" role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_3" style="">
          <!--begin::Content-->
          <div class="tab-content  m--padding-30">
            <div class="form-group m-form__group row listGastos">
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
          </span>
          <span class="m-accordion__item-mode">
            <i class="la la-plus"></i>
          </span>
        </div>
        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_4_body" role="tabpanel" aria-labelledby="m_accordion_1_item_4_head" data-parent="#m_accordion_4" style="">
          <!--begin::Content-->
          <div class="tab-content  m--padding-30">
            <div class="form-group m-form__group row listImpuestos">
            </div>
          </div>
          <!--end::Section-->
        </div>
      </div>
      <!--end::Item-->
    </div>
  </div>
</div>
<!--Modals -->
@include('gastos.modal._form')
@include('impuestos.modal._form')
@include('contratos.modal._search')
@endsection

