<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Email_Cart {

    public function __construct() {
        add_action( "wp_ajax_wcss_send_email_cart", array( $this, 'email_cart' ) );
        add_action( "wp_ajax_nopriv_wcss_send_email_cart", array( $this, 'email_cart' ) );
    }

    /**
     * Email cart.
     */
    public function email_cart() {
        $response       = array();
        $cart_key       = sanitize_text_field( $_POST['cart_key'] );

        $post = array(
            'email_to'      => sanitize_text_field( $_POST['email_to'] ),
            'email_subject' => sanitize_text_field( $_POST['email_subject'] ),
            'email_message' => wp_kses_post( $_POST['email_message'] ),
        );

        // apply filter to posted data.
        $post = apply_filters( 'wcss_email_cart_form_post_data', $post );

        $email_from_name    = apply_filters( 'wcss_email_from_name', get_option( 'wcss_email_from_name' ) );
        $email_from_email   = apply_filters( 'wcss_email_from_email', get_option( 'wcss_email_from_email' ) );

        // Calculate the complete cart, so that all the WooCommerce actions and hooks can run first.
        WC()->cart->calculate_totals();

        if ( 'yes' === get_option( 'wcss_rtl_status' ) ) {
            $email_cart_template = 'templates/email-cart/email-cart-rtl.php';
        } else {
            $email_cart_template = 'templates/email-cart/email-cart.php';
        }

        $email_body     = wcss_get_template_html(
            $email_cart_template,
            array(
                'cart_key'                  => $cart_key,
                'cart_link'                 => wcss_get_cart_link( $cart_key ),
                'message'                   => isset( $post['email_message'] ) ? $post['email_message'] : '', 
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

        // Email process
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: '. esc_html( $email_from_name ) .' <' . esc_html( $email_from_email ) . '>';

        /**
         * Before email cart send action.
         */
        do_action( 'wcss_before_send_email_cart', $post['email_to'], $post['email_subject'], $email_body, $headers );

        $email_to = explode( ',', $post['email_to'] );

        // Send multiple emails.
        foreach ( $email_to as $email ) {
            $email = trim( $email );

            if ( ! $email ) {
                continue;
            }
            if ( ! is_email( $email ) ) {
                continue;
            }

            wp_mail( $email, $post['email_subject'], $email_body, $headers );

        }

        $response['status'] = true;

        /**
         * After email cart send action.
         */
        do_action( 'wcss_after_send_email_cart', $post['email_to'], $post['email_subject'], $post['email_message'], $headers );

        echo json_encode( $response );

        wp_die();

    }


}

$wcss_email_cart = new WCSS_Email_Cart;