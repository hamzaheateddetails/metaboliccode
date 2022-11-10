<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * This class is responsiable for the plugin backward compatibility.
 * Plugin changed the cart retrieve method in version 1.5
 * 
 * Before version 1.5: plugin used WC_Cart::add_to_cart() method.
 * 
 * @since 1.5
 */
class WCSS_Backward_Compatibility {

    public function __construct() {

        add_action( 'wcss_before_add_products_to_cart', array( $this, 'products_add_to_cart' ), 30 );

    }

    public function products_add_to_cart() {

        /**
         * No need to run lagecy add to cart method if current version is 1.7 or later.
         * Option "wcz_wcs_settings" was obsolete in version 1.7
         * 
         * @see WCSS_Migration::migration_options_1_6_to_1_7();
         * 
         */
        if ( ! get_option( 'wcz_wcs_settings' ) ) {
            return;
        }

        global $wpdb;

        // get cart key from query variable ( $_GET['wcs_cart_share'] )
        $cart_key = get_query_var( 'wcss_share_cart' );

        // Select shared cart data from database
        /* cart session contains products and coupons array
        * [cart_products] = array( ['product_id'], ['quantity'], ['variation_id'], ['variation'] )
        * [cart_coupon] = array( ['coupon 1'], ['coupon 2'], ... )
        */
        $shared_cart = maybe_unserialize( 
            $wpdb->get_var( 
                $wpdb->prepare( 
                    "SELECT cart_value
                    FROM {$wpdb->prefix}wcss_shared_cart
                    WHERE cart_key = %s",
                    $cart_key )
                ), 0, 0 
            );

        if ( isset( $shared_cart['cart_products'] ) ) {

            // Empty user's current cart
            WC()->cart->empty_cart( TRUE );

            // Get cart_cart_retrieved current value
            $cart_cart_retrieved = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT cart_retrieved
                    FROM {$wpdb->prefix}wcss_shared_cart 
                    WHERE cart_key = %s",
                    $cart_key
                ), 0, 0
            );

            // Update cart_cart_retrieved
            $wpdb->update( 
                $wpdb->prefix.'wcss_shared_cart', 
                array( 'cart_retrieved' => ( $cart_cart_retrieved + 1 ) ), 
                array( 'cart_key' => $cart_key ),
                array( '%d' ),
                array( '%s')
            );

            // Reset the products array keys
            $cart_products = array_values( $shared_cart['cart_products'] );

            // loop through each array key and add product into cart
            foreach ( $cart_products as $cs ) {

                // Add product into cart from share database
                WC()->cart->add_to_cart( $cs['product_id'], $cs['quantity'], $cs['variation_id'], $cs['variation'], $cs['cart_item_data'] );
            }

            // Reset the products array keys
            $cart_coupons = array_values( $shared_cart['cart_coupon'] );

            // loop through each array key and add coupon into cart
            foreach ( $cart_coupons as $coupon ) {

                WC()->cart->add_discount( sanitize_text_field( $coupon ) );
            }

            do_action( 'wcss_after_add_products_to_cart' );

            // redirect user on cart page when all products and coupons added into cart
            wp_redirect( apply_filters( 'wcss_after_add_to_cart_redirection_url', wc_get_cart_url() ) );

            exit;

        }

    }

} // End of the class WCSS_Backward_Compatibility

$wcss_backward_compatibility = new WCSS_Backward_Compatibility;