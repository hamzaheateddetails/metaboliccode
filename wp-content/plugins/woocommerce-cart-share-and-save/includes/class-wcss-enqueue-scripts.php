<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * WCSS_Enqueue_Scripts class responsable to load all the scripts and styles.
 */
class WCSS_Enqueue_Scripts {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Load all the required frontend scripts
     * @return void
     * @since 1.3
     */
    public function enqueue_scripts() {
        // If current user has no access to share the cart then do nothing.
        if ( wcss_currnet_role_has_access() !== true ) {
            return;
        }

        // Clipboard JS
        wp_enqueue_script( 'wcss-clipboard', WCSS_PLUGIN_URL . 'assets/libraries/clipboard/clipboard.js', array(), '2.0.4', true );

        // Enqueue printThis script
        wp_enqueue_script( 'wcss-printthis', WCSS_PLUGIN_URL . 'assets/libraries/printThis/printThis.js', array(), '1.15.1', true );
        
        // Plugin icons
        wp_enqueue_style( 'wcss-icons', WCSS_PLUGIN_URL . '/assets/css/wcss-icons.css', array(), WCSS_PLUGIN_VER );

        // Plugin frontend scripts
        wp_enqueue_style( 'wcss-style', WCSS_PLUGIN_URL . 'assets/css/wcss-public.css', array(), WCSS_PLUGIN_VER );
        wp_enqueue_script( 'wcss-script', WCSS_PLUGIN_URL . 'assets/js/wcss-public.js', array(), WCSS_PLUGIN_VER, true );
        wp_localize_script( 'wcss-script', 'wcssObj', array(
            'ajax_url'      => admin_url( 'admin-ajax.php' ),
        ) );

        // Public inline style
        $css = '';

        $css .= '.wcss-popup--bg-color { 
            background-color: ' . esc_html( get_option( 'wcss_popup_background_color' ) ) . ';
        }';
        $css .= '.wcss-popup--text-color { 
            color: ' . esc_html( get_option( 'wcss_popup_text_color' ) ) .';
        }';
        $css .= '.wcss-btn { 
            background-color: ' . esc_html( get_option( 'wcss_button_background_color' ) ) . ' !important; 
            color: ' . esc_html( get_option( 'wcss_button_text_color' ) ) . ' !important;
        }';

        $css .= wp_kses_post( get_option( 'wcss_custom_css' ) );

        wp_add_inline_style( 'wcss-style', $css );

    }


} // end of class WCSS_Enqueue_Scripts

$wcss_enqueue_scripts = new WCSS_Enqueue_Scripts;