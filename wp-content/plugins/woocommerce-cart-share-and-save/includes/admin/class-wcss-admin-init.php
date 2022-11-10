<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Admin menu class
 */
class WCSS_Admin_Init {

    public function __construct() {
        $this->settings_api = new WCSS_Admin_Settings_API;

        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_init', array( $this, 'init_settings' ), 20 );
    }

    /**
     * Add admin meni
     */
    public function admin_menu() {

        if ( '' != get_option( 'wcss_activation_key' ) ) {
            add_menu_page(
                esc_html__( 'Woo Cart Share', 'woo-cart-share' ),
                esc_html__( 'Woo Cart Share', 'woo-cart-share' ),
                'manage_options',
                'woocommerce-cart-share',
                array( $this, 'admin_setting_page' ),
                'dashicons-cart',
                58
            );
            add_submenu_page(
                'woocommerce-cart-share',
                esc_html__( 'Saved Cart', 'woo-cart-share' ),
                esc_html__( 'Saved Cart', 'woo-cart-share' ),
                'manage_options',
                'woocommerce-cart-share_saved-cart',
                array( $this, 'admin_saved_cart_page' )
            );
            add_submenu_page(
                'woocommerce-cart-share',
                esc_html__( 'Plugin Support', 'woo-cart-share' ),
                esc_html__( 'Plugin Support', 'woo-cart-share' ),
                'manage_options',
                'woocommerce-cart-share_share-support',
                array( $this, 'admin_plugin_support_page' )
            );
            add_submenu_page(
                'woocommerce-cart-share',
                esc_html__( 'Developer Settings', 'woo-cart-share' ),
                null,
                'manage_options',
                'woocommerce-cart-share_developer-settings',
                array( $this, 'admin_developer_settings' )
            );
        } else {
            add_menu_page(
                esc_html__( 'Woo Cart Share', 'woo-cart-share' ),
                esc_html__( 'Woo Cart Share', 'woo-cart-share' ),
                'manage_options',
                'woocommerce-cart-share',
                array( $this, 'admin_plugin_activation_page' ),
                'dashicons-cart'
            );
            add_submenu_page(
                'woocommerce-cart-share',
                esc_html__( 'Plugin Support', 'woo-cart-share' ),
                esc_html__( 'Plugin Support', 'woo-cart-share' ),
                'manage_options',
                'woocommerce-cart-share_share-support',
                array( $this, 'admin_plugin_support_page' )
            );
        }
    }

    /**
     * Admin setting main page
     */
    public function admin_setting_page() {
        echo '<div class="wrap">';
        echo '<h1>' . esc_html__( 'WooCommerce Cart Share & Save', 'woo-cart-share' ) . '</h1>';
        settings_errors();
        echo '<hr>';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }

    /**
     * Admin saved cart list and view page.
     */
    public function admin_saved_cart_page() {

        if ( isset( $_GET['page'] ) && 'woocommerce-cart-share_saved-cart' === $_GET['page'] && isset( $_GET['cart_key'] ) ) {
            require_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-saved-cart-view.php';
        } else {
            require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-saved-cart-table.php';
            require_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-saved-cart-list.php';
        }
    }

    /**
     * Admin plugin support page.
     */
    public function admin_plugin_support_page() {
        require_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-support.php';
    }

    public function admin_developer_settings() {
        echo '<div class="wrap">';
        echo '<h1>' . esc_html__( 'Developer Settings', 'woo-cart-share' ) . '</h1>';
        settings_errors();
        echo '<hr>';
        $this->settings_api->show_form( 'wcss_developer_settings' );
        echo '</div>';
    }

    /**
     * Admin plugin activation page.
     */
    public function admin_plugin_activation_page() {
        require_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-plugin-activation-page.php';
    }

    public function init_settings() {
        $sections = apply_filters( 'wcss_admin_setting_sections',
            array(
                array(
                    'id'    => 'wcss_appearance_settings',
                    'title' => __( 'Appearance', 'woo-cart-share' ),
                ),
                array(
                    'id'    => 'wcss_basic_settings',
                    'title' => __( 'Basic Settings', 'woo-cart-share' ),
                ),
                array(
                    'id'    => 'wcss_advanced_settings',
                    'title' => __( 'Advanced Settings', 'woo-cart-share' ),
                ),
                array(
                    'id'    => 'wcss_my_account_settings',
                    'title' => __( 'My Account', 'woo-cart-share' ),
                ),
                array(
                    'id'    => 'wcss_email_settings',
                    'title' => __( 'Email Settings', 'woo-cart-share' ),
                ),
                array(
                    'id'          => 'wcss_shortcodes',
                    'title'       => __( 'Shortcodes', 'woo-cart-share' ),
                    'custom_page' => WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-shortcodes.php',
                ),
                array(
                    'id'      => 'wcss_developer_settings',
                    'title'   => __( 'Developer Settings', 'woo-cart-share' ),
                    'display' => false,
                ),
            )
        );

        $fields = apply_filters( 'wcss_admin_setting_fields', array(
            'wcss_appearance_settings' => include_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-appearance-settings.php',
            'wcss_basic_settings'      => include_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-basic-settings.php',
            'wcss_advanced_settings'   => include_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-advanced-settings.php',
            'wcss_my_account_settings' => include_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-my-account-settings.php',
            'wcss_email_settings'      => include_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-email-settings.php',
            'wcss_developer_settings'  => include_once WCSS_PLUGIN_PATH . 'includes/admin/views/html-admin-developer-settings.php',
        ) );

        //set sections and fields
        $this->settings_api->set_sections( $sections );
        $this->settings_api->set_fields( $fields );

        //initialize them
        $this->settings_api->admin_init();
    }
}

$wcss_admin_init = new WCSS_Admin_Init;