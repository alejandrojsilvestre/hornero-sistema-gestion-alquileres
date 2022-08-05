jQuery(document).ready(function() {
    $('#formGasto').submit(function (e) {
        e.preventDefault();
        var id = $('[name="gasto_id"]').val();
        if(controller=='contratos')
            var contrato_id = $('[name=id]').val();
        else
            var contrato_id = $('[name=contrato_id]').val();
        var source = '/gastos';
        var method = 'post';
        if(id.length>0){
            source+= '/'+id;
            method = 'put';
        }
        $.ajax({
            url: source,
            type: method,
            dataType: 'json',
            data: $(this).serialize()+'&contrato_id='+contrato_id,
          })
          .done(() => {
            resetFormGasto();
            $('#_formGasto').modal('hide');
            addAlert('success','El gasto ha sido guardado correctamente :)');
            getGastosByContrato();
          })
          .fail(() => { 
            addAlert('error','Error: No puedo procesarse el formulario :(');
          });
    });
    $('.editarGasto').on('click',editarGasto);
    $('.eliminarGasto').on('click',eliminarGasto);
    $("[name=monto]").on("keydown", numericTextBox);
    $('.btnExcange').on('click',exchangeConcepto);
    $('#rotaGasto').on('click',showRotaGasto);
    $('.nuevoGasto').on('click', function (e) {   
        e.preventDefault();

        if(controller=='contratos'){
          var contratoId = $('[name=id]').val();
          $('.direccionContrato').val($('#formContratoDireccion').val());
        }
        else {
          var contratoId = $('[name=contrato_id]').val();
        }

        if(empty(contratoId)) {
          return addAlert('error', 'Error: Debe seleccionar un contrato para cargar un gasto :(');
        }
        else {
          return $('#_formGasto').modal('show');
        }

    });
});
function exchangeConcepto(){
    //No use el display: none porque rompe el SELECT2. 
    if($('.gasto_newConcepto').css('opacity')=='0'){
        $('.gasto_concepto').css('height','0px');
        $('.gasto_concepto').css('opacity','0');
        $('.gasto_newConcepto').css('opacity','1');
        $('.gasto_newConcepto').css('height','auto');
    }else{
        $('.gasto_concepto').css('opacity','1');
        $('.gasto_concepto').css('height','auto');
        $('.gasto_newConcepto').css('height','0px');
        $('.gasto_newConcepto').css('opacity','0');
    }
    //LIMPIO LOS CAMPOS
    $('#concepto_id').val('');
    $('#concepto_id').trigger('change'); 
    $('input[name=concepto]').val('');
}
function showRotaGasto(){
    //No use el display: none porque rompe el SELECT2. 
    if($('.isRotativoGasto').css('opacity')=='0'){
        $('.isRotativoGasto').css('opacity','1');
        $('.isRotativoGasto').css('height','auto');
    }else{
        $('.isRotativoGasto').css('opacity','0');
        $('.isRotativoGasto').css('height','0');
    }
    //LIMPIO LOS CAMPOS
    $('#cada').val('');
}
function resetFormGasto(){
    $('#formGasto').trigger("reset");
    $('#formGasto select').trigger('change');
    $('[name=gasto_id]').val('');
    $('.gasto_concepto').css('height','auto');
    $('.gasto_concepto').css('opacity','1');
    $('.gasto_newConcepto').css('opacity','0');
    $('.gasto_newConcepto').css('height','0');
    $('.isRotativoGasto').css('opacity','0');
    $('.isRotativoGasto').css('height','0');
    $('.trumbowyg-editor').html('');
}
function getGastosByContrato() {
    //cHEQUEO QUE EL CONTRATO NO SE ENCUENTRE VACIO
    if(controller=='contratos')
        var contrato_id = $('[name=id]').val();
    else
        var contrato_id = $('[name=contrato_id]').val();
    if(empty(contrato_id))
        return false;
    // Array con tipos de encargados o pagados por
    var tipo = [];
    tipo["I"] = "Inquilino";
    tipo["A"] = "Administracion";
    tipo["P"] = "Propietario";
    // Chequeo si viene de gestiones para traer solo impagos
    estado = (controller=='gestiones')?'sinLiquidar':'';
    $.ajax({
        url: '/gastos/getGastosByContrato',
        type: 'GET',
        dataType: 'json',
        data: {contrato_id:contrato_id,estado:estado},
      })
      .done(function(data, textStatus, jqXHR){
        $('.listGastos').html('');
        $.each(data, function(i,data){
            i = i+1;
            var setLiquidado = '';
            var btnLiquidado = '';
            var btnEditar = '';
            var btnEliminar = '';
            var estado = '';
            if(controller=='gestiones'){
                setLiquidado ='<label for="gasto_liquidado_'+i+'" class="m-checkbox m-checkbox--solid  m-checkbox--success checkCorner">\
                                    <input type="checkbox" value="'+data.id+'" class="liquidaGasto checkCorner" id="gasto_liquidado_'+i+'" name="gastos_liquidados[]">\
                                    <span></span>\
                                </label>';
                btnLiquidado = '<div class="m-checkbox-inline">\
                                <label class="m-checkbox m-checkbox--solid m-checkbox--brand">\
                                  <input type="checkbox" class="imputaGasto" disabled value="'+data.id+'" name="gastos_imputados[]">\
                                  Imputar\
                                  <span></span>\
                                </label>\
                                <label class="m-checkbox m-checkbox--solid  m-checkbox--brand">\
                                  <input type="checkbox" class="visualizaGasto" value="'+data.id+'" disabled name="gastos_visualizados[]">\
                                  Visualizar\
                                  <span></span>\
                                </label>\
                              </div>';
            }
            if(!data.liquidado){
                btnEditar ='<button type="button" data-id="'+data.id+'" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-edit-gasto editarGasto" data-skin="dark" data-placement="top" title="" data-original-title="Editar Gasto"">\
                            <i class="fa fa-edit"></i>\
                          </button>';
                btnEliminar ='<button type="button" data-id="'+data.id+'" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-delete-gasto eliminarGasto" data-skin="dark" data-placement="top" title="" data-original-title="Eliminar Gasto"">\
                            <i class="fa fa-trash"></i>\
                          </button>';
            }
            estado = (data.liquidado)?'<span class="m-badge m-badge--success m-badge--wide">Liquidado</span>':'<span class="m-badge m-badge--danger m-badge--wide">Pendiente</span>';
            var cardGasto = '<div class="col-lg-4">\
                                <div class="card border-warning mb-3" id="cardGasto" style="max-width: 18rem;">\
                                    <div class="card-header">'+btnEditar+btnEliminar+data.concepto.nombre+'</div>\
                                    '+setLiquidado+'\
                                    <div class="card-body">\
                                      <p class="card-text">'+mesesDelAnio[data.cobro.mes-1]+' - '+data.cobro.ano+'</p>\
                                      <p class="card-text">Encargado: '+tipo[data.encargado]+' </p>\
                                      <p class="card-text">Pagado por: '+tipo[data.pagado_por]+'</p>\
                                      <p class="card-text text-danger">Monto: '+data.monto+'</p>\
                                      '+btnLiquidado+'\
                                      <p>'+estado+'<p>\
                                    </div>\
                                </div>\
                              </div>';
            $('.listGastos').append(cardGasto);
        });
        $('.imputaGasto').on('change',function(){
            getValores('changeValues');
        });
        $('.liquidaGasto').on('click',function(){
            setEnabled($(this).val());
        });
        $('.editarGasto').on('click',editarGasto);
        $('.eliminarGasto').on('click',eliminarGasto);
        if(controller=='gestiones')
            getValores();
      })
      .fail(function(jqXHR, textStatus, errorThrown){ 
        addAlert('error','Error: No se pudo obtener el listado de gastos');
      });
}
function setEnabled(idGasto){
    if($('.imputaGasto[value='+idGasto+']').prop('disabled')){
        $('.imputaGasto[value='+idGasto+']').prop('disabled', false);
        $('.visualizaGasto[value='+idGasto+']').prop('disabled', false);
    }
    else{
        $('.imputaGasto[value='+idGasto+']').prop('disabled', true);
        $('.visualizaGasto[value='+idGasto+']').prop('disabled', true);
        getValores();
    }
}
function editarGasto(){
  // Blanqueo el formulario
  resetFormGasto();
  var url = '/gastos/'+$(this).data('id');
  $.ajax({
      type: "GET",
      url: url,
      dataType: 'json',
      success: function (data) {
        $.each(data, function (key, value) {
          if(key=='id')
            $('#formGasto [name=gasto_id]').val(value);
          else
              $('#formGasto [name=' + key + ']').val(value);
        });
        $('#formGasto select').trigger('change');
        initCodPais();
      }
    });
    $('#_formGasto').modal('show');
}
/*
** CONFIRMACION PARA ELIMINAR GASTO
*/
function eliminarGasto(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  var url = '/gastos/'+$(this).data('id');
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
      }).done(() => {
        swal("Eliminado!", "El registro ha sido eliminado correctamente!", "success");
        getGastosByContrato();
      })
    } else {
      swal("Cancelado", "El registro no ha sido eliminado :)", "error");
    }
  })
}