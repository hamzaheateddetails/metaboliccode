const ajaxUrl                      = hubwooi18n.ajaxUrl;
const hubwooSecurity               = hubwooi18n.hubwooSecurity;

jQuery( document ).ready(function($){
	
	jQuery(document).on(
		'click',
		'.hubwoo-hide-rev-notice',
		async function() {
			let type = jQuery(this).attr('type');
			const response = await jQuery.ajax(
				{
					type : 'POST',
					url  : ajaxUrl,
					data : {
						action : 'hubwoo_hide_rev_notice',
						hubwooSecurity,
						type,
					},
					dataType : 'json',
				}
			);
			
			if( true == response.status ) {
				jQuery(this).parents('.hubwoo-review-notice-wrapper').hide();
			}
		}
	);

	// migration notice
	$(".thanks_msg").hide()
	jQuery("#email_form").submit(function(e){
		e.preventDefault();
		email = $("#email").val()
		jQuery.ajax({
			type: 'POST',
			url: ajaxUrl,
			data: {
				action: 'hubwoo_subscriber_list',
				email: email,
				hubwooSecurity,
			},
			dataType: 'json',

			success: function (resp) {
				$(".subsc_email_div").hide()
				$(".thanks_msg").show()
			}	
		});  
	});
});	