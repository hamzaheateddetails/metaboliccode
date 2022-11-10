<?php
/**
 * Runs on Uninstall.
 */

// Check that we should be doing this
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit; // Exit if accessed directly
}

// Delete all plugin settings, tables, etc.
if ( 'yes' === get_option( 'wcss_delete_all' ) ) :
    global $wpdb;

    // Load install class
    require_once 'includes/class-wcss-install.php';
    
    // Delete plugin options
    foreach ( WCSS_Install::default_options() as $name => $value ) {
        if ( get_option( $name ) ) {
            delete_option( $name );
        }
    }
    delete_option( 'wcss_flush_rewrite_rules_notification' );
    
    // Delete tables.
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wcss_shared_cart" );
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wcss_saved_cart" );

endif;