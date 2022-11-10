<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_My_Account {

    private $slug;

    private $tab_name;

    public function __construct() {
        // If current user has no access to share the cart then do nothing.
        if ( wcss_currnet_role_has_access() !== true ) {
            return;
        }

        $this->slug     = get_option( 'wcss_my_account_tab_slug' );
        $this->tab_name = get_option( 'wcss_my_account_tab_name' );

        add_action( 'init', array( $this, 'add_saved_cart_endpoint' ) );
        add_filter( 'query_vars', array( $this, 'saved_cart_query_vars' ), 0 );
        add_filter( 'woocommerce_account_menu_items', array( $this, 'add_saved_cart_link_my_account' ), 1 );
        add_action( "woocommerce_account_{$this->slug}_endpoint",  array( $this, 'saved_cart_content' ), 1 );

    }


    /**
     * Add Saved cart endpoint
     * @since 1.0
     */
    public function add_saved_cart_endpoint() {
        add_rewrite_endpoint( $this->slug, EP_ROOT | EP_PAGES );
    }


    /**
    * Add query variable 
    * @since 1.0
    */
    public function saved_cart_query_vars( $vars ) {
        $vars[] = $this->slug;
        return $vars;
    }

    /**
     * Add saved cart link into woocommerce my-account section
     * @since 1.0
     */
    public function add_saved_cart_link_my_account( $items ) {
        // Remove the logout menu item.
        $logout = $items['customer-logout'];
        unset( $items['customer-logout'] );

        // Insert your custom endpoint.
        $items[$this->slug] = $this->tab_name;

        // Insert back the logout item.
        $items['customer-logout'] = $logout;

        return $items;

    }

    /**
     * Display saved cart table in 'saved-cart' page
     * @since 1.0
     */
    public function saved_cart_content() {
        $saved_carts = wcss_get_saved_cart_by_user_id( get_current_user_id() );

        if ( $saved_carts ) {
            require_once WCSS_PLUGIN_PATH . 'templates/my-account/saved-cart-table.php';
        } else {
            require_once WCSS_PLUGIN_PATH . 'templates/my-account/empty-cart-message.php';
        }

    }

} // end of WCSS_My_Account

$wcss_my_account = new WCSS_My_Account;