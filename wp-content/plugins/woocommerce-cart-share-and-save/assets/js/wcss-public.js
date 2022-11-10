(function($) { 
"use strict"; 

    var admin_url = wcssObj.ajax_url;
    var loader = '<div class="wcss-spinner">';
        loader += '<div class="wcss-dot1"></div>';
        loader += '<div class="wcss-dot2"></div>';
        loader += '</div>';

    function shaker( selector ) {

        jQuery( selector ).addClass('wcss-shake-animation');
        setTimeout( function() {
            jQuery( selector ).removeClass('wcss-shake-animation');
        }, 300 );
    }

    function validate_email( email ) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( email );
    }

    function load_view( action ) {
        jQuery.ajax({
            url: admin_url,
            type: 'GET',
            data: {
                'action': action,
            },
        })
        .done(function( response ) {
            jQuery( '.wcss-popup-ajax' ).html( response );
        });
    } 

    // Display popup
    jQuery( document ).on( 'click', '[data-wcss-popup-open]', function(event) {
        event.preventDefault();
        
        jQuery( '.wcss-popup, .wcss-popup-overlay' ).show();

        load_view( 'wcss_share_medium_ajax' );
        

    });

    //  Close popup
    jQuery( document ).on( 'click', '[data-wcss-popup-close]', function(event) {
        event.preventDefault();
        
        jQuery( '.wcss-popup-ajax' ).html( loader );
        jQuery( '.wcss-popup, .wcss-popup-overlay' ).hide();

    });

    jQuery( document ).on( 'click', '[data-wcss-share-saved-cart]', function(event) {
        event.preventDefault();
        
        var cartKey = jQuery( this ).attr( 'data-wcss-share-saved-cart' );

        jQuery( '.wcss-popup' ).show();

        jQuery.ajax({
            url: admin_url,
            type: 'POST',
            data: {
                'action': 'wcss_share_saved_cart_ajax',
                'cart_key': cartKey,
            },
        })
        .done(function( response ) {
            jQuery( '.wcss-popup-ajax' ).html( response );
        });

    });

    // login now
    jQuery( document ).on( 'click', '[data-wcss-save-cart]', function(event) {
        event.preventDefault();
        
        jQuery( '.wcss-share-medium' ).hide();
        jQuery( '.wcss-save-cart-form, .wcss-login-now' ).show();

    });


    // Disable share cart button if quantity updates
    jQuery( document ).on( 'change', '.qty', function(event) {
        
        jQuery( '[data-wcss-popup-open]' ).attr( 'disabled', 'disabled');

    });

    // Copy To Clipboard
    new ClipboardJS( '[data-wcss-copy-link]' );    
    jQuery( document ).on( 'click', '[data-wcss-copy-link]', function(event) {
        event.preventDefault();

        jQuery( '.wcss-popup-ajax' ).html( '<div class="wcss-copied-to-clipboard"><i class="wcss-icon-check"></i></div>' );

    });


    // Print cart 
    jQuery( document ).on('click', '[data-wcss-print-cart]', function(event) {
        event.preventDefault();
        
        var cartKey = jQuery( this ).attr( 'data-wcss-print-cart' );

        jQuery( '.wcss-popup-ajax' ).html( loader );
        jQuery( '#wcss-print-cart' ).remove();

        jQuery.ajax({
            url: admin_url,
            type: 'POST',
            data: {
                'action': 'wcss_print_cart_ajax',
                'print_cart_key': cartKey,
            },
            success: function( response ) {

                jQuery('body').append( '<div id="wcss-print-cart">' + response + '</div>' );

                jQuery( '.wcss-print-cart-wrapper' ).printThis( {
                    importCSS: true,
                    pageTitle: "Cart",
                    printDelay: 1000,
                } );

                setTimeout( function() {
                    jQuery( '[data-wcss-popup-close]' ).click();
                }, 1000 );

            }
        });
        

    });


    // Email cart view form
    jQuery( document ).on( 'click', '[data-wcss-email]', function( e ) {
        e.preventDefault();

        jQuery( '.wcss-share-medium' ).hide();
        jQuery( '.wcss-email-cart' ).show();

    } );

    // Email cart send ajax call
    jQuery( document ).on( 'submit', '#wcss-email-cart-form', function( e )  {
        e.preventDefault();
        var error = false;

        jQuery( '.wcss-email-cart-form-field' ).each(function() {
            var field = jQuery( this ).attr( 'required' );

            // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
            if (typeof field !== typeof undefined && field !== false) {
                if ( '' == jQuery( this ).val()  ) {
                    shaker( jQuery( this ) ); 
                    error = true;
                    return false;
                }
            }

        });
        // if any error.
        if ( error === true ) {
            return;
        }
        // display loader
        jQuery( '.wcss-popup-ajax' ).html( loader );

        jQuery.ajax({
            url: admin_url,
            type: 'POST',
            dataType: 'json',
            data: jQuery( this ).serialize() + '&action=wcss_send_email_cart',
            success: function( response ) {
                if ( response.status == true ) {
                    jQuery( '.wcss-popup-ajax' ).html( '<div class="wcss-copied-to-clipboard"><i class="wcss-icon-check"></i></div>' );
                }
            }
        });


    } );

})(jQuery);