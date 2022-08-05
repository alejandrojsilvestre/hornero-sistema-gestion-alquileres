jQuery(document).ready(function() {
    /* Inicio datatable */
    datatableTransferencias();
    $('#formTransferencia').submit(function (e) {
        e.preventDefault();
        var id = $('[name="transferencia_id"]').val();
        var source = '/transferencias';
        var method = 'post';
        if(id.length>0){
            source+= '/'+id;
            method = 'put';
        }
        $.ajax({
            url: source,
            type: method,
            dataType: 'json',
            data: $(this).serialize()
          })
          .done(function(data, textStatus, jqXHR){
            var cardTransferencia = '<div class="col-lg-12">\
                                <input type="hidden" value="'+data.id+'" name="transferencias[]">\
                                <div class="card border-info mb-3" id="cardTransferencia">\
                                    <div class="card-header">'+data.banco.nombre+'</div>\
                                    <div class="card-body">\
                                      <p class="card-text">Fecha: '+data.fecha+'</p>\
                                      <p class="card-text">Nro. Transaccion: '+data.nro+'</p>\
                                      <p class="card-text text-danger">Monto: '+data.monto+'</p>\
                                    </div>\
                                </div>\
                              </div>';
            $('.listTransferencias').append(cardTransferencia);
            resetFormTransferencia();
            $('#_formTransferencia').modal('hide');
            addAlert('success','El transferencia ha sido guardado correctamente :)');
          })
          .fail(function(jqXHR, textStatus, errorThrown){ 
            addAlert('error','Error: No puedo procesarse el formulario :(');
          });
    });
});
function resetFormTransferencia(){
    $('#formTransferencia').trigger("reset");
    $('#formTransferencia select').trigger('change');
    $('[name=transferencia_id]').val('');
    $('.trumbowyg-editor').html('');
}

function setConfirmada(transferencia_id){
  swal({
    title: "¿Seguro desea marcar esta transferencia como confirmada?",
    text: "Esta accion es irreversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Sí, estoy seguro!',
    cancelButtonText: "No, cancelar!"
 }).then(function(isConfirm) {
   if (isConfirm.value==true){
      $.ajax({
            url: '/transferencias/setConfirmada',
            type: 'POST',
            dataType: 'json',
            data  : {
              _token  : $('meta[name="csrf-token"]').attr('content'),
              transferencia_id : transferencia_id,
            },
        }).done(function (data) {
          swal("Confirmado!", "La transferencia se marco como cobrada", "success");
          refreshDatatable();
        });
    } else {
      swal("Cancelado", "La transferencia no ha sido modificada.", "error");
    }
  })
}
function setImputada(transferencia_id){
  swal({
    title: "¿Seguro desea generar el movimiento en la caja?",
    text: "Esta accion es irreversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Sí, estoy seguro!',
    cancelButtonText: "No, cancelar!"
 }).then(function(isConfirm) {
   if (isConfirm.value==true){
      $.ajax({
            url: '/transferencias/setImputada',
            type: 'POST',
            dataType: 'json',
            data  : {
              _token  : $('meta[name="csrf-token"]').attr('content'),
              transferencia_id : transferencia_id,
            },
        }).done(function (data) {
          swal("Confirmado!", "Se genero el movimiento en la caja!", "success");
          refreshDatatable();
        });
    } else {
      swal("Cancelado", "No se ha generado movimiento en la caja!", "error");
    }
  })
}
function refreshDatatable(){
  if(datatableTransferencia)  
      datatableTransferencia.load();
}