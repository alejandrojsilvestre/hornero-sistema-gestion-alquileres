/* NOMBRE DEL CONTROLADOR PUBLICO */
var urlPathController = window.location.pathname.split("/");
var controller = urlPathController[1];
var action = urlPathController[2];
var mesesDelAnio = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
$(document).ajaxStart(function(){
  $("#ajax-load").css("display", "block");
});
$(document).ajaxComplete(function(){
  $("#ajax-load").css("display", "none");
});
$( document ).ready(function() {
  $("select:not(#personaCodPais):not(.notSelect2)").select2({ minimumResultsForSearch: -1,width: '100%', matcher: matchCustom, placeholder: 'Seleccione'});
  $(".selectSearch").select2({ width: '100%', matcher: matchCustom, placeholder: 'Seleccione'});
 /* Select 2
  * Los inicializo y traigo data segun controlador
  */
  initializeSelect2Ajax();

  /* Si se ejecuta un modal lo reinicializo para que tome estilos */
  $(".modal").on('shown.bs.modal', function(){
      initializeSelect2Ajax();
  });
  /* Search contrato Gloglal */
  $('.searchContrato').on('click', function (e) {     
      datatableContratos('search');
  });
  // Ver contrato global.
  $('.verContrato').on('click', function() {
    contrato_id = $('[name=contrato_id]').val();
    if(contrato_id)
      window.open('/contratos/'+contrato_id+'/editar', '_blank');
    else 
      addAlert('info','No hay ningun contrato seleccionado');

  });
  // Disable input
  $(".disabled").attr("tabindex", "-1");

  $('textarea').trumbowyg({
    removeformatPasted: true,
    btns: [
        ['strong', 'em', 'del'],
        ['unorderedList', 'orderedList'],
        ['link'],
        ['removeformat'],
    ],
  });

  /**
  * Datepicker
  */
  $.fn.datepicker.dates['es'] = {
  days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
  daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
  daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
  months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
  today: "Hoy",
  clear: "Borrar",
  format: "dd-mm-yyyy",
  titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
  weekStart: 0
  };
  $('.date').datepicker({
      language: 'es',
      todayBtn: "linked",
      clearBtn: true,
      autoclose: true,
      dateFormat: 'dd/mm/yy',
      todayHighlight: true,
      focusOnShow: false,
      templates: {
          leftArrow: '<i class="la la-angle-left"></i>',
          rightArrow: '<i class="la la-angle-right"></i>'
      }
  });
  $('.date-nacimiento').datepicker({
      language: 'es',
      dateFormat: 'dd/mm/yy',
      viewMode: 'years',
  });
  $('.date').datepicker({
    language: 'es',
    todayBtn: "linked",
    clearBtn: true,
    autoclose: true,
    dateFormat: 'dd/mm/yy',
    todayHighlight: true,
    focusOnShow: false,
    templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }
  });
  $('.m-birthdate').datepicker({
      language: 'es',
      format: 'dd-mm-yyyy',
      startView: 'decade',
      minView: 'month',
      autoclose: true,
      maxView: 'decade'
  });
  $('.m-date').datepicker({
      language: 'es',
      format: 'dd-mm-yyyy',
      startView: 'month',
      minView: 'month',
      autoclose: true,
      maxView: 'decade'
  });
  $('.m-datetime').datepicker({
      language: 'es',
      format: 'dd-mm-yyyy hh:ii',
      startView: 'month',
      minView: 'hour',
      autoclose: true,
      maxView: 'decade'
  });
  $('.m-time').datepicker({
      language: 'es',
      format: 'hh:ii',
      startView: 'day',
      autoclose: true,
      minView: 'hour',
      maxView: 'day'
  });
  $('.m-year').datepicker({
      language: 'es',
      format: 'yyyy',
      startView: 'decade',
      autoclose: true,
      viewMode: "years",
      minViewMode: "years"
  });
  /*
  ** Borra el CARD mas cercano (Utilizado para eliminar registros en formularios)
  */
  deleteCard();
  /*
  ** ESCONDE CELULAR
  */
  $('.closeCelularPhone').on('click', function(event) {
    $('#_celularPhone').modal('hide');
  });
  /*
  ** MONTOS numéricos
  */
  $("#monto_inicial,#montoCheque,#montoTransferencia,[name=monto_garantia],[name=cada],[name=porcentaje],[name=interes],[name=interes_vencimiento],[name=interes_inicio],[name=interes_fijo],[name=honorarios],[name=honorarios_fijos]").on("keydown", numericTextBox);
  /*
  ** CONFIRMACION PARA ELIMINAR DESDE DATATABLES
  */
  $('.table').on('click', '.btn-delete[data-remote]', function (e) { 
      var button = $(this);
      e.preventDefault();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      var url = $(this).data('remote');
      swal({
        title: "¿Seguro desea eliminar este registro?",
        text: "Una vez eliminado no se podrá recuperar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sí, estoy seguro!',
        cancelButtonText: "No, cancelar!"
     }).then(function(isConfirm) {
       if (isConfirm.value==true){
          $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data  : {
                  _token  : $('meta[name="csrf-token"]').attr('content')
                },
            }).done(function (data) {
              swal("Eliminado!", "El registro ha sido eliminado correctamente!", "success");
              refreshDatatable();
            });
        } else {
          swal("Cancelado", "El registro no ha sido eliminado :)", "error");
        }
      })
  });
});


