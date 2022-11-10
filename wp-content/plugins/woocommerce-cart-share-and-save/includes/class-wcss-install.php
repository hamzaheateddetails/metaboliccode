<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Plugin install class
 */
class WCSS_Install {

    /**
     * Plugin install.
     */
    public static function install() {

        do_action( 'wcss_before_install' );

        self::create_tables();
        self::register_options();
        
        do_action( 'wcss_after_install' );
        
        // Add custom rewrite rules.
        self::add_rewrite_rule();

        // Flush WP rewrite rules.
        flush_rewrite_rules();

        // update current version.
        update_option( 'wcss_version', WCSS_PLUGIN_VER );
    }

    /**
     * Add plugin default setting while plugin activation.
     */
    public static function register_options() {
        foreach( self::default_options() as $name => $value ) {
            add_option( $name, $value );
        }
    }

    /**
     * Get the all default plugin options.
     *
     * @return array
     */
    public static function default_options() {
        return array(
            'wcss_popup_background_color'                   => '#ffffff',
            'wcss_popup_text_color'                         => '#21234a',
            'wcss_button_background_color'                  => '#fc6c6c',
            'wcss_button_text_color'                        => '#ffffff',
            'wcss_popup_overlay_status'                     => 'yes',
            'wcss_share_cart_button_text'                   => 'Share cart',
            'wcss_share_cart_title'                         => 'SHARE YOUR CART',
            'wcss_save_cart_button_text'                    => 'Save Cart',
            'wcss_login_now_button_text'                    => 'Login Now',
            'wcss_save_cart_input_placeholder'              => 'Enter your cart name',
            'wcss_save_cart_message'                        => 'You can restore saved cart and share directly anytime from your my-account page',
            'wcss_save_cart_not_logged_in_message'          => 'You need to login before save the cart.',
            'wcss_empty_cart_message'                       => '<p>Your cart is empty, create a new one.</p><p><a href="'. get_permalink( wc_get_page_id( 'shop' ) ) .'">Shop Now</a></p>',
            'wcss_cart_retrieved_message'                   => 'Cart retrieved successfully',
            'wcss_cart_not_found_message'                   => 'The cart you\'re looking for no longer exists.',
            'wcss_share_cart_email_to_label'                => 'Email To',
            'wcss_share_cart_email_subject_label'           => 'Subject',
            'wcss_share_cart_email_message_label'           => 'Message',
            'wcss_share_cart_email_button_text'             => 'Send Cart',
            'wcss_trigger_button_location'                  => 'with_apply_coupon',
            'wcss_rtl_status'                               => 'no',
            'wcss_user_can_save_cart'                       => 'yes',
            'wcss_user_can_print_cart'                      => 'yes',
            'wcss_share_media'                              => array(
                'whatsapp'   => 'yes',
                'email'      => 'yes',
                'copy_link'  => 'yes',
                'facebook'   => 'yes',
                'twitter'    => 'yes',
                'skype'      => 'yes',
                'messenger'  => 'yes',
            ),
            'wcss_display_by_role_status'                   => 'no',
            'wcss_display_by_role'                          => array(),
            'wcss_retrieved_cart_redirection_page_id'       => get_option( 'woocommerce_cart_page_id' ),
            'wcss_social_share_message'                     => 'Hey, Check Out This {link}',
            'wcss_custom_css'                               => '',
            'wcss_automatically_delete_cart_options'        => array(
                'shared_cart_after_retrieved'           => 'no',
                'shared_and_saved_cart_after_retrieved' => 'no',
            ),
            'wcss_my_account_tab_name'                      => 'Saved Cart',
            'wcss_my_account_tab_slug'                      => 'saved-cart',
            'wcss_my_account_empty_saved_cart_button_text'  => 'Go shop',
            'wcss_my_account_empty_saved_cart_message'      => 'No saved cart yet.',
            'wcss_my_account_restore_button_lable'          => 'Restore',
            'wcss_my_account_share_button_lable'            => 'Share',
            'wcss_my_account_delete_button_lable'           => 'Delete',
            'wcss_email_brand_logo_url'                     => WCSS_PLUGIN_URL . 'assets/images/email/email-logo.png',
            'wcss_email_brand_name'                         => get_bloginfo( 'name' ),
            'wcss_email_header_background_color'            => '#333333',
            'wcss_email_header_text_color'                  => '#ffffff',
            'wcss_email_button_background_color'            => '#96588a',
            'wcss_email_button_text_color'                  => '#ffffff',
            'wcss_email_body_background_color'              => '#ffffff',
            'wcss_email_retrieve_cart_button_text'          => 'RETRIEVE CART',
            'wcss_email_description'                        => '<p style="text-align: center;">Have a look at the shopping cart 😉</p>',
            'wcss_email_contact_media'                      => array(
                'facebook'  => '#',
                'instagram' => '#',
                'twitter'   => '#',
                'whatsapp'  => '911234567889',
            ),
            'wcss_email_from_name'                          => get_bloginfo( 'name' ),
            'wcss_email_from_email'                         => get_bloginfo( 'admin_email' ),
            'wcss_debug_status'                             => 'no',
            'wcss_base_slug'                                => 'cart-share',
            'wcss_delete_all'                               => 'no',
        );
    }

