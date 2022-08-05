jQuery(document).ready(function() {
	/* Inicio datatable */
	datatableContratos();
	/* Traigo Archivos */
	// getFiles();
  	/* SUBMIT FORMULARIO */
  	$('#formContrato').submit(function (e) {
  		e.preventDefault();
  		var id = $('[name="id"]').val();
  		if(empty($('[name=inmueble_id]').val()))
  			return addAlert('error','Error: Debe asociar un inmueble.');
		var source = '/contratos';
		var method = 'post'
  		if(id.length>0){
  			source+= '/'+id;
  			method = 'put';
  		}
		$.ajax({
		 	url: source,
		 	type: method,
		 	dataType: 'json',
		 	data: $('#formContrato').serialize(),
		  })
		  .done(function(data, textStatus, jqXHR){
		  	if(controller=="contratos")
		  		$('[name="id"]').val(data.id);
			addAlert('success','El contrato ha sido guardado correctamente :)');
		  })
		  .fail(function(jqXHR, textStatus, errorThrown){ 
			addAlert('error','Error: No puedo procesarse el formulario :(');
		  });
	});
  	/* Actualiza valores de checkbox del contrato */
	$('#formContrato input[type=checkbox]').on('click',function(){$(this).attr('value', this.checked ? 1 : 0)})

    $('#honorarios').on('focusout', function () {
        honorarios = parseFloat($('#honorarios').val());
        if (honorarios)
            $('#honorarios').val(honorarios.toFixed(2));
    });
    $('#interes').on('focusout', function () {
        interes = parseFloat($('#interes').val());
        if (interes)
            $('#interes').val(interes.toFixed(3));
    });
	/* CALCULO DE MONTOS */
	$('#monto_inicial,[name=cada],[name=porcentaje]').on('change', function() {
		var monto = $('#monto_inicial').val();
		var cada = $('[name=cada]').val();
		var porcentaje = $('[name=porcentaje]').val();
		if(!empty(monto) && !empty(cada) && !empty(porcentaje)){
			var inicio = $('[name=inicio]').val();
			var fin = $('[name=fin]').val();
			if(empty(inicio) || empty(fin)){
				addAlert('error', 'Error: No se pudo cargar escalonamiento. Debe cargar inicio y finalizacion de contrato :(')
				return $(this).val('');
			}
			$('.montosContrato').html('');
			$.ajax({
			 	url: '/contratos/calcularMontos',
			 	type: 'GET',
			 	dataType: 'json',
			 	data: {inicio:inicio,fin:fin,monto:monto, cada: cada, porcentaje: porcentaje},
			  })
			  .done(function(data, textStatus, jqXHR){
		 		 var fechaAnterior = $('[name=inicio]').val();
				 $.each(data, function(i,data){
					var cardMonto = '<div class="col-lg-3">\
										<input type="hidden" name="montos['+i+'][monto]" value="'+data.monto+'">\
										<input type="hidden" name="montos['+i+'][desde]" value="'+fechaAnterior+'">\
										<input type="hidden" name="montos['+i+'][hasta]" value="'+data.fecha+'">\
										<div class="card border-danger mb-3" id="cardMonto" style="max-width: 18rem;">\
						                  <div class="card-header">Periodo '+i+'</div>\
						                  <div class="card-body text-danger">\
						                    <h5 class="card-title">\
						                      <div class="modificarMonto" data-id="'+i+'" data-value="'+data.monto+'" id="monto_'+i+'">\
						                          <a class="m-tooltip"  data-skin="dark" data-placement="top" title="Modificar monto">\
						                              <b>'+$('[name=moneda_id] option:selected').text()+' '+data.monto+'</b>\
						                          </a>\
						                      </div>\
						                      <div style="display: none" id="monto_input_'+i+'">\
						                        <div class="input-group">\
						                        <input class="form-control m-input input-medium" id="monto_value_'+i+'" name="" type="text" placeholder="'+data.monto+'"\
						                          <span class="input-group-addon" id="basic-addon1">\
						                            <a class="m-tooltip guardarMonto" data-id="'+i+'" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Guardar monto">\
						                                <i class="la la-save" style="margin-top:5px;font-size:30px;color:black;"></i>\
						                            </a>\
						                          </span>\
						                        </div>\
						                      </div>\
						                    </h5>\
						                    <p class="card-text">Desde: '+fechaAnterior+'</p>\
						                    <p class="card-text">Hasta: '+data.fecha+'</p>\
						                  </div>\
		                				</div>\
	                				</div>';
	               	fechaAnterior = data.fecha;
					$('.montosContrato').append(cardMonto);
				});
				$('.modificarMonto').on('click', function() {modificar_monto($(this).data('id'));});
				$('.guardarMonto').on('click', function() {guardarMonto($(this).data('id'));});
			  })
			  .fail(function(jqXHR, textStatus, errorThrown){ 
				addAlert('error','Error: Hubo un error al calcular los montos, por favor verifique los datos cargados :(');
		 	});
		}
	});
	$('.modificarMonto').on('click', function() {
		modificar_monto($(this).data('id'));
	});
	$('.guardarMonto').on('click', function() {
		guardarMonto($(this).data('id'));
	});
	/* Setea cobro como liquidado */
	$('.setLiquidado').on('click', function() {
		setLiquidado($(this));
	});

	$('#formContrato [name="honorarios"]').change(function () {
		if (empty($(this).val())) {
			$('#formContrato [name="honorarios_fijos"]').attr('required');
		} else {
			$('#formContrato [name="honorarios_fijos"]').removeAttr('required');
		}
	});

	$('#formContrato [name="honorarios_fijos"]').change(function () {
		if (empty($(this).val())) {
			$('#formContrato [name="honorarios"]').attr('required');
		} else {
			$('#formContrato [name="honorarios"]').removeAttr('required');
		}
	});

	$('#formContrato [type="submit"]').click(function(){
		var elms = [];
		$('input, textarea, select').each(function(){
			if ($(this).attr('tabindex') !== -1) {
				elms.push({
					elm: $(this),
					tabindex: parseInt($(this).attr('tabindex'))
				})
			}
		});
    	elms.sortByObjectProperty('tabindex');
		for (var i = 0; i < elms.length; i++) {
			if (!elms[i].elm[0].checkValidity()) {
				var tabId = elms[i].elm.closest('.tab-pane').attr('id');
				$('.nav-tabs a[href="#' + tabId + '"]').tab('show');
				return;
			}
		}
	});
});

