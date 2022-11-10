<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcss_insert_saved_cart' ) ) {
    /**
     * Inset into the saved cart table.
     *
     * @param int $user_id
     * @param string $cart_name
     * @param string $cart_key
     * @param string $cart_saved
     */
    function wcss_insert_saved_cart( $user_id, $cart_name, $cart_key, $cart_saved = '' ) {
        $saved_cart = new WCSS_Saved_Cart;
        return $saved_cart->insert( $user_id, $cart_name, $cart_key, $cart_saved );
    }
}

if ( ! function_exists( 'wcss_get_saved_cart_by_user_id' ) ) {
    /**
     * Get saved cart by user ID.
     *
     * @param int $user_id
     * @return array list of cart.
     */
    function wcss_get_saved_cart_by_user_id( $user_id ) {
        $saved_cart = new WCSS_Saved_Cart;
        return $saved_cart->get_saved_cart_by_user_id( $user_id );
    }
}