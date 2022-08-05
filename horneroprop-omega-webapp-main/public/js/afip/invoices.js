jQuery(document).ready(function() {
	/* BEGIN: Datatable */
	if (controller=='afip') {
		datatableAfipInvoices();
	}
	/* END: Datatable */
});

function refreshDatatable(){
	if(datatableAfipInvoice)  
		datatableAfipInvoice.load();
}