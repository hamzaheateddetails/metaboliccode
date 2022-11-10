<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


class WCSS_Popup {

    public function __construct() {
        // If current user has no access to share the cart then do nothing.        
        if ( wcss_currnet_role_has_access() !== true ) {
            return;
        }
        // Add share cart button on cart page
        if ( 'before_checkout_btn' === get_option( 'wcss_trigger_button_location' ) ) {
            add_action( 'woocommerce_proceed_to_checkout', array( $this, 'display_share_button' ) );
        } else if ( 'after_checkout_btn' === get_option( 'wcss_trigger_button_location' ) ) {
            add_action( 'woocommerce_after_cart_totals', array( $this, 'display_share_button' ) );
        } else if ( 'with_apply_coupon' === get_option( 'wcss_trigger_button_location' ) ) {
            add_action( 'woocommerce_cart_coupon', array( $this, 'display_share_button' ) );
        }

        add_action( 'wp_footer', array( $this, 'display_popup' ) );
    }

    /**
     * Output popup.
     */
    public function display_popup() {
        require_once WCSS_PLUGIN_PATH . 'templates/popup.php';
    }

    /**
     * Output cart share button.
     */
    public function display_share_button() {
        $share_cart_button_html = "<button class='button wcss-btn' data-wcss-popup-open>" . esc_html( get_option( 'wcss_share_cart_button_text' ) ) . "</button>";
        echo apply_filters( 'wcss_display_share_button', $share_cart_button_html );    
    }
    
} // end of WCSS_Popup

$wcss_popup = new WCSS_Popup;