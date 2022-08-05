jQuery(document).ready(function() {
	/* INICIO DATATABLE */
	if(controller=='usuarios' && !action)
		datatableUsers();
	/* FIN DATATABLE */

	/* Nuevo Usuario */
	$('.nuevoUsuario').on('click', function (e){
		resetFormUsuario();
	})

	/* INICIO CODPAIS CELULAR */
	initCountryCode('formUsuario');
	/* FIN CODPAIS CELULAR */

	/* SELECCIONAR PERSONA */
	$('.searchUsuario').on('click', function() {
		$('#user_search_type').val($(this).attr('data-field'));   
		
		if(datatableUser)	
		refreshDatatable();
		else
		datatableUsers('search');
	});



	$('.btn-edit-profile-img').on('click',function(){
		$('.profile-img').hide();
		$('#dropzonePhoto').click();
		$('#dropzonePhoto').removeClass('hide');
	});
	/* INICIO FORMULARIO */
	$('#formUsuario').submit(function (e) {
		e.preventDefault();
		var id = $('[name="user_id"]').val();
		var source = '/usuarios';
		var method = 'post';
		if(id.length>0){
			source += '/' + id;
			method = 'put';
		}
		$.ajax({
			url: source,
			type: method,
			dataType: 'json',
			data: $('#formUsuario').serialize(),
			})
			.done(function(data, textStatus, jqXHR){
				addAlert('success',data.nombre + ' ' + data.apellido + ' ha sido guardado correctamente :)');
				$('#_formUsuario').modal('hide');
				refreshDatatable();
			})
			.fail(function(jqXHR, textStatus, errorThrown){ 
				$('#_formUsuario').modal('hide');
				addAlert('error','Error: No puedo procesarse el formulario :(');
		});
	});

	/* Editar/Ver Usuario */
	$('.table').on('click', '.editarUser', function (e) { 
      // Blanqueo el formulario
      resetFormUsuario('edit');
      var url = $(this).data('remote');
      $.ajax({
          type: "GET",
          url: url,
          dataType: 'json',
          success: function (user) {
            $.each(user, function (key, value) {
              if (key=='id') {
                $('#formUsuario [name=user_id]').val(value);
			  }
			  else {
				$('#formUsuario [name=' + key + ']').val(value);
			  }
            });
			initCountryCode('formUsuario');
			$('#formUsuario select').trigger('change');
			$('#_formUsuario').modal('show');
		}
      });
  });
  $('.enviarWhatsApp').on('click',function(){
      var userCelular = $('#userCelular').val();
      var cod_pais = $('#userCodPais').val();
      if(userCelular!='' && cod_pais != '') {
          window.open('https://api.whatsapp.com/send?phone=' + cod_pais + userCelular,'_blank');
      }	
	});
	
	$('.changeUserFormPassword').on('click',function(){
		if($('.userFormPassword').is(':disabled')) {
				$('.userFormPassword').prop('disabled', false);
		} else {
				$('.userFormPassword').prop('disabled', true);
		}
	})
	editarUser();
});

function resetFormUsuario(type = 'new'){
	$('#formUsuario').trigger("reset");
	$('#formUsuario select').trigger('change');
	$('[name=user_id]').val('');
	if (type === 'new'){
		$('.newUserFormPassword').show();
		$('.changeUserFormPassword').hide();
		$('[name=password]').prop('disabled', false)
	} else {
		$('.newUserFormPassword').hide();
		$('.changeUserFormPassword').show()
		$('[name=password]').prop('disabled', true);
	}
}

function refreshDatatable(){
	if(datatableUser)  
		datatableUser.load();
}
function editarUser(){
	$('.editarUser').on('click', function (e) { 
	  // Blanqueo el formulario
		resetFormUsuario();
	  var url = $(this).data('remote');
	  $.ajax({
		  type: "GET",
		  url: url,
		  dataType: 'json',
		  success: function (data) {
				$.each(JSON.parse(data.user), function (key, value) {
					if(key=='id')
						$('#formUsuario [name=user_id]').val(value);
					else
						$('#formUsuario [name=' + key + ']').val(value);
				});
				$('#formUsuario select').trigger('change');
		  }
	  });
		$('#_formUsuario').modal('show');
	});
}