function empty (mixedVar) {
  var undef
  var key
  var i
  var len
  var emptyValues = [undef, null, false, 0, '', '0']

  for (i = 0, len = emptyValues.length; i < len; i++) {
    if (mixedVar === emptyValues[i]) {
      return true
    }
  }

  if (typeof mixedVar === 'object') {
    for (key in mixedVar) {
      if (mixedVar.hasOwnProperty(key)) {
        return false
      }
    }
    return true
  }

  return false
}
/**
* Alertas
* @param {type} posibles valores : warning , error , success , info y question
* @param {text} Texto a visualizar
*/
function addAlert(type, text){
    swal({
        position: 'top-right',
        type: type,
        title: text,
        showConfirmButton: false,
        timer: 3500
    });
}
function initializeSelect2Ajax(element = null){
    if (!element) {
      $('.select2-ajax').each(function (i, obj) {
          $(obj).select2('destroy'); 
          $(obj).select2({ 
              placeholder: 'Buscar',
              minimumInputLength: 2,
              dropdownParent: (obj.getAttribute('modal') ? $('#'+obj.getAttribute('modal')) : null),
              ajax: {
                  url: '/' + obj.getAttribute('controller') + '/search',
                  dataType: 'json',
                  data: function (params) {
                      return {
                          q: $.trim(params.term)
                      };
                  },
                  processResults: function (data) {
                      return {
                          results: data
                      };
                  },
                  cache: true
              }
           });
      });
    } else {
      element.select2({ 
          placeholder: 'Buscar',
          minimumInputLength: 2,
          dropdownParent: $('.swal2-container'),
          ajax: {
              url: '/' + element[0].getAttribute('controller') + '/search',
              dataType: 'json',
              data: function (params) {
                  return {
                      q: $.trim(params.term)
                  };
              },
              processResults: function (data) {
                  return {
                      results: data
                  };
              },
              cache: true
          }
       });
    }
}
Date.prototype.addMonths = function (m) {
  var d = new Date(this);
  var years = Math.floor(m / 12);
  var months = m - (years * 12);
  if (years) d.setFullYear(d.getFullYear() + years);
  if (months) d.setMonth(d.getMonth() + months);
  return d;
}
function numericTextBox(e) {
  if (!((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode == 110 ) || (e.keyCode == 190 ) || (e.keyCode==9) || (e.keyCode==8)|| (e.keyCode==39)|| (e.keyCode==37)|| (e.keyCode == 46 ) || (e.keyCode >= 96 && e.keyCode <= 105))) {
      e.preventDefault();
      return;
  }
  else {
    var keyCode = e.keyCode;
    if (keyCode >= 96 && keyCode <= 105) {
        keyCode -= 48;
    }
    var value = $(this).val();
    value += String.fromCharCode(keyCode);
    value = parseInt(value, 10)
    var maxNumber = $(this).data("maxnumber");
    if (maxNumber) {
        maxNumber = parseInt(maxNumber);
        if (value > maxNumber) {
            e.preventDefault();
        }
    }
  }
}
function deleteCard(){
  $('.deleteCard').on('click', function(event) {
    event.preventDefault();
    $(this).closest('.card').remove();
  });
}
function cardPersona(data ,tipo)
{
  if (tipo === 'inquilino') {
    var btnLiquidar = '<button type="button" class="btn m-btn--pill m-btn--air btn-outline-info generarRecibo" data-id="'+data.id+'">\
                  Liquidar\
                  </button>';
    var classCard = 'info';
    var porcentajeSpan = '';
  } else if (tipo === 'propietario') {
    var btnLiquidar = '<button type="button" class="btn m-btn--pill m-btn--air btn-outline-warning liquidarPropietario" data-id="'+data.id+'">\
                  Liquidar\
                  </button>';
    var classCard = 'warning';
    var porcentaje = (!empty(data.pivot.porcentaje)) ? data.pivot.porcentaje : 0;
    var porcentajeSpan = '<span>Porcentaje:</span>\
                      <div class="modificarPorcentaje" data-id="'+data.id+'" id="porcentaje_'+data.id+'">\
                          <a class="m-tooltip"  data-skin="dark" data-placement="top" title="Modificar porcentaje">\
                              <b>'+porcentaje+'%</b>\
                          </a>\
                      </div>\
                      <div style="display: none" id="porcentaje_input_'+data.id+'">\
                        <div class="input-group">\
                          <input class="form-control m-input input-medium" placeholder="" id="porcentaje_value_'+data.id+'" name="" type="text" aria-invalid="false">\
                          <span class="input-group-addon" id="basic-addon1">\
                            <a class="m-tooltip guardarPorcentaje" data-id="'+data.id+'" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Guardar Porcentaje">\
                                <i class="la la-save"></i>\
                            </a>\
                          </span>\
                        </div>\
                      </div>';
  } else if (tipo === 'ownerInvoice') {
    var btnLiquidar = '<div class="col-12 pt-1"><button type="button" class="btn m-btn--pill m-btn--air btn-outline-danger invoiceAfipToOwner" data-id="'+data.id+'">\
                  Factura Electrónica\
                  </button></div>';
    var classCard = 'danger';
    var porcentajeSpan = '';
  }
  var card='<div class="col-lg-4">\
              <div class="card border-'+classCard+' mb-3" id="cardPersona" style="max-width: 18rem;">\
                <div class="card-header">'+data.nombre+' '+data.apellido+'</div>\
                <div class="card-body">\
                  '+porcentajeSpan+'\
                  '+btnLiquidar+'\
                </div>\
              </div>\
            </div>';
  if (typeof setEventButtons === "function") { 
    setEventButtons();
  };
  return card;
}
/*
** FUNCION PARA BUSQUEDA EN SELECT2 
*/
function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (coincidencia)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}
/*
** FIN FUNCION PARA BUSQUEDA EN SELECT2 
*/
function seleccionarContrato(btn){
  /* SELECCIONAR CONTRATO */
  var url = btn.data('remote');
  $.ajax({
      type: "GET",
      url: url,
      dataType: 'json',
      success: function (data) {
        $('[name=contrato_id]').val(data.id);
        $('[name=direccionContrato]').val(data.inmueble.direccion);
        $('.direccionContrato').val(data.inmueble.direccion);
        
        var propietarios = [];
        var inquilinos = [];
        $('.listPropietarios').html('');
        $('.listInquilinos').html('');
        $('.listOwnersToInvoice').html('');

        $.each(data.propietarios, function(key,data){
          propietarios[key] = data.nombre + ' ' + data.apellido;
          $('.listPropietarios').append(cardPersona(data,'propietario'))
          $('.listOwnersToInvoice').append(cardPersona(data, 'ownerInvoice'))
        });

        $.each(data.inquilinos, function(key,data){
          inquilinos[key] = data.nombre + ' ' + data.apellido;
          $('.listInquilinos').append(cardPersona(data,'inquilino'));
        });

        if ($('.periodos').length >0 ){
          $('.periodos').html('');

          $.each(data.cobros, function (key, data) {
            if(!data.liquidado)
              $('.periodos').append('<option value='+data.id+'>'+mesesDelAnio[data.mes-1]+' - '+data.ano+'</option>');
          });
        } 
        
        $('[name=propietarios]').val(propietarios.join(", "));
        
        $('[name=inquilinos]').val(inquilinos.join(", "));
        
        if(controller=='gastos') {
          getGastosByContrato();
           getImpuestosByContrato();
        
          }
        // Si esta desde el listado de cobros traigo los mismos
        if(controller=='gestiones' && empty(action)){getCobros();}
        if(controller == "gestiones"){
          $('.generarRecibo').on('click', function (e) {   
            setValores('generarRecibo',$(this));
          });
          $('.liquidarPropietario').on('click', liquidarPropietario);
          // $('.invoiceToOwner').on('click', invoiceToOwner);
          $('.invoiceAfipToOwner').on('click', invoiceAfipToOwner);
        }
      }
  });
  $('#_buscarContrato').modal('hide');
}

