@extends('layouts.app')

@section('title','Contratos - Listado')

@section('breadcrumbs')
  {{Breadcrumbs::render('contratos')}}
@endsection

@section('assets')
<script src="{{ asset('js/contratos.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
  <!-- <div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <div class="m-portlet__head-title">
        <h3 class="m-portlet__head-text">
          Listado de Contratos
        </h3>
      </div>
    </div>
  </div> -->
  <div class="m-portlet__body">
    <!--begin: Search Form -->
    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
      <div class="row align-items-center">
        <div class="col-xl-8 order-2 order-xl-1">
          <div class="form-group m-form__group row align-items-center">
            <div class="col-md-4">
              <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" placeholder="Buscar..." id="generalSearch">
                <span class="m-input-icon__icon m-input-icon__icon--left">
                  <span>
                    <i class="la la-search"></i>
                  </span>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
          <a href="{{ route('contratos.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
            <span>
              <i class="la la-plus-circle"></i>
              <span>
                Nuevo
              </span>
            </span>
          </a>
          <div class="m-separator m-separator--dashed d-xl-none"></div>
        </div>
      </div>
    </div>
    <!--end: Search Form -->
    <!--begin: Datatable -->
    <table class="table table-bordered" id="contratos-table">
        <thead>
        </thead>
    </table>
    <!--end: Datatable -->
  </div>
</div>
<!--Modals -->
@endsection

