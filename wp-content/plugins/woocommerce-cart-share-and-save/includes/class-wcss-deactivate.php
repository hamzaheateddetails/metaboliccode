<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
* Plugin deactivation class
* This class is use when plugin deactivation

* @author WeCreativez
* @since 1.0
*/
class WCSS_Deactivate {

    /**
    * Plugin deactivation method
    * @since 1.0
    */
    public static function deactivate() {

        // Flush WP rewrite rules
        flush_rewrite_rules();
        
        // Re-view the 404 fix notification.
        update_option( 'wcss_flush_rewrite_rules_notification', '0' );
    }

}