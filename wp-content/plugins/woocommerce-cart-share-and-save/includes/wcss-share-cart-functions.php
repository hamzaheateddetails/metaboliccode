<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcss_is_cart_empty' ) ) {
    /**
     * Check for woocommerce cart status.
     *
     * @return bool
     */
    function wcss_is_cart_empty() {
        return WC()->cart->get_cart_contents_count() === 0 ? true : false;
    }
}