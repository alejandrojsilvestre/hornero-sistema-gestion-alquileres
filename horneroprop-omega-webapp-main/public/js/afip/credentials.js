jQuery(document).ready(function() {
	/* Datatable */
	if (controller=='afip') {
		datatableAfipCredentials();
	}

	/* New credential event  */
	$('.newAfipCredential').on('click', (e) => {
		resetAfipCredentialForm();
	})

	/* BEGIN: Form */
	$('#afipCredentialForm').submit(function (e) {
		e.preventDefault();
		var id = $('[name="credential_id"]').val();
		var source = '/afip/credenciales';

		if (id.length > 0) {
			source += '/' + id + '?_method=PUT';
		}

		$.ajax({
			url: source,
			type: 'POST',
			dataType: 'json',
			data: new FormData(this),
            contentType: false,
            processData: false,
		})
		.done(() => {
			refreshDatatable();
			addAlert('success', 'La credencial ha sido guardada correctamente!');
			$('#_afipCredentialForm').modal('hide');
			resetAfipCredentialForm();
		})
		.fail(() => { 
			$('#_afipCredentialForm').modal('hide');
			addAlert('error', 'Error: No puedo procesarse el formulario!');
		});
	});
	/* END: Form */
	/* Edit */
	$('.table').on('click', '.editAfipCredential', function (e) { 

		var url = $(this).data('remote');
	  	resetAfipCredentialForm();
	  
		$.ajax({
			type: "GET",
			url: url,
			dataType: 'json',
			success: function (credential) {
				$.each(credential, function (key, value) {
				if (key === 'id') {
					$('#afipCredentialForm [name=credential_id]').val(value);
				} else {
					$('#afipCredentialForm [name=' + key + ']').val(value);
				}
				});
				$('#afipCredentialForm #afipCredentialFormUsers').val(credential.users);
				$('#afipCredentialForm select').trigger('change');
			}
		});
		$('#_afipCredentialForm').modal('show');
	});
});

function resetAfipCredentialForm(){
	$('#afipCredentialForm').trigger("reset");
	$('#afipCredentialForm select').trigger('change');
	$('[name=credential_id]').val('');
}

function refreshDatatable(){
	if (datatableAfipCredential) {
		datatableAfipCredential.load();
	}
}