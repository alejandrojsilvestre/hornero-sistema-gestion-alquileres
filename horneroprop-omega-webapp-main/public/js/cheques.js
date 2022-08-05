jQuery(document).ready(function() {
    /* Inicio datatable */
    datatableCheques();
    $('#formCheque').submit(function (e) {
        e.preventDefault();
        var id = $('[name="cheque_id"]').val();
        var source = '/cheques';
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
            var cardCheque = '<div class="col-lg-12">\
                                <input type="hidden" value="'+data.id+'" name="cheques[]">\
                                <div class="card border-info mb-3" id="cardCheque">\
                                    <div class="card-header">'+data.banco.nombre+'</div>\
                                    <div class="card-body">\
                                      <p class="card-text">'+data.fecha+'</p>\
                                      <p class="card-text">Cuenta: '+data.nro_cuenta+' </p>\
                                      <p class="card-text">Nro: '+data.nro_cheque+'</p>\
                                      <p class="card-text text-danger">Monto: '+data.monto+'</p>\
                                    </div>\
                                </div>\
                              </div>';
            $('.listCheques').append(cardCheque);
            resetFormCheque();
            $('#_formCheque').modal('hide');
            addAlert('success','El cheque ha sido guardado correctamente :)');
          })
          .fail(function(jqXHR, textStatus, errorThrown){ 
            addAlert('error','Error: No puedo procesarse el formulario :(');
          });
    });
});
function resetFormCheque(){
    $('#formCheque').trigger("reset");
    $('#formCheque select').trigger('change');
    $('[name=cheque_id]').val('');
    $('.trumbowyg-editor').html('');
}
function setCobrado(cheque_id){
  swal({
    title: "¿Seguro desea marcar este cheque como cobrado?",
    text: "Esta accion es irreversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Sí, estoy seguro!',
    cancelButtonText: "No, cancelar!"
 }).then(function(isConfirm) {
   if (isConfirm.value==true){
      $.ajax({
            url: '/cheques/setCobrado',
            type: 'POST',
            dataType: 'json',
            data  : {
              _token  : $('meta[name="csrf-token"]').attr('content'),
              cheque_id : cheque_id,
            },
        }).done(function (data) {
          swal("Confirmado!", "El cheque se marco como cobrado!", "success");
          refreshDatatable();
        });
    } else {
      swal("Cancelado", "El cheque no ha sido modificado.", "error");
    }
  })
}
function setImputado(cheque_id){
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
            url: '/cheques/setImputado',
            type: 'POST',
            dataType: 'json',
            data  : {
              _token  : $('meta[name="csrf-token"]').attr('content'),
              cheque_id : cheque_id,
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
  if(datatableCheque)  
      datatableCheque.load();
}