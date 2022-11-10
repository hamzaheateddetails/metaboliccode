<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

final class WCSS_Init {

    public function init() {

        // Before init action.
        do_action( 'wcss_before_init' );

        // Set up localisation.
        $this->load_plugin_textdomain();
        $this->init_hooks();

        // After init action.
        do_action( 'wcss_after_init' );

    }

    public function init_hooks() {
        // Plugin page setting link on "Install plugin page"
        add_filter( 'plugin_action_links_'.plugin_basename( WCSS_PLUGIN_FILE ), array( $this, 'plugin_page_settings_link' ) );

        // Load files after the WooCommerce init
        add_action( 'woocommerce_init', array( $this, 'includes' ), 20 );
        add_action( 'init', array( $this, 'upgrader_process_complete' ), 10, 2 );
    }

    /**
     * Includes plugin files.
     */
    public function includes() {
        // Deprecated
        require_once WCSS_PLUGIN_PATH . 'includes/deprecated/class-wcss-backward-compatibility.php';

        require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-shared-cart.php';
        require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-saved-cart.php';
        
        if ( is_admin() ) {
            // Includes admin functions

            // Includes admin class
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-settings-api.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-plugin-update.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-plugin-activation.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-actions.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-enqueue-scripts.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-init.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-saved-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-notifications.php';
        }

        if ( '' != get_option( 'wcss_activation_key' ) ) {
            // Include files
            require_once WCSS_PLUGIN_PATH . 'includes/wcss-functions.php';
            require_once WCSS_PLUGIN_PATH . 'includes/wcss-share-cart-functions.php';
            require_once WCSS_PLUGIN_PATH . 'includes/wcss-saved-cart-functions.php';
            require_once WCSS_PLUGIN_PATH . 'includes/wcss-shared-cart-functions.php';
            require_once WCSS_PLUGIN_PATH . 'includes/wcss-email-cart-functions.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-enqueue-scripts.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-share-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-save-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-shared-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-saved-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-popup.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-print-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-email-cart.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-my-account.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-shortcodes.php';
            require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-add-to-cart.php';
        }

        // Debug class
        require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-debug.php';
    }
    
    /**
	 * Load Localisation files.
	 */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'woo-cart-share', false, plugin_basename( dirname( WCSS_PLUGIN_FILE ) ) . '/languages' ); 
    }

    /**
     * Adding a Settings link to plugin 
     * @since 1.3
     */
    public function plugin_page_settings_link( $links ) {
        $links[] = '<a href="' .
            admin_url( 'admin.php?page=woocommerce-cart-share' ) .
            '">' . esc_html__( 'Settings' ) . '</a>';
        return $links;
    }

    /**
     * This function runs when plugin update.
     * @since 1.7.6
     */
    public function upgrader_process_complete() {
        if ( get_option( 'wcss_version' ) < WCSS_PLUGIN_VER ) {
            wcss_plugin_install();
            // update current version.
            update_option( 'wcss_version', WCSS_PLUGIN_VER );
        }
    }

}