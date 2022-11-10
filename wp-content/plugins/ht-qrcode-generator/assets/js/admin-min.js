jQuery(document).ready(function($) {
    'use strict';
    //Initiate Color Picker
    $('.htqrcode-color-picker').wpColorPicker();

    $(document).on("click", ".htqrcode-browse", function (e) {
        e.preventDefault();
        var $button = $(this);

        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
           title: 'Choose QR Code Image',
           library: {
              type: 'image'
           },
           button: {
              text: 'Select'
           },
           multiple: false 
        });
        file_frame.on('select', function () { 
           var attachment = file_frame.state().get('selection').first().toJSON();
   
           $button.siblings('input').val(attachment.url);
           $button.closest('form').find('input.widget-control-save').removeAttr("disabled");
   
        });
   
        // Finally, open the modal
        file_frame.open();
     });
});
      