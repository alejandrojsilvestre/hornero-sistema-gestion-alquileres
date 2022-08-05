jQuery(document).ready(function() {
    $('#m_form [name=punitorio]').on('change', function (e) {   
      getValores('changeValues');
    });
    $('#m_form [name=monto_pagado]').on('change', function (e) {   
      $('#m_form [name=monto_deuda]').val($('#m_form [name=monto_total]').val() - $('#m_form [name=monto_pagado]').val());
      getValores('changePagado');
    });
    $('.liquidarPropietario').on('click', liquidarPropietario);
    // $('.invoiceToOwner').on('click', invoiceToOwner);
    $('.invoiceAfipToOwner').on('click', invoiceAfipToOwner);
});
function setEventButtons() {
  $('.modificarPorcentaje').on('click', function() {
    modificar_porcentaje($(this).data('id'));
  });
  $('.guardarPorcentaje').on('click', function() {
    guardarPorcentaje($(this).data('id'));
  });
}
function getCobros(){
  //cHEQUEO QUE EL CONTRATO NO SE ENCUENTRE VACIO
  var contrato_id = $('[name=contrato_id]').val();
  if(empty(contrato_id))
      return false;
  $.ajax({
      url: '/gestiones/getCobros',
      type: 'GET',
      dataType: 'json',
      data: {contrato_id:contrato_id},
    })
    .done(function(data, textStatus, jqXHR){
      $('.listCobros').html('');
      $.each(data, function(i,data){
          i = i+1;
          var cardCobro = '<div class="col-lg-2">\
                            <div class="card border-warning mb-3" id="cardCuota" style="max-width: 18rem;">\
                                <div class="card-header">Cuota '+i+'</div>\
                                <div class="card-body">\
                                    <p class="card-text">'+mesesDelAnio[data.mes-1]+' - '+data.ano+'</p>\
                                    <p class="card-text text-danger">Monto: '+data.monto_pagado+'</p>\
                                    <p class="card-text text-danger">Honorarios: '+data.honorarios+'</p>\
                                      <a href="/gestiones/' + data.id + '/download-renter-receipt" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--pill m-tooltip" data-skin="dark" data-placement="bottom" title="" data-original-title="Imprimir Recibo">\
                                        <i class="la la-print"></i>\
                                      </a>\
                                      <a href="/gestiones/'+data.id+'/editar" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill m-tooltip" data-skin="dark" data-placement="bottom" title="" data-original-title="Ver Cobro">\
                                        <i class="la la-eye"></i>\
                                      </a>\
                                </div>\
                            </div>\
                          </div>';
          $('.listCobros').append(cardCobro);
      });
      $('.m-tooltip').tooltip();
    })
    .fail(function(jqXHR, textStatus, errorThrown){ 
      addAlert('error','Error: No se pudo obtener el listado de gastos');
    });
}
function getValores(action=null){
	if(!empty($('#m_form [name=cobro_id]').val())){
    var punitorio = '';
    if(action=='changeValues'){
      if(!empty($('#m_form [name=punitorio]').val()))
        var punitorio = '&punitorio='+$('#m_form [name=punitorio]').val();
      else
        var punitorio = '&punitorio=noCobra';
    }
    $.ajax({
      type: "GET",
      url: '/gestiones/getValores',
      data: $('#m_form').serialize()+punitorio+"&action="+action,
      dataType: 'json',
      success: function (data) {
        $.each(data.valores, function (key, value) {
          if(key=='moneda')
            $('#m_form .'+key).html(value);
          else 
        	 $('#m_form [name=' + key + ']').val(value);
        });
      }
    });
  }
}
function setValores(action = null, btn){
  if (!empty($('#m_form [name=cobro_id]').val())) {

    var id = $('#m_form [name=cobro_id]').val();
    var inquilino_id = '&inquilino_id='+btn.data('id');
    var html = getHtmlSwalAvisos();

    if(action=="generarRecibo"){
      swal({
        title: "¿Desea realizar alguna acción extra?",
        html: html,
        type: "info",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Confirmar',
        cancelButtonText: "Cancelar"
     }).then(function(isConfirm) {
        var hasToDownloadReceipt = $('#actionsRecibo [name=download_receipt]').is(":checked");
        
        if (isConfirm.value === true){
          $.ajax({
            type: "GET",
            url: '/gestiones/setValores',
            data: $('#m_form').serialize() + '&' + $('#actionsRecibo').serialize() + inquilino_id,
            dataType: 'json',
            success: function (data) {
              if (hasToDownloadReceipt) {
                location.href = '/gestiones/' + data.id + '/download-renter-receipt'; 
              }
              swal("Todo OK!", "El inquilino fue liquidado!", "success");
            }
          });

        } else {
          swal("Cancelado", "El inquilino no fue liquidado!", "error");
        }
      });
    }
  }
}
function liquidarPropietario(){
  if (!empty($('#m_form [name=cobro_id]').val())) {
   
    var propietario = '&propietario_id=' + $(this).data('id');
    var html = getHtmlSwalAvisosPropietario();
   
    swal({
      title: "¿Desea realizar alguna acción extra?",
      html: html,
      type: "info",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Confirmar',
      cancelButtonText: "Cancelar"
   }).then(function(isConfirm) {
     
    if (isConfirm.value==true){
        var hasToDownloadReceipt = $('#actionsLiquidacion [name=download_receipt]').is(":checked");

        $.ajax({
          type: "GET",
          url: '/gestiones/liquidarPropietario',
          data: $('#m_form').serialize() + '&' + $('#actionsLiquidacion').serialize() + propietario,
          dataType: 'json',
          success: function (data) {
            if(data.error){
              addAlert('error', data.texto)
            }else{
              swal("Todo OK!", "El propietario fue liquidado!", "success");
              if (hasToDownloadReceipt) {
                location.href = '/gestiones/' + data.id + '/download-owner-receipt'; 
              }
            }
          }
        });
      } else {
        swal("Cancelado", "El propietario no fue liquidado!", "error");
      }
    });
  }
}
// function invoiceToOwner(){
//   if (!empty($('#m_form [name=cobro_id]').val())) {

