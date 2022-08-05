jQuery(document).ready(function() {
	/* INICIO DATATABLE */
  	if(controller=='inmuebles')
		datatableInmuebles();
  	/* FIN DATATABLE */
	/* Agregar inmueble INMUEBLE */
	$('.addInmueble').on('click', function() {
  		resetFormInmueble();
	});
	/* SELECCIONAR PERSONA */
	$('.searchInmueble').on('click', function() {
		datatableInmuebles();
	});
	/* INICIO FORMULARIO */
	$('#formInmueble').submit(function (e) {
		e.preventDefault();
		var id = $('[name="inmueble_id"]').val();
	  	var source = '/inmuebles';
	  	var method = 'post';
		if(id.length > 0){
			source+= '/'+id;
			method = 'put';
		}
	$.ajax({
	 	url: source,
	 	type: method,
	 	dataType: 'json',
	 	data: $('#formInmueble').serialize(),
	  })
	  .done(function(data, textStatus, jqXHR){
		addAlert('success','El Inmueble ha sido guardado correctamente :)');

	  	// Si esta desde contrato lo agrego a los campos, sino actualizo datatable
		if (controller=='contratos') {
	  		$('#formContrato [name=inmueble_id]').val(data.id)
	  		$('#formContrato #formContratoDireccion').val(data.direccion)
		} else {
			refreshDatatable();
		}

		$('#_formInmueble').modal('hide');
	  })
	  .fail(function(jqXHR, textStatus, errorThrown){ 
		$('#_formInmueble').modal('hide');
		addAlert('error','Error: No puedo procesarse el formulario :(');
	  });
	});
	/* SELECCIONAR INMUEBLE */
	$('.table').on('click', '.selectInmueble', function (e) { 
		if(controller === 						'contratos'){
			var url = $(this).data('remote');
	        $.ajax({
	            type: "GET",
	            url: url,
	            dataType: 'json',
	            success: function (data) {
					$('#formContrato [name=inmueble_id]').val(data.id)
					$('#formContrato #formContratoDireccion').val(data.direccion)
	            }
	        });
		}
		$('#_buscarInmueble').modal('hide');
 	});
	/* Editar/Ver Inmueble */
	$('.table').on('click', '.editProperty', function (e) { 
      editProperty(this);
  });
  editProperty();
});
function editProperty(){
  $('.editProperty').on('click', function (e) { 
    // Blanqueo el formulario
  	resetFormInmueble();
    var url = $(this).data('remote');
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function (data) {
          $.each(data, function (key, value) {
          	if(key=='id')
          		$('#formInmueble [name=inmueble_id]').val(value);
          	else
              	$('#formInmueble [name=' + key + ']').val(value);
          });
          $('#formInmueble select').trigger('change');
        }
    });
  	$('#_formInmueble').modal('show');
  });
}
function refreshDatatable(){
	if(datatableInmueble)
  		datatableInmueble.load();
}
function resetFormInmueble(){
  $('#formInmueble').trigger("reset");
  $('#formInmueble select').trigger('change');
  $('[name=inmueble_id]').val('');
}