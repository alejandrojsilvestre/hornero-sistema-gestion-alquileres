var datatableContrato;
var datatablePersona;
var datatableUser;
var datatableInmueble;
var datatableCheque;
var datatableTransferencia;

var datatableAfipCredential;
var datatableAfipInvoice;

function datatableContratos(action='datatable')
{
	/* CHEQUEO SI ES UN DATATABLE PARA SELECCIONAR */
	if($('#contratos-table').attr('action')=='search') 
      var source = 'datatableSearch'; 
    else 
      var source = 'datatable'; 
	/* INICIO DATATABLE */
	$('#contratos-table').each(function(){
		datatableContrato = $('#contratos-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/contratos/' + source,
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    // columns definition
		    columns: [ {
		        field: 'accion',
		        title: '',
		        sortable: false,
		        orderable: false, 
		        searchable: false,
        		width: 130,
		      },
		      {
		        field: 'carpeta',
		        title: '#',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 70,
		      },
		      {
		        field: 'direccion',
		        title: 'Direccion',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 175,
		      },
		      {
		        field: 'inicio',
		        title: 'Inicio',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 85,
		      },
		      {
		        field: 'fin',
		        title: 'Fin',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 85,
		      },
		      {
		        field: 'inquilinos',
		        title: 'Inquilinos',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 250,
		      },
		      {
		        field: 'propietarios',
		        title: 'Propietarios',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 250,
		      },
		      {
		        field: 'garantes',
		        title: 'Garantes',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 300,
		      },
		    ],
	 	});
	  	var query = datatableContrato.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableContrato.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableContrato.setDataSourceQuery(query);
		    datatableContrato.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableContrato.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableContrato.setDataSourceQuery(query);
		    datatableContrato.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	});
  	$('#m_form_status, #m_form_type').selectpicker();
  	/* FIN DATATABLE */
}
function datatablePersonas(action='datatable')
{
	/* CHEQUEO SI ES UN DATATABLE PARA SELECCIONAR */
	if($('#personas-table').attr('action')=='search') 
  		var source = 'datatableSearch/'; 
    else 
      	var source = 'datatable'; 
	/* INICIO DATATABLE */
	$('#personas-table').each(function(){
		datatablePersona = $('#personas-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/personas/' + source,
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		      serverSide: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    // columns definition
		    columns: [ {
		        field: 'accion',
		        title: '',
		        sortable: false,
		        orderable: false, 
		        searchable: false,
        		width: 130,
		      },
		      {
		        field: 'nombre',
		        title: 'Nombre',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 140,
		      }, {
		        field: 'apellido',
		        title: 'Apellido',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 140,
		      }, {
		        field: 'email',
		        title: 'E-mail',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 250,
		      }, {
		        field: 'telefono',
		        title: 'Telefono',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 100,
		      }, {
		        field: 'celular',
		        title: 'Celular',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 100,
		      }, {
		        field: 'nro_documento',
		        title: 'N. Doc.',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 80,
		      }, {
		        field: 'direccion',
		        title: 'Direccion',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
		        width : 200,
		      },
		    ],
	 	});
	  	var query = datatablePersona.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatablePersona.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatablePersona.setDataSourceQuery(query);
		    datatablePersona.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatablePersona.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatablePersona.setDataSourceQuery(query);
		    datatablePersona.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	  	$('#m_form_status, #m_form_type').selectpicker();
  	});
  	$('#m_form_status, #m_form_type').selectpicker();
  	/* FIN DATATABLE */
}
function datatableUsers(action='datatable')
{
	/* INICIO DATATABLE */
	if($('#users-table').length > 0){
		datatableUser = $('#users-table').mDatatable({
			// datasource definition
			data: {
			type: 'remote',
			source: {
				read: {
				// sample GET method
				method: 'GET',
				url: 'usuarios/' + action,
				map: function(raw) {
					// sample data mapping
					var dataSet = raw;
					if (typeof raw.data !== 'undefined') {
					dataSet = raw.data;
					}
					return dataSet;
				},
				},
			},
			pageSize: 10,
			serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
			},
			// layout definition
			layout: {
			theme: 'default', // datatable theme
			class: '', // custom wrapper class
			scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
			footer: false // display/hide footer
			},
			// column sorting
			sortable: true,
			pagination: true,
			toolbar: {
			// toolbar items
			items: {
				// pagination
				pagination: {
				// page size select
				pageSizeSelect: [10, 20, 30, 50, 100],
				},
			},
			},
			search: {
			input: $('#generalSearch'),
			},
			// columns definition
			columns: [ {
				field: 'accion',
				title: '',
				sortable: false,
				orderable: false, 
				searchable: false,
				width: 130,
			},
			{
				field: 'nombre',
				title: 'Nombre',
				sortable: true, // disable sort for this column
				textAlign: 'left',
			}, {
				field: 'apellido',
				title: 'Apellido',
				sortable: true, // disable sort for this column
				textAlign: 'left',
			}, {
				field: 'email',
				title: 'E-mail',
				sortable: true, // disable sort for this column
				textAlign: 'left',
			}, {
				field: 'telefono',
				title: 'Telefono',
				sortable: true, // disable sort for this column
				textAlign: 'left',
			}, {
				field: 'celular',
				title: 'Celular',
				sortable: true, // disable sort for this column
				textAlign: 'left',
			}, {
				field: 'direccion',
				title: 'Direccion',
				sortable: true, // disable sort for this column
				textAlign: 'left',
			},
			],
		});
		var query = datatableUser.getDataSourceQuery();
		$('#m_form_status').on('change', function() {
			// shortcode to datatable.getDataSourceParam('query');
			var query = datatableUser.getDataSourceQuery();
			query.Status = $(this).val().toLowerCase();
			// shortcode to datatable.setDataSourceParam('query', query);
			datatableUser.setDataSourceQuery(query);
			datatableUser.load();
		}).val(typeof query.Status !== 'undefined' ? query.Status : '');
		$('#m_form_type').on('change', function() {
		// shortcode to datatable.getDataSourceParam('query');
			var query = datatableUser.getDataSourceQuery();
			query.Type = $(this).val().toLowerCase();
			// shortcode to datatable.setDataSourceParam('query', query);
			datatableUser.setDataSourceQuery(query);
			datatableUser.load();
		}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	  $('#m_form_status, #m_form_type').selectpicker();
	  
	}
  	/* FIN DATATABLE */
}
function datatableInmuebles(action='datatable')
{
	/* CHEQUEO SI ES UN DATATABLE PARA SELECCIONAR */
	if($('#inmuebles-table').attr('action')=='search') 
      var source = 'datatableSearch'; 
    else 
      var source = 'datatable'; 
	/* INICIO DATATABLE */
	$('#inmuebles-table').each(function(){
		datatableInmueble = $('#inmuebles-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/inmuebles/' + source,
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    // columns definition
		    columns: [ {
		        field: 'accion',
		        title: '',
		        sortable: false,
		        orderable: false, 
		        searchable: false,
	        	width: 120,
		      },
		      {
		        field: 'tipo.nombre',
		        title: 'Tipo',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
	        	width: 60,
		      },
		      {
		        field: 'direccion',
		        title: 'Direccion',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
	        	width: 250,
		      },
		      {
		        field: 'ambientes',
		        title: 'Amb.',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
	        	width: 40,
		      },
		      {
		        field: 'dormitorios',
		        title: 'Dor.',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
	        	width: 35,
		      },
		    ],
	 	});
	  	var query = datatableInmueble.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableInmueble.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableInmueble.setDataSourceQuery(query);
		    datatableInmueble.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableInmueble.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableInmueble.setDataSourceQuery(query);
		    datatableInmueble.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	});
  	$('#m_form_status, #m_form_type').selectpicker();
  	/* FIN DATATABLE */
}
function datatableCheques(action='datatable')
{
	/* CHEQUEO SI ES UN DATATABLE PARA SELECCIONAR */
	if($('#cheques-table').attr('action')=='search') 
      var source = 'datatableSearch'; 
    else 
      var source = 'datatable'; 
	/* INICIO DATATABLE */
	$('#cheques-table').each(function(){
		datatableCheque = $('#cheques-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/cheques/' + source,
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    rows: {
		      callback: function() { $('#cheques-table .m-tooltip').tooltip();},
		    },
		    // columns definition
		    columns: [ {
		        field: 'accion',
		        title: '',
		        sortable: false,
		        orderable: false, 
		        searchable: false,
        		width: 130,
		      },
		      {
		        field: 'banco',
		        title: 'Banco',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 200,
		      },
		      {
		        field: 'nro_cuenta',
		        title: 'Nro. Cuenta',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 150,
		      },
		      {
		        field: 'nro_cheque',
		        title: 'Nro. Cheque',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 150,
		      },
		      {
		        field: 'monto',
		        title: 'Monto',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 100,
		      },
		      {
		        field: 'cobros',
		        title: 'Contrato | Periodo',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 250,
		      },
		      {
		        field: 'fecha',
		        title: 'Fecha',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 100,
		      },
		      {
		        field: 'notas',
		        title: 'Notas',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
		      },
		    ],
	 	});
	  	var query = datatableCheque.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableCheque.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableCheque.setDataSourceQuery(query);
		    datatableCheque.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableCheque.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableCheque.setDataSourceQuery(query);
		    datatableCheque.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	});
  	$('#m_form_status, #m_form_type').selectpicker();
  	/* FIN DATATABLE */
}