//     var paymentId = $('#m_form [name=cobro_id]').val();
//     var ownerParam = '&propietario_id=' + $(this).data('id');
//     var html = getHtmlSwalOwnerInvoiceOptions();

//     swal({
//       title: "¿Desea realizar alguna acción extra?",
//       html: html,
//       type: "info",
//       showCancelButton: true,
//       confirmButtonColor: '#DD6B55',
//       confirmButtonText: 'Confirmar',
//       cancelButtonText: "Cancelar"
//    }).then(function(isConfirm) {
//     if (isConfirm.value == true){
//         var hasToDownloadInvoice = $('#actionsInvoice [name=download_invoice]').is(":checked");

//         $.ajax({
//           type: "GET",
//           url: '/gestiones/' + paymentId + '/generate-owner-invoice',
//           data: $('#m_form').serialize() + '&' + $('#actionsInvoice').serialize() + ownerParam,
//           dataType: 'json',
//           success: function (data) {
//             if(data.error){
//               addAlert('error', data.texto)
//             }else{
//               swal("Todo OK!", "El propietario fue liquidado!", "success");
//               if (hasToDownloadInvoice) {
//                 location.href = '/gestiones/' + data.id + '/download-owner-invoice'; 
//               }
//             }
//           }
//         });
//       } else {
//         swal("Cancelado", "El propietario no fue liquidado!", "error");
//       }
//     });
//   }
// }
function invoiceAfipToOwner(){
  if (!empty($('#m_form [name=cobro_id]').val())) {

    var paymentId = $('#m_form [name=cobro_id]').val();
    var ownerParam = '&propietario_id=' + $(this).data('id');
    var html = getHtmlSwalOwnerAfipInvoiceOptions();

    swal({
      title: "¿Desea realizar alguna acción extra?",
      html: html,
      type: "info",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Confirmar',
      cancelButtonText: "Cancelar",
      onBeforeOpen: () => {
        initializeSelect2Ajax($('#credencial_id'));
      },
   }).then(function(isConfirm) {
    if (isConfirm.value == true){
        var hasToDownloadAfipInvoice = $('#actionsAfipInvoice [name=download_invoice]').is(":checked");

        $.ajax({
          type: "GET",
          url: '/gestiones/' + paymentId + '/generate-owner-afip-invoice',
          data: $('#m_form').serialize() + '&' + $('#actionsAfipInvoice').serialize() + ownerParam,
          dataType: 'json',
          success: function (data) {
            if(data.error){
              addAlert('error', data.texto)
            }else{
              swal("Todo OK!", "La factura fue generada!", "success");
              if (hasToDownloadAfipInvoice) {
                location.href = '/gestiones/' + data.id + '/download-owner-afip-invoice'; 
              }
            }
          }
        });
      } else {
        swal("Cancelado", "El propietario no fue liquidado!", "error");
      }
    });
  }
}
function getHtmlSwalAvisos(){
  var html = '<form id="actionsRecibo" autocomplete="off">\
              <div class="form-group m-form__group row">\
              <div class="col-lg-12">\
                <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">General</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="download_receipt">Descargar recibo<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
              <div class="col-lg-12">\
                <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">Enviar copia de recibo vía:</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="mail_inquilino">Mail<span></span>\
                      </label>\
                      <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">\
                        <input type="checkbox" name="app_inquilino">App<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
              <div class="col-lg-12">\
                <div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">Aviso de liquidación disponible a Propietarios</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="mail_propietario">Mail<span></span>\
                      </label>\
                      <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">\
                         <input type="checkbox" name="app_propietario">App<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
            </div>\
            </form>';
  return html;
}

