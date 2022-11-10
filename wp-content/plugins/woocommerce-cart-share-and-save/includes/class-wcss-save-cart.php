<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Save_Cart {

    public function __construct() {

        add_action( 'init', array( $this, 'save_cart' ) );
        add_action( 'init', array( $this, 'delete_saved_cart' ) );

        add_action( "wp_ajax_wcss_share_saved_cart_ajax", array( $this, 'share_saved_cart' ) );
        add_action( "wp_ajax_nopriv_wcss_share_saved_cart_ajax", array( $this, 'share_saved_cart' ) );

        add_action( 'init', array( $this, 'delete_saved_cart' ) );
    }

    /**
     * Save user cart.
     */
    public function save_cart() {
        global $wpdb;

        if ( ! isset( $_POST['wcss_save_cart_submit'] ) ) {
            return;
        }

        // 1st Get current user id
        $current_user_id = get_current_user_id();

        // 2nd Get cart key from the form
        $cart_key = sanitize_text_field( $_POST['wcss_save_cart']['cart_key'] );

        // 3rd Get cart name from fthe form
        $cart_name = sanitize_text_field( $_POST['wcss_save_cart']['cart_name'] );

        // 4th insert the data into wcss_saved_cart table
        wcss_insert_saved_cart( $current_user_id, $cart_name, $cart_key );

        // Get the endpoint from the database.
        $endpoint = get_option( 'wcss_my_account_tab_slug' );

        // Get the my account page URL
        $myaccount_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );        

        // Redirection URL
        $redirection_url = rtrim( $myaccount_page_url, "/" ) . '/' . $endpoint;

        // Redirect to my-account page
        wp_redirect( apply_filters( 'wcss_save_cart_redirection_url', $redirection_url ) );

        exit;

    }

    /**
     * Delete saved cart by user.
     */
    public function delete_saved_cart() {
        if ( ! isset( $_GET['wcss_delete_saved_cart'] ) ) {
            return;
        }

        // Get cart_save_id and assign to variable
        $cart_key = $_GET['wcss_delete_saved_cart'];

        // Get current user ID
        $current_user_id = get_current_user_id();
        
        $saved_cart = new WCSS_Saved_Cart;
        $saved_cart->user_delete_saved_cart( $cart_key, $current_user_id );
        
        // Redirect on same page.   
        wp_safe_redirect( apply_filters( 'wcss_delete_cart_redirection_url', wp_get_referer() ) );
    }

    /**
     * Share saved cart. 
     */
    public function share_saved_cart() {

        $cart_key = sanitize_text_field( $_POST['cart_key'] );

        $social_share_msg = esc_html( get_option( 'wcss_social_share_message' ) );
        $cart_share_link  = wcss_get_cart_link( $cart_key );

        // Replace {link} with actual link.
        $complied_msg     = str_replace( '{link}', $cart_share_link, $social_share_msg );

        $print_cart_key   = $cart_key;
        $uid              = $cart_key;

        $whatsapp_link    = "https://wa.me/?text={$complied_msg}";
        $email_link       = "mailto:?body={$complied_msg}";
        $facebook_link    = "https://www.facebook.com/sharer.php?u=". urlencode( $cart_share_link ) ."";
        $twitter_link     = "https://twitter.com/intent/tweet?url={$complied_msg}";
        $google_plus_link = "https://plus.google.com/share?url={$complied_msg}";
        $skype_link       = "https://web.skype.com/share?url={$complied_msg}";
        $messenger_link   = "fb-messenger://share/?link={$complied_msg}";

        require_once WCSS_PLUGIN_PATH . 'templates/share-medium.php';

        wp_die();
    }


} // end of WCSS_Save_Cart

$wcss_save_cart = new WCSS_Save_Cart;