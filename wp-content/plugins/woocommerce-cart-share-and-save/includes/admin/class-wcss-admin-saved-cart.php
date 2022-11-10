<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Admin_Saved_Cart {

    public function __construct() {
        add_action( 'wp_ajax_wcss_load_admin_saved_cart_view', array( $this, 'load_saved_cart' ) );
        add_action( 'wp_ajax_nopriv_wcss_load_admin_saved_cart_view', array( $this, 'load_saved_cart' ) );

        add_action( 'wp_loaded', array( $this, 'send_email' ) );
    }

    /**
     * Load saved cart for admin via ajax/
     */
    public function load_saved_cart() {
        global $wpdb;

        // Get cart key from POST variable
        $cart_key = sanitize_text_field( $_POST['cart_key'] );
        
        // Get shared cart data from database
        $cart_session = wcss_get_shared_cart_session( $cart_key );

        // Set the session
        WC()->session->cart             = $cart_session['cart'];
        WC()->session->cart_totals      = $cart_session['cart_totals'];
        WC()->session->applied_coupons  = $cart_session['applied_coupons'];
        
        WC()->cart->get_cart_from_session();

        // Calculate the complete cart, so that all the WooCommerce actions and hooks can run first.
        WC()->cart->calculate_totals();

        if ( 'yes' === get_option( 'wcss_rtl_status' ) ) {
            $email_cart_template = 'templates/email-cart/email-cart-rtl.php';
        } else {
            $email_cart_template = 'templates/email-cart/email-cart.php';
        }

        wcss_get_template(
            $email_cart_template,
            array(
                'cart_key'                  => $cart_key,
                'cart_link'                 => wcss_get_cart_link( $cart_key ),
                'message'                   => wp_kses_post( get_option( 'wcss_email_description' ) ),
                'body_bg_color'             => get_option( 'wcss_email_body_background_color' ),
                'header_bg_color'           => get_option( 'wcss_email_header_background_color' ),
                'header_text_color'         => get_option( 'wcss_email_header_text_color' ),
                'button_bg_color'           => get_option( 'wcss_email_button_background_color' ),
                'button_text_color'         => get_option( 'wcss_email_button_text_color' ),
                'brand_name'                => get_option( 'wcss_email_brand_name' ),
                'brand_logo_url'            => get_option( 'wcss_email_brand_logo_url' ),
                'retrieve_cart_button_text' => get_option( 'wcss_email_retrieve_cart_button_text' ),
            )
        );

        // Empty current cart
        WC()->cart->empty_cart( TRUE );

        wp_die();
    }

    /**
     * Send saved cart
     */
    public function send_email() {
        if ( ! isset( $_POST['wcss_send_saved_cart_send'] ) ) {
            return;
        }

        // Get email settings
        $post_data      = stripslashes_deep( $_POST['wcss_send_saved_cart'] );

        $email_subject  = sanitize_text_field( $post_data['subject'] );
        $email_to       = sanitize_text_field( $post_data['to'] );
        $email_body     = $post_data['body'];

        $header         = array(
            'from_name'     => get_option( 'wcss_email_from_name' ),
            'from_email'    => get_option( 'wcss_email_from_email' ),
        );

        $emails = explode( ',', $email_to );

        /**
         * Before email cart send action.
         */
        do_action( 'wcss_before_admin_send_email_cart', $email_to, $email_subject, $email_body, $header );

        foreach ( $emails as $email_to ) {
            $this->mail( $email_to, $email_subject, $email_body, $header );
        }

        /**
        * After email cart send action.
        */
        do_action( 'wcss_after_admin_send_email_cart', $email_to, $email_subject, $email_body, $header );

    }

    private function mail( $email_to, $email_subject, $email_body, $headers = array() ) { 

        $headers[] = 'Content-Type: text/html; charset=UTF-8';

        if ( isset( $headers['from_name'] ) && isset( $headers['from_email'] ) ) {
            $headers[] = 'From: '. esc_html( $headers['from_name'] ) .' <'. esc_html( $headers['from_email'] ) .'>';
        }

        return wp_mail( $email_to, $email_subject, $email_body , $headers );

    }
}

$wcss_admin_saved_cart = new WCSS_Admin_Saved_Cart;