/* Setea cobro como liquidado */
function setLiquidado(btn){
	var id = btn.data('id');
	if (empty(id))
		return addAlert('error', 'Error: No selecciono ningun pago :(');
	$.ajax({
	 	url: '/gestiones/set-liquidated-from-contract',
	 	type: 'GET',
	 	dataType: 'json',
	 	data: {id:id},
	  })
	  .done(function(data, textStatus, jqXHR){
	  	btn.hide();
		addAlert('success','El registro se marcó como cobrado.');
	  })
	  .fail(function(jqXHR, textStatus, errorThrown){ 
		addAlert('error','Error: No se ha podido marcar como cobrado.');
	  });
}
function addMonthToFin(months){
	if (empty($('[name=inicio]').val())) {
		return addAlert('info', 'Debe completar la fecha de inicio');
	}
  	var parts = $('[name=inicio]').val().split('-');
    var date = new Date(parseInt(parts[2], 10), parseInt(parts[1], 10) - 1, parseInt(parts[0], 10));
    date = date.addMonths(months);
 	$('[name=fin]').datepicker('setDate', date);;
}
function generarCuotas(){
	var id = $('[name=id]').val();
	if (empty(id))
		return addAlert('error', 'Error: Debe guardar el contrato para generar cuotas');
	$.ajax({
	 	url: '/contratos/generarCuotas',
	 	type: 'GET',
	 	dataType: 'json',
	 	data: {id:id},
	  })
	  .done(function(data, textStatus, jqXHR){
	  	if (data.error)
	  		return addAlert('info','Las cuotas ya fueron generadas.');
	  	if (empty(data.cuotas))
	  		return addAlert('info','Se requiere generar los montos y guardar el contrato.');
        $('.periodos').html('');
		$.each(data.cuotas, function(i,data){
			i = i+1;
			var cardCuota = '<div class="col-lg-3">\
				                <div class="card border-warning mb-3" id="cardCuota" style="max-width: 18rem;">\
				                    <div class="card-header">Cuota '+i+'</div>\
				                    <div class="card-body">\
				                      	<p class="card-text">'+mesesDelAnio[data.mes-1]+' - '+data.ano+'</p>\
				                      	<p class="card-text text-danger">Monto: '+data.monto+'</p>\
				                      	<p class="card-text text-danger">Honorarios: '+data.honorarios+'</p>\
			                            <a class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--pill m-tooltip setLiquidado" data-skin="dark" data-placement="bottom" title="" data-id="'+data.id+'" data-original-title="Marcar como Cobrado">\
			                              <i class="fa fa-check"></i>\
			                            </a>\
				                    </div>\
				                </div>\
				              </div>';
			$('.contratoCuotas').append(cardCuota);
			//Periodos
			$('.periodos').append('<option value='+data.id+'>'+mesesDelAnio[data.mes-1]+' - '+data.ano+'</option>');
		});
		addAlert('success','Las cuotas fueron generadas correctamente :)');
		$('.m-tooltip').tooltip();
		$('.setLiquidado').on('click', function() {
			setLiquidado($(this));
		});
	  })
	  .fail(function(jqXHR, textStatus, errorThrown){ 
		addAlert('error','Error: Las cuotas ya fueron generadas.');
	  });
}

