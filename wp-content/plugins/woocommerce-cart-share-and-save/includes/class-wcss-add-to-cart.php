<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Add_To_Cart {

    public function __construct() {
        // Add query variable
        add_filter( 'query_vars', array( $this, 'add_query_var' ) );

        // Add rewrite rules
        add_action( 'init', array( $this, 'add_plugin_rewrite_rule' ) );

        // Add products and coupons into cart
        add_action( 'wp', array( $this, 'add_products_to_cart' ) );
        
        add_action( 'wcss_after_add_products_to_cart', array( $this, 'delete_cart_after_retrieved' ), 30, 1 );
    }

    /**
     * Add query variable
     * @since 1.0
     */
    public function add_query_var( $vars ) {

        $vars[] = 'wcss_share_cart';
        return $vars;
    }

    /**
     * Add rewrite rules when wordpress is on init stage
     * @since 1.0
     */
    public function add_plugin_rewrite_rule() {

        // Get base slug
        $base_slug = get_option( 'wcss_base_slug' );

        // Add rewrite rule for plugin
        add_rewrite_rule('^(' . $base_slug . ')/([^/]*)/?', 'index.php?wcss_share_cart=$matches[2]', 'top');
    }

    /**
     * Add products and coupons into the cart when user click on cart shared link.
     * @since 1.0
     */
    public function add_products_to_cart() {

        global $wpdb;

        // get cart key from query variable ( $_GET['wcs_cart_share'] )
        $cart_key = get_query_var( 'wcss_share_cart' );

        // if query variable ( $_GET['wcs_cart_share'] ) not set then return
        if ( empty( $cart_key ) ) {
            return;
        }

        do_action( 'wcss_before_add_products_to_cart' );

        // Empty user's current cart
        WC()->cart->empty_cart( TRUE );

        // Get shared cart data from database
        $cart_session = wcss_get_shared_cart_data( $cart_key, 'cart_value' );

        if ( ! $cart_session ) {
            wc_add_notice( esc_textarea( get_option( 'wcss_cart_not_found_message' ) ), 'error' );
            wp_redirect( apply_filters( 'wcss_after_add_to_cart_redirection_url', $this->add_to_cart_redirection_url() ) );
			exit;
        }

        // Get cart_cart_retrieved current value
        $cart_cart_retrieved = wcss_get_shared_cart_data( $cart_key, 'cart_retrieved' );

        // Update cart_retrieved
        wcss_cart_retrieved_increment( $cart_key );

        // Update cart_retrieved_time
        wcss_set_cart_retrieved_time( $cart_key );

        // Set the session
        WC()->session->cart             = $cart_session['cart'];
        WC()->session->cart_totals      = $cart_session['cart_totals'];
        WC()->session->applied_coupons  = $cart_session['applied_coupons'];
        
        WC()->cart->get_cart_from_session();
        WC()->cart->calculate_totals();

        // Display cart retrieved message.
        wc_add_notice( esc_textarea( get_option( 'wcss_cart_retrieved_message' ) ), 'success' );

        /**
         * Hook: wcss_after_add_products_to_cart.
         * 
         * @hooked: WCSS_Add_To_Cart::delete_cart_after_retrieved() - 30
         * 
         */
        do_action( 'wcss_after_add_products_to_cart', $cart_key );

        // redirect user on cart page when all products and coupons added into cart
        wp_redirect( apply_filters( 'wcss_after_add_to_cart_redirection_url', $this->add_to_cart_redirection_url() ) );

        exit;
    }

    /**
     * After retrieve cart redirection
     *
     * @return string
     * @since 1.5
     */
    public function add_to_cart_redirection_url() {

        // Get plugin settings.
        $redirection_page_id = get_option( 'wcss_retrieved_cart_redirection_page_id' );

        if ( ! is_numeric( $redirection_page_id ) ) {
            return wc_get_cart_url();
        }
        
        return get_permalink( $redirection_page_id );
    }

    /**
     * Delete the cart after added to cart.
     *
     * @param string $cart_key
     * @since 1.7.2
     * @return void
     */
    public function delete_cart_after_retrieved( $cart_key ) {
        $shared_cart    = new WCSS_Shared_Cart;
        $saved_cart     = new WCSS_Saved_Cart;
        $options        = get_option( 'wcss_automatically_delete_cart_options' );

        // Delete saved and shared cart.
        if ( 'yes' === $options['shared_cart_after_retrieved'] ) {
            $shared_cart->delete_cart( $cart_key );
            $saved_cart->delete_saved_cart( $cart_key );
        }

        // Delete only shared cart.
        if ( 'yes' === $options['shared_and_saved_cart_after_retrieved'] ) {
            // if share cart is saved then no need to delete a cart. 
            if ( ! $saved_cart->is_cart_saved( $cart_key ) ) {
                $shared_cart->delete_cart( $cart_key );
            }
        }
    }

}

$wcss_add_to_cart = new WCSS_Add_To_Cart;