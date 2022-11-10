<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Shortcodes {

    public function __construct() {
        add_shortcode( 'wcss-share-cart-btn', array( $this, 'share_button_shortcode' ) );
    }

    public function share_button_shortcode( $atts ) {
        // If current user has no access to share the cart then shortcode display nothing.
        if ( wcss_currnet_role_has_access() !== true ) {
            return;
        }

        $a = shortcode_atts( array(
            'text'      => esc_html( get_option( 'wcss_share_cart_button_text' ) ),
            'bgColor'   => esc_html( get_option( 'wcss_button_background_color' ) ),
            'textColor' => esc_html( get_option( 'wcss_button_text_color' ) ),
        ), $atts );

        return "<a href='javascript:;' class='wcss-share-cart-btn-shortcode' style='background-color: {$a['bgColor']}; color: {$a['textColor']};' data-wcss-popup-open>{$a['text']}</a>";
    }


} // end of WCSS_Shortcodes

$wcss_shortcodes = new WCSS_Shortcodes;