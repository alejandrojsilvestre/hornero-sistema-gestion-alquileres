@extends('layouts.app')

@section('title','Calendario')

@section('breadcrumbs')
  {{Breadcrumbs::render('eventos')}}
@endsection

@section('assets')
  <!-- <link href="{{ asset('css/bootstrap-colorpicker.min.css?1s') }}" rel="stylesheet"> -->
  <!-- <script src="{{ asset('js/bootstrap-colorpicker.min.js?s22') }}" type="text/javascript"></script> -->
  <link href="{{ asset('plugins/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
  <script src="{{ asset('plugins/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/vendors/custom/jquery-ui/jquery-ui.bundle.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/eventos.js?' . time()) }}" type="text/javascript"></script>
@endsection



@section('content')
<div class="row">
  <div class="col-lg-12">
    <!--begin::Portlet-->
    <div class="m-portlet" id="m_portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
              <i class="flaticon-calendar-2"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Eventos
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
  </div>
</div>
@endsection