function datatableTransferencias(action='datatable')
{
	/* CHEQUEO SI ES UN DATATABLE PARA SELECCIONAR */
	if($('#transferencias-table').attr('action')=='search') 
      var source = 'datatableSearch'; 
    else 
      var source = 'datatable'; 
	/* INICIO DATATABLE */
	$('#transferencias-table').each(function(){
		datatableTransferencia = $('#transferencias-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/transferencias/' + source,
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    rows: {
		      callback: function() { $('#transferencias-table .m-tooltip').tooltip();},
		    },
		    // columns definition
		    columns: [ {
		        field: 'accion',
		        title: '',
		        sortable: false,
		        orderable: false, 
		        searchable: false,
        		width: 130,
		      },
		      {
		        field: 'banco',
		        title: 'Banco',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 200,
		      },
		      {
		        field: 'nro',
		        title: 'Cod. Transferencia',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 150,
		      },
		      {
		        field: 'monto',
		        title: 'Monto',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 100,
		      },
		      {
		        field: 'cobros',
		        title: 'Contrato | Periodo',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 250,
		      },
		      {
		        field: 'fecha',
		        title: 'Fecha',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 100,
		      },
		      {
		        field: 'notas',
		        title: 'Notas',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 150,
		      },
		    ],
	 	});
	  	var query = datatableTransferencia.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableTransferencia.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableTransferencia.setDataSourceQuery(query);
		    datatableTransferencia.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableTransferencia.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableTransferencia.setDataSourceQuery(query);
		    datatableTransferencia.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	});
  	$('#m_form_status, #m_form_type').selectpicker();
  	/* FIN DATATABLE */
}
function datatableAfipCredentials()
{
	$('#afip-credentials-table').each(function(){
		datatableAfipCredential = $('#afip-credentials-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/afip/credenciales/datatable',
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    // columns definition
		    columns: [ {
		        field: 'accion',
		        title: '',
		        sortable: false,
		        orderable: false, 
		        searchable: false,
        		width: 150,
		      },
		      {
		        field: 'business_name',
		        title: 'Razon Social',
		        sortable: true, // disable sort for this column
		        textAlign: 'center',
        		width: 100,
		      },
		      {
		        field: 'responsable_number',
		        title: 'C.U.I.T.',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 100,
		      },
		      {
		        field: 'ib',
		        title: 'Ingresos Brutos',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 100,
		      },
		      {
		        field: 'sales_point',
		        title: 'Punto de venta',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 100,
		      },
		      {
		        field: 'activity_started_at',
		        title: 'Inicio de Actividades',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 100,
		      },
		    ],
	 	});
	  	var query = datatableAfipCredential.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableAfipCredential.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableAfipCredential.setDataSourceQuery(query);
		    datatableAfipCredential.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableAfipCredential.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableAfipCredential.setDataSourceQuery(query);
		    datatableAfipCredential.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	});
  	$('#m_form_status, #m_form_type').selectpicker();
}
function datatableAfipInvoices()
{
	$('#afip-invoices-table').each(function(){
		datatableAfipInvoice = $('#afip-invoices-table').mDatatable({
		    // datasource definition
		    data: {
		      type: 'remote',
		      source: {
		        read: {
		          // sample GET method
		          method: 'GET',
		          url: '/afip/facturas/datatable',
		          map: function(raw) {
		            // sample data mapping
		            var dataSet = raw;
		            if (typeof raw.data !== 'undefined') {
		              dataSet = raw.data;
		            }
		            return dataSet;
		          },
		        },
		      },
		      pageSize: 10,
		      serverPaging: true,
		      serverFiltering: true,
		      serverSorting: true,
		    },
		    // layout definition
		    layout: {
		      theme: 'default', // datatable theme
		      class: '', // custom wrapper class
		      scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
		      footer: false // display/hide footer
		    },
		    // column sorting
		    sortable: true,
		    pagination: true,
		    toolbar: {
		      // toolbar items
		      items: {
		        // pagination
		        pagination: {
		          // page size select
		          pageSizeSelect: [10, 20, 30, 50, 100],
		        },
		      },
		    },
		    search: {
		      input: $('#generalSearch'),
		    },
		    // columns definition
		    columns: [ {
		        field: 'cae',
		        title: 'CAE',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 200,
		      },
		      {
		        field: 'monto',
		        title: 'Monto',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 100,
		      },
		      {
		        field: 'iva',
		        title: 'I.V.A.',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 100,
		      },
		      {
		        field: 'credential',
		        title: 'Credencial',
		        sortable: true, // disable sort for this column
		        textAlign: 'left',
        		width: 150,
		      },
		    ],
	 	});
	  	var query = datatableAfipInvoice.getDataSourceQuery();
	  	$('#m_form_status').on('change', function() {
		    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableAfipInvoice.getDataSourceQuery();
		    query.Status = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableAfipInvoice.setDataSourceQuery(query);
		    datatableAfipInvoice.load();
	  	}).val(typeof query.Status !== 'undefined' ? query.Status : '');
	  	$('#m_form_type').on('change', function() {
	    // shortcode to datatable.getDataSourceParam('query');
		    var query = datatableAfipInvoice.getDataSourceQuery();
		    query.Type = $(this).val().toLowerCase();
		    // shortcode to datatable.setDataSourceParam('query', query);
		    datatableAfipInvoice.setDataSourceQuery(query);
		    datatableAfipInvoice.load();
	  	}).val(typeof query.Type !== 'undefined' ? query.Type : '')
	});
  	$('#m_form_status, #m_form_type').selectpicker();
}