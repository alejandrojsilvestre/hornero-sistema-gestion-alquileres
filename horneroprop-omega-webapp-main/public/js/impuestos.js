jQuery(document).ready(function() {
    $('#formImpuesto').submit(function (e) {
        e.preventDefault();
        var id = $('[name="impuesto_id"]').val();
        if(controller=='contratos')
            var contrato_id = $('[name=id]').val();
        else
            var contrato_id = $('[name=contrato_id]').val();
        var source = '/impuestos';
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
          .done(function(data, textStatus, jqXHR){
            resetFormImpuesto();
            $('#_formImpuesto').modal('hide');
            addAlert('success','El impuesto ha sido guardado correctamente :)');
            getImpuestosByContrato();
          })
          .fail(function(jqXHR, textStatus, errorThrown){ 
            addAlert('error','Error: No puedo procesarse el formulario :(');
          });
    });
    $('.editarImpuesto').on('click',editarImpuesto);
    $('.eliminarImpuesto').on('click',eliminarImpuesto);
    $('.btnExcange').on('click',exchangeServicio);
    $('#rotaImpuesto').on('click',showRotaImpuesto);
    $('.nuevoImpuesto').on('click', function (e) {   
        e.preventDefault();
        if(controller=='contratos'){
          var contratoId = $('[name=id]').val();
          $('.direccionContrato').val($('#formContratoDireccion').val());
        }
        else {
          var contratoId = $('[name=contrato_id]').val();
        }
        if(empty(contratoId))
          return addAlert('error', 'Error: Debe seleccionar un contrato para cargar un impuesto :(');
        else
          return $('#_formImpuesto').modal('show');
    });
});
function exchangeServicio(){
    //No use el display: none porque rompe el SELECT2. 
    if($('.impuesto_newServicio').css('opacity')=='0'){
        $('.impuesto_servicio').css('height','0px');
        $('.impuesto_servicio').css('opacity','0');
        $('.impuesto_newServicio').css('opacity','1');
        $('.impuesto_newServicio').css('height','auto');
    }else{
        $('.impuesto_servicio').css('opacity','1');
        $('.impuesto_servicio').css('height','auto');
        $('.impuesto_newServicio').css('height','0px');
        $('.impuesto_newServicio').css('opacity','0');
    }
    //LIMPIO LOS CAMPOS
    $('#servicio_id').val('');
    $('#servicio_id').trigger('change'); 
    $('input[name=servicio]').val('');
}
function showRotaImpuesto(){
    //No use el display: none porque rompe el SELECT2. 
    if($('.isRotativoImpuesto').css('opacity')=='0'){
        $('.isRotativoImpuesto').css('opacity','1');
        $('.isRotativoImpuesto').css('height','auto');
    }else{
        $('.isRotativoImpuesto').css('opacity','0');
        $('.isRotativoImpuesto').css('height','0');
    }
    //LIMPIO LOS CAMPOS
    $('#cada').val('');
}
function resetFormImpuesto(){
  $('#formImpuesto').trigger("reset");
  $('#formImpuesto select').trigger('change');
  $('[name=impuesto_id]').val('');
  $('.impuesto_servicio').css('height','auto');
  $('.impuesto_servicio').css('opacity','1');
  $('.impuesto_newServicio').css('opacity','0');
  $('.impuesto_newServicio').css('height','0');
  $('.isRotativoImpuesto').css('opacity','0');
  $('.isRotativoImpuesto').css('height','0');
}
function getImpuestosByContrato() {
    if(controller=='contratos')
        var contrato_id = $('[name=id]').val();
    else
        var contrato_id = $('[name=contrato_id]').val();
    if(empty(contrato_id))
        return false;
    estado = (controller=='gestiones')?'sinEntregar':'';
    $.ajax({
        url: '/impuestos/getImpuestosByContrato',
        type: 'GET',
        dataType: 'json',
        data: {contrato_id:contrato_id, estado:estado},
      })
      .done(function(data, textStatus, jqXHR){
        $('.listImpuestos').html('');
        $.each(data, function(i,data){
            i = i+1;
            var setEntregado = '';
            var btnEditar = '';
            var btnEliminar = '';
            var estado = '';
            if(controller=='gestiones'){
                setEntregado ='<label for="impuesto_entregado_'+i+'" class="m-checkbox m-checkbox--solid  m-checkbox--success checkCorner">\
                                    <input type="checkbox" class="checkCorner" value="'+data.id+'" id="impuesto_entregado_'+i+'" name="impuestos_entregados[]">\
                                    <span></span>\
                                </label>';
            }

            if(!data.entregado){
              btnEditar ='<button type="button" data-id="'+data.id+'" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-edit-impuesto editarImpuesto" data-skin="dark" data-placement="top" title="" data-original-title="Editar Impuesto" >\
                            <i class="fa fa-edit"></i>\
                          </button>';
              btnEliminar ='<button type="button" data-id="'+data.id+'" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air m-tooltip btn-delete-impuesto eliminarImpuesto" data-skin="dark" data-placement="top" title="" data-original-title="Eliminar Impuesto"">\
                            <i class="fa fa-trash"></i>\
                          </button>';
            }
            estado = (data.entregado)?'<span class="m-badge m-badge--success m-badge--wide">Entregado</span>':'<span class="m-badge m-badge--danger m-badge--wide">Pendiente</span>';
            var cardImpuesto = '<div class="col-lg-3">\
                                <div class="card border-success mb-3" id="cardImpuesto" style="max-width: 18rem;">\
                                    <div class="card-header">'+btnEditar+btnEliminar+data.servicio.nombre+'</div>\
                                    '+setEntregado+'\
                                    <div class="card-body">\
                                      <p class="card-text">'+mesesDelAnio[data.cobro.mes-1]+' - '+data.cobro.ano+'</p>\
                                      <p class="card-text text-danger">Monto: '+data.monto+'</p>\
                                      <p>'+estado+'<p>\
                                    </div>\
                                </div>\
                              </div>';
            $('.listImpuestos').append(cardImpuesto);
        });
        $('.editarImpuesto').on('click',editarImpuesto);
        $('.eliminarImpuesto').on('click',eliminarImpuesto);
      })
      .fail(function(jqXHR, textStatus, errorThrown){ 
        addAlert('error','Error: No se pudo obtener el listado de impuestos');
      });
}
function editarImpuesto(){
  // Blanqueo el formulario
  resetFormImpuesto();
  var url = '/impuestos/'+$(this).data('id');
  $.ajax({
      type: "GET",
      url: url,
      dataType: 'json',
      success: function (data) {
        $.each(data, function (key, value) {
          if (key=='id') {
            $('#formImpuesto [name=impuesto_id]').val(value);
          } else {
            $('#formImpuesto [name=' + key + ']').val(value);
          }
        });
        $('#formImpuesto select').trigger('change');
        initCodPais();
      }
    });
    $('#_formImpuesto').modal('show');
}
/*
** CONFIRMACION PARA ELIMINAR IMPUESTOS
*/
function eliminarImpuesto(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  var url = '/impuestos/'+$(this).data('id');
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
        getImpuestosByContrato();
      })
    } else {
      swal("Cancelado", "El registro no ha sido eliminado :)", "error");
    }
  })
}