(function ($) {
    var WidgetElements_imagesDistortionHandler = function ($scope, $) {

        // planetary

        var contentDistortion = $scope.find('.dce_distortion-content');
        var containerDistortion = $scope.find('.dce_distortion-slider');

        var fragment_style = containerDistortion.attr('data-fragment-style');
        eval('var fragment_selected = fragment_'+fragment_style);

        var speedDistortion = Number(containerDistortion.attr('data-speed'));
        var progressdistortion = Number(containerDistortion.attr('data-progress'));

        var value_width = Number(containerDistortion.attr('data-width'));
        var value_radius = Number(containerDistortion.attr('data-radius'));
        var value_intensity = Number(containerDistortion.attr('data-intensity'));
        var value_scalex = Number(containerDistortion.attr('data-scalex'));
        var value_scaley = Number(containerDistortion.attr('data-scaley'));

        var uniform_selected = {};

        switch(fragment_style) {
		  case 'drip':
		  		$.extend(uniform_selected, {
		  			width: {value: value_width, type:'f', min:0, max:10},
					scaleX: {value: value_scalex, type:'f', min:0.1, max:60},
					scaleY: {value: value_scaley, type:'f', min:0.1, max:60}
				});
		    break;
		  case 'wave':
		  		$.extend(uniform_selected, {
		  			width: {value: value_width, type:'f', min:0, max:10}
				});
		    break;
		  case 'ring':
		  		$.extend(uniform_selected, {
		  			radius: {value: value_radius, type:'f', min:0.1, max:2},
					width: {value: value_width, type:'f', min:0., max:1},
				});
		    break;
		  case 'horizdisp':
		  		$.extend(uniform_selected, {

				});
		    break;
		  case 'vertdisp':
		  		$.extend(uniform_selected, {
		  			intensity: {value: value_intensity, type:'f', min:0., max:2},
				});
		    break;
		  case 'displacement':
		  		$.extend(uniform_selected, {
		  			intensity: {value: value_intensity, type:'f', min:0., max:3},
				});
		    break;
		  case 'subdivision':
		  		$.extend(uniform_selected, {
		  			intensity: {value: value_intensity, type:'f', min:1., max:100},
				});
		    break;
		  case 'blow':
		  		$.extend(uniform_selected, {
		  			intensity: {value: value_intensity, type:'f', min:1, max:100},
				});
		    break;
		  default:

		}

        if($('.dg').length) $('.dg').empty();
        let sketch = new Sketch({
			content: contentDistortion[0],
			container: containerDistortion[0],

			debug: false,
			duration: speedDistortion,
			//easing: 'easeOut',
			uniforms: uniform_selected,
			fragment: fragment_selected
		});

    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/dyncontel-imagesDistortion.default', WidgetElements_imagesDistortionHandler);
    });
})(jQuery);
