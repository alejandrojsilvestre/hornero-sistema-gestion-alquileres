jQuery(document).ready(function() {
	/* INICIO DATATABLE */
  if(controller=='personas')
	 datatablePersonas();
	/* FIN DATATABLE */
  /* Nueva Persona */
	$('.nuevaPersona').on('click', function (e){
    resetFormPersona();
	})
  initCodPais();
	/* Agregar persona PERSONA */
	$('.addPersona').on('click', function() {
  	resetFormPersona();
		$('[name=persona_type]').val($(this).attr('data-field'));	
	});
	/* SELECCIONAR PERSONA */
	$('.searchPersona').on('click', function() {
    $('#persona_search_type').val($(this).attr('data-field'));   
    if(datatablePersona)	
      refreshDatatable();
    else
      datatablePersonas('search');
	});
	/* INICIO FORMULARIO */
	$('#formPersona').submit(function (e) {
		e.preventDefault();
		var id = $('[name="persona_id"]').val();
	  var source = '/personas';
	  var method = 'post';
		if(id.length > 0){
			source += '/' + id;
      method = 'put';
		}
	  $.ajax({
      url: source,
      type: method,
      dataType: 'json',
      data: $('#formPersona').serialize(),
    })
    .done((data) => {
      addAlert('success', data.nombre + ' ' + data.apellido + ' ha sido guardado correctamente :)');
      
      /* Cheque que no se esté editanto y si se esta asociando desde un contrato */
      if(empty(id) && $('[name=persona_type]').val() != '') {
        addToContrato(data, $('[name=persona_type]').val());
      }
      
      $('#_formPersona').modal('hide');
      resetFormPersona();

      refreshDatatable();
    })
    .fail(() => { 
      $('#_formPersona').modal('hide');
      
      addAlert('error','Error: No puedo procesarse el formulario :(');
    });
	});
	/* SELECCIONAR PERSONA */
	$('.table').on('click', '.selectPersona', function (e) { 
		if(controller=='contratos'){
			var type = $('#persona_search_type').val();
			var url = $(this).data('remote');
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            success: function (data) {
					    addToContrato(JSON.parse(data.persona),type);
            }
        });
		}
		$('#_buscarPersona').modal('hide');
  });
	/* Editar/Ver Persona */
	$('.table').on('click', '.editarPersona', function (e) { 
      // Blanqueo el formulario
      resetFormPersona();
      var url = $(this).data('remote');
      $.ajax({
          type: "GET",
          url: url,
          dataType: 'json',
          success: function (data) {
            var persona = JSON.parse(data.persona);
            $.each(persona, function (key, value) {
              if(key=='id')
                $('#formPersona [name=persona_id]').val(value);
              else
                  $('#formPersona [name=' + key + ']').val(value);
            });
            $('#formPersona #personaTipo').val(JSON.parse(data.tipos)).trigger('change');
            $('#formPersona select').trigger('change');
            // Boton perfil de persona
            $('#formPersona .perfil-persona-link').attr('href','/personas/'+persona.id+'/editar');
            $('#formPersona .perfil-persona-link').removeClass('hide');
            // codigo de pais
            initCodPais();
          }
      });
      $('#_formPersona').modal('show');
  });
  $('.enviarWhatsApp').on('click',function(){
      var personaCelular = $('#personaCelular').val();
      var cod_pais = $('#personaCodPais').val();
      if(personaCelular!='' && cod_pais != '') {
          window.open('https://api.whatsapp.com/send?phone=' + cod_pais + personaCelular,'_blank');
      }	
  });
  $('#formPersona [name=api_user]').on('change',function(){
    $.ajax({
      type: "GET",
      url: '/personas/checkUser/?user='+$('#formPersona #personaUsuario').val(),
      dataType: 'json',
      success: function (data) {
        if(data.error)
          addAlert('info',data.text);
      }
    });
  });
  $('#formPersona [name=celular]').on('change',function(){
    $.ajax({
      type: "GET",
      url: '/personas/checkCelular/?celular='+$('#formPersona #personaCelular').val(),
      dataType: 'json',
      success: function (data) {
        if(data.error)
          addAlert('info',data.text);
      }
    });
  });
  $('#formPersona [name=telefono]').on('change',function(){
    $.ajax({
      type: "GET",
      url: '/personas/checkTelefono/?telefono='+$('#formPersona #personaTelefono').val(),
      dataType: 'json',
      success: function (data) {
        if(data.error)
          addAlert('info',data.text);
      }
    });
  });
  $('#formPersona [name=email]').on('change',function(){
    $.ajax({
      type: "GET",
      url: '/personas/checkMail/?email='+$('#formPersona #personaEmail').val(),
      dataType: 'json',
      success: function (data) {
        if(data.error)
          addAlert('info',data.text);
      }
    });
  });
  $('#formPersona [name=nro_documento]').on('change',function(){
    $.ajax({
      type: "GET",
      url: '/personas/checkDocumento/?nro_documento='+$('#formPersona #personaNroDoc').val(),
      dataType: 'json',
      success: function (data) {
        if(data.error)
          addAlert('info',data.text);
      }
    });
  });
  editarPersona();
});
function addToContrato(data, type){
	var telefono = !empty(data.telefono)?data.telefono:'';
	var celular = !empty(data.celular)?data.celular:'';
	var email = !empty(data.email)?data.email:'';
	var cardPersona = '<div class="card border-info mb-3" id="cardPersona" style="max-width: 18rem;">\
                      <input type="hidden" name="'+type+'[]" value="'+data.id+'">\
                      <div class="card-header">'+data.nombre+' '+data.apellido+'</div>\
                      <div class="card-body">\
                        <p class="cardNombre"></p>\
                      <p class="cardTelefono"><i class="la la-phone"></i> ' + ((telefono) ? telefono : 'Sin dato') + '</p>\
                      <p class="cardTelefono"><i class="la la-mobile-phone"></i> ' + ((celular) ? celular : 'Sin dato') + '</p>\
                      <p class="cardEmail"><i class="la la-envelope"></i> ' + ((email) ? email : 'Sin dato') + '</p>\
                      <p>\
                        <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom editarPersona" data-remote="/personas/'+data.id+'">Ver</button>\
                        <button type="button" class="btn m-btn--pill btn-primary m-btn m-btn--custom deleteCard">Eliminar</button>\
                      </p>\
                      </div>\
                    </div>';
	$('.' + type + 'Contrato').append(cardPersona);
  editarPersona();
  deleteCard();
};
function editarPersona(){
  $('.editarPersona').on('click', function (e) { 
    // Blanqueo el formulario
  	resetFormPersona();
    var url = $(this).data('remote');
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function (data) {
          $.each(JSON.parse(data.persona), function (key, value) {
            if (key=='id') {
              $('#formPersona [name=persona_id]').val(value);
            }
            else {
              $('#formPersona [name=' + key + ']').val(value);
            }
          });
          $('#formPersona #personaTipo').val(JSON.parse(data.tipos)).trigger('change');
          $('#formPersona select').trigger('change');
          // Boton perfil de persona
          // $('#formPersona .perfil-persona-link').attr('href','/personas/' + persona.id + '/editar');
          $('#formPersona .perfil-persona-link').removeClass('hide');
        }
    });
  	$('#_formPersona').modal('show');
  });
}
function refreshDatatable(){
  if(datatablePersona)  
      datatablePersona.load();
}
function resetFormPersona(){
  $('#formPersona').trigger("reset");
  $('#formPersona #personaTipo').trigger('change');
  $('#formPersona select').trigger('change');
  $('[name=persona_id]').val('');
  $('#formPersona .perfil-persona-link').addClass('hide');
}
function initCodPais(){
  if($('#personaCelular').length != 0 && $.fn.intlTelInput != undefined) {
    var countryList = $.fn.intlTelInput.getCountryData();
    var countryIso2;
    countryList.forEach(function(countryData, index) {
        if(countryData.dialCode == $('input[name="cod_pais"]').val()) {
            countryIso2 = countryData.iso2;
            return;
        }
    });
    $('#personaCelular').intlTelInput({
        initialCountry: countryIso2,
        separateDialCode: true,
        autoPlaceholder: "off",
        onlyCountries: ['ar', 'uy', 'es', 'cl', 'bv', 'ec', 'sv', 'hn', 'mx', 'pe', 'us', 'py', 'bo', 'co', 've', 'br', 'au', 'cr'],
        preferredCountries: []
    });
    $("#personaCelular").on("countrychange", function(e, countryData) {
        $('input[name="cod_pais"]').val(countryData.dialCode);
    });
  }
}