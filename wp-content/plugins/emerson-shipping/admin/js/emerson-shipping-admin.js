(function ($) {
	'use strict';

	$(function () {

		/**
		 * Section for check connection
		 */
		var form = $('#saveLogsEmerson').parent().parent().parent().parent().parent().parent().parent();

		var item = '<button name="save" class="button-primary js-check-connection" type="submit" value="Check connection with saved data">Check connection with saved data</button>';
		$(form).find('.submit').append(item);
		$('.js-check-connection').on('click', function (event) {
			event.preventDefault();
			event.stopPropagation();
			$.ajax({
				url: '/wp-json/emerson-shipping/v1/check-connection',
				type: 'post',
				dataType: 'json',
				cache: 'false',
				data: {
					'_ajax_nonce': $('#emerson_config_nonce').val()
				},
				success: (data) => {
					alert(data);
				}
			});
		})

		function validURL(str) {
			var parser = document.createElement('a');
			parser.href = str;
			var version= parser.pathname.split('/')[1].trim();
			console.log(parser.origin + '/' +  version , str);
			return parser.origin + '/' +  version == str && version!='';
				
		}

		function validateUrl() {
			var result = validURL($(form).find('#apiUrl').val());
			var color = result ? '#646970' : '#ff0000';
			$(form).find('#apiUrl').parent().find('.description').css('color', color);
			return result;
		}

		$(form).find('#apiUrl').on('keyup', function () {
			validateUrl();
		})

		$(form).find('.woocommerce-save-button').on('click', function () {
			return validateUrl();
		})

	});
})(jQuery);