function getHtmlSwalAvisosPropietario(){
  var html = '<form id="actionsLiquidacion" autocomplete="off">\
              <div class="form-group m-form__group row">\
              <div class="col-lg-12">\
                <div class="card border-warning mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">General</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="download_receipt">Descargar recibo<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
              <div class="col-lg-12">\
                <div class="card border-warning mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">Enviar copia de recibo vía:</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="mail_propietario">Mail<span></span>\
                      </label>\
                      <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">\
                         <input type="checkbox" name="app_propietario">App<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
            </div>\
            </form>';
  return html;
}

// function getHtmlSwalOwnerInvoiceOptions(){
//   var html = '<form id="actionsInvoice" autocomplete="off">\
//               <div class="form-group m-form__group row">\
//               <div class="col-lg-12">\
//                 <div class="card border-danger mb-3" id="cardPersona" style="max-width: 18rem;">\
//                   <div class="card-header">General</div>\
//                   <div class="card-body">\
//                     <div class="m-checkbox-inline">\
//                       <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
//                         <input type="checkbox" name="download_invoice">Descargar Factura<span></span>\
//                       </label>\
//                     </div>\
//                   </div>\
//                 </div>\
//               </div>\
//             </div>\
//             </form>';
//   return html;
// }

function getHtmlSwalOwnerAfipInvoiceOptions(){
  var html = '<form id="actionsAfipInvoice" autocomplete="off">\
              <div class="form-group m-form__group row">\
              <div class="col-lg-12">\
                <div class="card border-danger mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">Credencial</div>\
                  <div class="card-body">\
                    <div class="col-lg-12">\
                      <select style="width:100%!important" controller="afip/credenciales" class="form-control select2-ajax m-select2" id="credencial_id" name="credencial_id">\
                      </select>\
                    </div>\
                  </div>\
                </div>\
              </div>\
              <div class="col-lg-12">\
                <div class="card border-danger mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">General</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="download_invoice">Descargar factura<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
              <div class="col-lg-12">\
                <div class="card border-danger mb-3" id="cardPersona" style="max-width: 18rem;">\
                  <div class="card-header">Enviar factura vía:</div>\
                  <div class="card-body">\
                    <div class="m-checkbox-inline">\
                      <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                        <input type="checkbox" name="mail_propietario">Mail<span></span>\
                      </label>\
                      <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">\
                         <input type="checkbox" name="app_propietario">App<span></span>\
                      </label>\
                    </div>\
                  </div>\
                </div>\
              </div>\
            </div>\
            </form>';
  return html;
}
function modificar_porcentaje(propietario_id) {
    var porcentaje_actual = $('#porcentaje_' + propietario_id).html();
    $('#porcentaje_input_' + propietario_id).css({'display': 'inline'});
    $('#porcentaje_' + propietario_id).css({'display': 'none'});
    $('#porcentaje_value_' + propietario_id).focus();
    $('#guardar_porcentaje_' + propietario_id).show();
}
function guardarPorcentaje(propietario_id) {
    var porcentaje = $('#porcentaje_value_' + propietario_id).val();
    var contrato_id = $('[name=contrato_id]').val();
    if(empty(porcentaje))
    return addAlert('info', 'No se realizo el cambio. Asegurate de haber cargado el nuevo porcentaje.');
    $.ajax({
        type: 'GET',
        url: '/gestiones/modificarPorcentaje',
        data: {
            contrato_id: contrato_id,
            propietario_id: propietario_id,
            porcentaje: porcentaje
        },
        success: function(error) {
          if(error==1)
            return addAlert('info', 'No se realizo el cambio. El porcentaje no debe superar el 100%');
            $('#porcentaje_' + propietario_id).html(porcentaje+'%<br/>');
            $('#porcentaje_input_' + propietario_id).css({'display': 'none'});
            $('#porcentaje_' + propietario_id).css({'display': 'inline'});
            $('#porcentaje_' + propietario_id).data('value', porcentaje);
        }
    })
}