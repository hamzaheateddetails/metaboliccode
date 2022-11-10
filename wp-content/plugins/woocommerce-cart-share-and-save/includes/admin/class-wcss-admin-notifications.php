<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * This class is responsiable to display all the admin notifications.
 * @since 1.5
 * @author Sonu Kaushal
 */
class WCSS_Admin_Notifications {

    public function __construct() {
        add_action( 'wcss_admin_notifications', array( $this, 'fix_404_redirection_issue' ), 40 );
    }

    public function fix_404_redirection_issue() {
        if ( isset( $_GET['wcss_flush_rewrite_rules_notification_hide'] ) ) {
            update_option( 'wcss_flush_rewrite_rules_notification', '1' );
        }
        if ( get_option( 'wcss_flush_rewrite_rules_notification' ) != '1' ) {
            require_once WCSS_PLUGIN_PATH . 'includes/admin/views/notifications/html-admin-404-fix-notification.php';
        }
    }

}

$wcss_admin_notifications = new WCSS_Admin_Notifications;