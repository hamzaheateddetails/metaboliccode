<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Admin_Plugin_Update {
    
    public function __construct() {
        add_action( 'init', array( $this, 'check_update' ) );
    }

    /**
     * Check for the new verison.
     */
    public function check_update() {

        $purchase_code = get_option( 'wcss_activation_key' );

        // If purchase code not set.
        if ( ! $purchase_code ) {
            return;
        }
        // Make sure the code is valid before sending it to server
        if ( ! preg_match( "/^(\w{8})-((\w{4})-){3}(\w{12})$/", $purchase_code ) ) {
            delete_option( 'wcss_activation_key' );
            return;
        }

        require WCSS_PLUGIN_PATH . 'includes/libraries/plugin-update-checker/plugin-update-checker.php';

        // Activation URL
        $update_url = add_query_arg( array(
            'cp_plugin_update'    => trim( $purchase_code ),
            'uniqid'              => uniqid(),
        ), 'http://envato.wecreativez.com/codecanyon/' );

        // Check for update.
        $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
            $update_url,
            WCSS_PLUGIN_FILE,
            'woocommerce-cart-share',
            24
        );
    }

}

$wcss_admin_plugin_update = new WCSS_Admin_Plugin_Update;