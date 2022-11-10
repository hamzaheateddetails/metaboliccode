<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcss_get_shared_cart_data' ) ) {
    /**
     * Get shared cart data.
     *
     * @param string $cart_key
     * @param string $column
     * @return string|array  return string if asked for column and return array if asked for complete row.
     */
    function wcss_get_shared_cart_data( $cart_key, $column = '' ) {
        $shared_cart = new WCSS_Shared_Cart;
        return $shared_cart->get_shared_cart_data( $cart_key, $column );
    }
}

if ( ! function_exists( 'wcss_insert_shared_cart' ) ) {
    /**
     * Insert data into shared cart table.
     *
     * @param string $cart_key
     * @param array $cart_value
     * @param string $cart_retrieved
     * @param string $cart_created
     * @return bool  true if inserted anf false if failed.
     */
    function wcss_insert_shared_cart( $cart_key, $cart_value = array(), $cart_retrieved = '', $cart_created = '' ) {
        $shared_cart = new WCSS_Shared_Cart;
        return $shared_cart->insert( $cart_key, $cart_value, $cart_retrieved, $cart_created );
    }
}

if ( ! function_exists( 'wcss_cart_retrieved_increment' ) ) {
    /**
     * Increment the retrieved cart value by one.
     *
     * @param string $cart_key
     * @return bool
     */
    function wcss_cart_retrieved_increment( $cart_key ) {
        $shared_cart    = new WCSS_Shared_Cart;
        $cart_retrieved = $shared_cart->get_shared_cart_data( $cart_key, 'cart_retrieved' );

        return $shared_cart->update( $cart_key, array(
            'cart_retrieved' => ( intval( $cart_retrieved ) + 1 ),
        ) );
    }
}

if ( ! function_exists( 'wcss_set_cart_retrieved_time' ) ) {
    /**
     * Set care retrieved time.
     *
     * @param string $cart_key
     * @return bool
     */
    function wcss_set_cart_retrieved_time( $cart_key ) {
        $shared_cart    = new WCSS_Shared_Cart;

        return $shared_cart->update( $cart_key, array(
            'cart_retrieved_time' => wcss_current_time(),
        ) );
    }
}

if ( ! function_exists( 'wcss_get_cart_retrieved_time' ) ) {
    /**
     * Get care retrieved time.
     *
     * @param string $cart_key
     * @return bool
     */
    function wcss_get_cart_retrieved_time( $cart_key ) {
        $shared_cart    = new WCSS_Shared_Cart;

        return $shared_cart->get_cart_retrieved_time( $cart_key );
    }
}

if ( ! function_exists( 'wcss_get_cart_retrieved' ) ) {
    /**
     * Get the number of retrieved cart.
     *
     * @param string $cart_key
     * @return int
     */
    function wcss_get_cart_retrieved( $cart_key ) {
        $shared_cart    = new WCSS_Shared_Cart;
        return $shared_cart->get_cart_retrieved( $cart_key );
    }
}

if ( ! function_exists( 'wcss_get_shared_cart_session' ) ) {
    /**
     * Get shared cart session. 
     *
     * @param string $cart_key
     * @return array
     */
    function wcss_get_shared_cart_session( $cart_key ) {
        $shared_cart    = new WCSS_Shared_Cart;
        return $shared_cart->get_shared_cart_data( $cart_key, 'cart_value' );
    } 
}
