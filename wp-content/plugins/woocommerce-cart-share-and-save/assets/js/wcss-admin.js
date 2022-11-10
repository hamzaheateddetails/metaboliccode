(function() {
    "use strict";

    // Init select2
    jQuery('.wcss-select2').select2();

    jQuery( document ).on('click', '#wcss-print-saved-cart', function(event) {
        event.preventDefault();
        jQuery( '#wcss-cart' ).printThis( {
            importStyle: true, 
        } );
    });

    jQuery( document ).on('click', '#wcss-send-saved-cart-form-tigger', function(event) {
        event.preventDefault();
        jQuery( '#wcss-send-saved-cart-form' ).slideToggle();
    });

})(jQuery)