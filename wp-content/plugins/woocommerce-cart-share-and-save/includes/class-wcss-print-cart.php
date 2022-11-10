<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Print_Cart {

    public function __construct() {
        add_action( "wp_ajax_wcss_print_cart_ajax", array( $this, 'print_cart' ) );
        add_action( "wp_ajax_nopriv_wcss_print_cart_ajax", array( $this, 'print_cart' ) );
    }

    /**
     * Print cart.
     */
    public function print_cart() {
        global $wpdb, $woocommerce;

        $cart_key   = sanitize_text_field( $_POST['print_cart_key'] );

        // Calculate the complete cart, so that all the WooCommerce actions and hooks can run first.
        WC()->cart->calculate_totals();

        echo wcss_get_template_html(
            'templates/print-cart/print-cart.php',
            array(
                'message'           => wp_kses_post( get_option( 'wcss_email_description' ) ), 
                'cart_key'          => $cart_key,
            )
        );

        wp_die();
    }

}

$wcss_print_cart = new WCSS_Print_Cart;