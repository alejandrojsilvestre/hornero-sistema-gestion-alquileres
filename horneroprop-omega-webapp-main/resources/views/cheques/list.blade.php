@extends('layouts.app')

@section('title','Cheques')

@section('breadcrumbs')
  {{Breadcrumbs::render('cheques')}}
@endsection

@section('assets')
<script src="{{ asset('js/cheques.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
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
        </div>
      </div>
    </div>
    <!--end: Search Form -->
    <!--begin: Datatable -->
    <table class="table table-bordered" id="cheques-table">
        <thead>
        </thead>
    </table>
    <!--end: Datatable -->
  </div>
</div>
@endsection

