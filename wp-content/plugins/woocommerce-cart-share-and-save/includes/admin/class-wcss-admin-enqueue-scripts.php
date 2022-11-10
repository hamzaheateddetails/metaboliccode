<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Admin_Enqueue_Scripts {

    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 200 );
    }

    /**
     * Load scripts and styles on only plugin screens.
     *
     * @param string $hook
     */
    public function enqueue_scripts( $hook ) {
        if ( $this->is_admin_screen( $hook ) !== true ) {
            return;
        }
        
        // Select2
        wp_enqueue_style( 'wcss-select2', WCSS_PLUGIN_URL . 'assets/libraries/select2/select2.min.css', array(), '4.0.10' );
        wp_enqueue_script( 'wcss-select2', WCSS_PLUGIN_URL . 'assets/libraries/select2/select2.min.js', array(), '4.0.10', true );
        
        // Plugin icons
        wp_enqueue_style( 'wcss-icons', WCSS_PLUGIN_URL . '/assets/css/wcss-icons.css', array(), WCSS_PLUGIN_VER );

        // Enqueue printThis script
        wp_enqueue_script( 'wcss-printthis', WCSS_PLUGIN_URL . 'assets/libraries/printThis/printThis.js', array(), '1.15.1', true );

        // Load plugin scripts
        wp_enqueue_style( 'wcss-admin', WCSS_PLUGIN_URL . 'assets/css/wcss-admin.css', array(), WCSS_PLUGIN_VER );
        wp_enqueue_script( 'wcss-admin', WCSS_PLUGIN_URL . 'assets/js/wcss-admin.js', array(), WCSS_PLUGIN_VER, true );
        wp_localize_script( 'wcss-admin', 'wcssAdminObj', array(
            'ajax_url' => admin_url( 'admin-ajax.php?ver=' . rand( 1, 999999 ) ),
        ) );

        // Run load admin view cart ajax if on correct page.
        if ( isset( $_GET['page'] ) && $_GET['page'] === 'woocommerce-cart-share_saved-cart' && isset( $_GET['cart_key'] ) ) {

            $load_admin_view_cart = "jQuery.ajax({
                url: wcssAdminObj.ajax_url,
                type: 'POST',
                data: {
                    'action': 'wcss_load_admin_saved_cart_view',
                    'cart_key': '". esc_html( $_GET['cart_key'] ) ."',
                },
            })
            .done(function( response ) {
                jQuery( '#wcss-cart' ).html( response );
                jQuery( '[name=\"wcss_send_saved_cart[body]\"]' ).val( response );
            });";
            wp_add_inline_script( 'wcss-admin', $load_admin_view_cart );

        }
    }

    /**
     * Check whether current screen is plugin admin screen or not.
     *
     * @param string $hook
     * @return boolean Return true if current screen is plugin admin screen.
     */
    private function is_admin_screen( $hook ) {
        if ( $hook == 'toplevel_page_woocommerce-cart-share'
         ||  $hook == 'woo-cart-share_page_woocommerce-cart-share_saved-cart'
         ||  $hook == 'woo-cart-share_page_woocommerce-cart-share_share-support' ) {
            return true;
        }

        return false;
    }

}

$wcss_admin_enqueue_scripts = new WCSS_Admin_Enqueue_Scripts;