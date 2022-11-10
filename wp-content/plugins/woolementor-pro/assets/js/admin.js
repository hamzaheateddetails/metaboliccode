jQuery(function($){

	$('.wl-select2').select2();

	var fields = {};
	fields['wl-email'] 		= ['email_type'];
	fields['wl-header'] 	= ['page_includes', 'tax_includes'];
	fields['wl-footer'] 	= ['page_includes', 'tax_includes'];
	fields['wl-archive'] 	= ['tax_includes'];

	$(document).on( 'change', '#elementor-new-template__form__template-type', function(e) {
		e.preventDefault()
		var template_type = $(this).val();
		$('.wl-tm-form-fields').hide();
		$('.wl-template-conditions').prop( 'disabled', true );

		if ( typeof fields[template_type] != 'undefined' ) {
			$.each( fields[template_type], function(index, value) {

				$('#wl_'+value+'_fields').show();
				$('#wl_'+value ).prop( 'disabled', false );
			} );
		}
		
	} ).change()
})