function eliminarCuotas(){
	var id = $('[name=id]').val();
	if (empty(id))
		return addAlert('error', 'Error: Debe guardar el contrato para eliminar cuotas');
	$.ajax({
	 	url: '/contratos/eliminarCuotas',
	 	type: 'GET',
	 	dataType: 'json',
	 	data: {id:id},
	  })
	  .done(function(data, textStatus, jqXHR){
	  	if (data.error)
	  		return addAlert('error','Error: No se pueden eliminar las cuotas si al menos una fue liquidada.');
		$('.contratoCuotas').html('');
		addAlert('info','Las cuotas fueron eliminadas correctamente. Puede volver a generarlas.');
	  })
	  .fail(function(jqXHR, textStatus, errorThrown){
		addAlert('error','Error: No se pudo procesar el pedido.');
	  });
}
function modificar_monto(monto_id) {
    var monto_actual = $('#monto_' + monto_id).html();
    $('#monto_input_' + monto_id).css({'display': 'inline'});
    $('#monto_' + monto_id).css({'display': 'none'});
    $('#monto_value_' + monto_id).focus();
    $('#guardar_monto_' + monto_id).show();
}

function guardarMonto(monto_id) {
    var monto = $('#monto_value_' + monto_id).val();
    var contrato_id = $('[name=id]').val();
	var monto_anterior = $('#monto_' + monto_id).data('value');

    if (empty(contrato_id)) {
		return addAlert('info', 'No se realizo el cambio. Debe guardar el contrato para modificar montos.');
	}
    if (empty(monto)) {
		return addAlert('info', 'No se realizo el cambio. Asegurate de haber cargado el nuevo monto.');
	}

    $.ajax({
        type: 'GET',
        url: '/contratos/modificarMonto',
        data: {
            monto_id: monto_id,
            contrato_id: contrato_id,
            monto_anterior: monto_anterior,
            monto: monto
        },
        success: function(error) {
        	if (error.code === 1) {
        		return addAlert('error', error.text);
			}
            $('#monto_' + monto_id).html(monto);
            $('#monto_input_' + monto_id).css({'display': 'none'});
            $('#monto_' + monto_id).css({'display': 'inline'});
    		$('#monto_' + monto_id).data('value', monto);
        }
	})
}

// DROPZONE - TRAEM LOS ARCHIVOS YA CARGADOS

function getFiles(){
	contrato_id = $('[name=id]').val()
	$.ajax({
	 	url: '/contratos/getFiles',
	 	type: 'GET',
	 	dataType: 'json',
	 	data: {contrato_id:contrato_id},
	  })
	  .done(function(data, textStatus, jqXHR){
		 $.each(data, function(i,data){
		 	var mockFile = { name: data.nombre_original, size: data.tamano };
            $('#dropzoneArchivos')[0].dropzone.emit("addedfile", mockFile);
            $('#dropzoneArchivos')[0].dropzone.emit("thumbnail", mockFile, "/WebResources/cre_pdf_icon");
            // Make sure that there is no progress bar, etc...
            $('#dropzoneArchivos')[0].dropzone.emit("complete", mockFile);
		});
	  })
	  .fail(function(jqXHR, textStatus, errorThrown){ 
		addAlert('error','Error: Hubo un error al traer los archivos asociados');
 	});
}

// DROPZONE - SE AGREGA ID DE CONTRATO AL REQUEST
Dropzone.prototype.submitRequest = function(xhr, formData, files) {
  	xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
	formData.append("contrato_id", $('[name=id]').val());
  	return xhr.send(formData);
};  
// FIN DROPZONE

