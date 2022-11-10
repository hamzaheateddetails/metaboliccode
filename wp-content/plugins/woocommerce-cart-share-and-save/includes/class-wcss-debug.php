<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Debug {

    public function __construct() {
        add_action( 'template_redirect', array( $this, 'debug' ), 20 );
        add_filter( 'wcss_debug_report', array( $this, 'plugin_custom_report' ), 20, 1 );
    }

    public function debug() {
        if ( ! isset( $_GET['wcss_debug'] ) ) {
            return false;
        }
        if ( 'yes' === get_option( 'wcss_debug_status' ) ) {
            printf( '<pre>%s</pre>', print_r( $this->report(), true ) );
            exit;
        }
    }

    public function report() {
        return apply_filters( 'wcss_debug_report', array(
            'Site Information'            => array(
                'Site URL' => site_url(),
                'Home URL' => home_url(),
            ),
            'Server Information'          => array(
                'PHP Version'            => PHP_VERSION,
                'Web Server Information' => $_SERVER['SERVER_SOFTWARE'],
            ),
            'Current Page Information'  => array(
                'Page ID'   => get_the_ID(),
                'Post Type' => get_post_type(),
            ),
            'WordPress Information'       => array(
                'Version' => get_bloginfo('version'),
            ),
            'WordPress Activated Plugins' => $this->activated_plugins(),
            'WordPress Actions'           => $this->list_of_hooks(),
            'Plugin Admin Options'        => $this->admin_options(),
        ) );
    }

    public function activated_plugins() {
        if ( ! function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $data = array();

        $active_plugins = get_option( 'active_plugins', array() );

        foreach ( get_plugins() as $plugin_path => $plugin ) {
            // If the plugin isn't active, don't show it.
            if ( ! in_array( $plugin_path, $active_plugins ) )
                continue;
            $data[$plugin['Name']] = $plugin['Version'] ;
        }

        return $data;
    }

    public function list_of_hooks() {
        $hooks = array();

        foreach( $GLOBALS['wp_actions'] as $action => $count ) {
            $hooks[$action] = $count;
        }
        
        return $hooks;
    }

    public function admin_options() {
        // Load install class
        require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-install.php';

        return WCSS_Install::admin_options();
    }

    public function plugin_custom_report( $report ) {
        $custom_report = array(
            'Activation Key' => get_option( 'wcss_activation_key' ),
            
        );

        return array_merge( $report, $custom_report );
    }
}

$wcss_debug = new WCSS_Debug;