    public static function create_tables() {
        // Add Table
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        // Add 'cart share' table
        $tbl_shared_cart = $wpdb->prefix . 'wcss_shared_cart';

        if ( $wpdb->get_var( "SHOW TABLES LIKE '$tbl_shared_cart'" ) != $tbl_shared_cart ) {

            //table not in database. Create new table
            $tbl_shared_cart_sql = "CREATE TABLE $tbl_shared_cart 
                (   id BIGINT NOT NULL AUTO_INCREMENT , 
                    cart_key VARCHAR(32) NOT NULL , 
                    cart_value LONGTEXT NOT NULL , 
                    cart_retrieved BIGINT NOT NULL , 
                    cart_created VARCHAR(32) NOT NULL , 
                    PRIMARY KEY (id)
                ) $charset_collate";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            dbDelta( $tbl_shared_cart_sql );
        }

        // Add `cart_retrieved_time` column in the `wcss_shared_cart` table.
        // @since 1.7.5
        if ( $wpdb->get_var( "SHOW COLUMNS FROM $tbl_shared_cart LIKE 'cart_retrieved_time'" ) != 'cart_retrieved_time' ) {
            $wpdb->query( "ALTER TABLE $tbl_shared_cart ADD cart_retrieved_time VARCHAR(32) NOT NULL AFTER cart_retrieved" );
        }

        // Add 'cart save' table
        $tbl_saved_cart = $wpdb->prefix . 'wcss_saved_cart';

        if ($wpdb->get_var( "SHOW TABLES LIKE '$tbl_saved_cart'" ) != $tbl_saved_cart ) {

            //table not in database. Create new table
            $tbl_saved_cart_sql = "CREATE TABLE $tbl_saved_cart
                ( 
                    id BIGINT NOT NULL AUTO_INCREMENT , 
                    user_id BIGINT NOT NULL , 
                    cart_name VARCHAR(64) NOT NULL , 
                    cart_key VARCHAR(32) NOT NULL , 
                    cart_saved VARCHAR(32) NOT NULL ,
                    PRIMARY KEY (id)
                ) $charset_collate";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            dbDelta( $tbl_saved_cart_sql );
        }
    }

    /**
     * Get plugin options saved by the admin.
     *
     * @return array
     */
    public static function admin_options() {
        $settings = array();

        foreach( self::default_options() as $name => $value ) {
            if ( ! get_option( $name ) ) {
                continue;
            }

            $settings[$name] = get_option( $name );
        }

        return $settings;
    }

    /**
     * Add plugin rewrite rule while plugin installing.
     */
    public static function add_rewrite_rule() {
        // Get base slug
        $base_slug          = get_option( 'wcss_base_slug' );
        $my_account_slug    = get_option( 'wcss_my_account_tab_slug' );

        // Add rewrite rule for plugin
        add_rewrite_rule('^(' . $base_slug . ')/([^/]*)/?', 'index.php?wcss_share_cart=$matches[2]', 'top');
        add_rewrite_endpoint( $my_account_slug, EP_ROOT | EP_PAGES );
    }

    /**
     * array_merge_recursive does indeed merge arrays, but it converts values with duplicate
     * keys to arrays rather than overwriting the value in the first array with the duplicate
     * value in the second array, as array_merge does. I.e., with array_merge_recursive,
     * this happens (documented behavior):
     *
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    protected static function array_merge_recursive_distinct( $array1 = array(), $array2 = array() ) {
        $merged = $array1;
        foreach ( $array2 as $key => &$value ) {
            if ( is_array( $value ) && isset( $merged[$key] ) && is_array( $merged[$key] ) ) {
                $merged[$key] = self::array_merge_recursive_distinct( $merged[$key], $value );
            } else {
                $merged[$key] = $value;
            }
        }
        return $merged;
    }
    
}