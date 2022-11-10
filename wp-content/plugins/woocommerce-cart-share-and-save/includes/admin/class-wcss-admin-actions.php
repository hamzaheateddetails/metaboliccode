<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Admin actions class
 */
class WCSS_Admin_Actions {

    public function __construct() {
        add_action( 'admin_init', array( $this, 'reset_settings' ), 5 );
        add_action( 'admin_init', array( $this, 'delete_saved_cart' ) );
        add_action( 'admin_init', array( $this, 'delete_all_saved_cart' ) );
        add_action( 'admin_init', array( $this, 'delete_all_cart' ) );
        add_action( 'admin_init', array( $this, 'flush_rewrite_rules' ) );
    }

    /**
     * Reset settings to default.
     */
    public function reset_settings() {
        if ( isset( $_GET['wcss_reset_settings'] ) && wp_verify_nonce( $_GET['_wpnonce'] ) ) {
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-install.php';

            foreach ( WCSS_Install::default_options() as $name => $value ) {
                update_option( $name, $value );
            }

            wp_safe_redirect( wp_get_referer() );
            exit;
        }
    }

    public function delete_saved_cart() {
        if ( isset( $_GET['wcss_delete_cart'] ) && wp_verify_nonce( $_GET['_wpnonce'] ) ) {
            $saved_cart = new WCSS_Saved_Cart;
            $saved_cart->delete_saved_cart( $_GET['wcss_delete_cart'] );

            wp_safe_redirect( admin_url( 'admin.php?page=woocommerce-cart-share_saved-cart&wcss_delete_cart_done=1' ) );
            exit;
        }
    }

    /**
     * Delete all saved cart.
     */
    public function delete_all_saved_cart() {
        if ( isset( $_GET['wcss_delete_all_saved_cart'] ) && wp_verify_nonce( $_GET['_wpnonce'] ) ) {
            $saved_cart = new WCSS_Saved_Cart;
            $saved_cart->truncate();

            wp_safe_redirect( wp_get_referer() );
            exit;
        }
    }

    /**
     * Delete all shared and saved cart.
     */
    public function delete_all_cart() {
        if ( isset( $_GET['wcss_delete_all_cart'] ) && wp_verify_nonce( $_GET['_wpnonce'] ) ) {
            $saved_cart = new WCSS_Saved_Cart;
            $shared_cart = new WCSS_Shared_Cart;
            $saved_cart->truncate();
            $shared_cart->truncate();

            wp_safe_redirect( wp_get_referer() );
            exit;
        }
    }
    
    /**
     * Flush rewrite rules.
     */
    public function flush_rewrite_rules() {
        if ( isset( $_GET['wcss_flush_rewrite_rules'] ) && wp_verify_nonce( $_GET['_wpnonce'] ) ) {
            // Flush WP rewrite rules.
            update_option( 'rewrite_rules', '' ); 
            flush_rewrite_rules();

            // Redirects on plugin main page and 404 fix admin notification.
            wp_redirect( 'admin.php?page=woocommerce-cart-share&wcss_flush_rewrite_rules_notification_hide=1' );
            exit;
        }
    }



}

$wcss_admin_actions = new WCSS_Admin_Actions;