Dropzone.prototype.submitRequest = function(xhr, formData, files) {
  xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
  return xhr.send(formData);
};  

function initCountryCode(form){
  if($('#' + form + ' [name=celular]').length != 0 && $.fn.intlTelInput != undefined) {
    var countryList = $.fn.intlTelInput.getCountryData();
    var countryIso2;
    var allowedCountries = ['ar', 'uy', 'es', 'cl', 'bv', 'ec', 'sv', 'hn', 'mx', 'pe', 'us', 'py', 'bo', 'co', 've', 'br', 'au', 'cr'];
    countryList.forEach(function(countryData, index) {
      if(countryData.dialCode == $('#' + form + ' [name="cod_pais"]').val()) {
          countryIso2 = countryData.iso2;
          return;
      }
    });
    if (allowedCountries.find(item => item === countryIso2)) {
      $('#' + form + ' [name=celular]').intlTelInput('destroy').intlTelInput({
        separateDialCode: true,
        autoHideDialCode: false,
        autoPlaceholder: "off",
        initialCountry: (countryIso2) ? countryIso2 : 'ar',
        onlyCountries: allowedCountries,
        preferredCountries: []
    });
    }
    $('#' + form + ' [name=celular]').on("countrychange", function(e, countryData) {
        $('#' + form + ' [name="cod_pais"]').val(countryData.dialCode);
    });
  }
}

Array.prototype.sortByObjectProperty = function(propName, descending){
  return this.sort(function(a, b){
      if (typeof b[propName] == 'number' && typeof a[propName] == 'number') {
          return (descending) ? b[propName] - a[propName] : a[propName] - b[propName];
      } else if (typeof b[propName] == 'string' && typeof a[propName] == 'string') {
          return (descending) ? b[propName] > a[propName] : a[propName] > b[propName];
      } else {
          return this;
      }
  });
};