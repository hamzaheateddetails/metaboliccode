<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Admin no WooCommerce class
 */
class WCSS_Admin_No_WooCommerce {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );

    }

    /**
     * Add admin menu.
     */
    public function admin_menu() {

        add_menu_page( 
            esc_html__( 'Woo Cart Share', 'woo-cart-share' ), 
            esc_html__( 'Woo Cart Share', 'woo-cart-share' ), 
            'manage_options', 
            'wcss-woo-cart-share', 
            array( $this, 'admin_no_woocommerce_page' ), 
            'dashicons-cart'
        );
    }

    /**
     * Admin no WooCommerce main page.
     */
    public function admin_no_woocommerce_page() {
        require_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-no-woocommerce.php';
    }

}

$wcss_admin_no_woocommerce = new WCSS_Admin_No_WooCommerce;