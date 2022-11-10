<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Share_Cart {

    public function __construct() {
        add_action( "wp_ajax_wcss_share_medium_ajax", array( $this, 'share_medium_ajax' ) );
        add_action( "wp_ajax_nopriv_wcss_share_medium_ajax", array( $this, 'share_medium_ajax' ) );
        add_action( 'wcss_before_share_medium_ajax', array( $this, 'empty_share_cart_view' ) );
    }

    /**
    * Get the uniqid 5 characters everytime.
    * @return String
    * @since 1.0
    */
    public function get_uniqid() {

        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $base    = strlen($charset);
        $result  = '';

        $now = explode(' ', microtime())[1];

        while ($now >= $base) {
            $i      = $now % $base;
            $result = $charset[$i] . $result;
            $now /= $base;
        }

        return substr($result, -5);

    }

    /**
    * Get current user cart session
    * @return array     Return array of the current user cart session.
    * @since 1.0
    */
    public function get_cart_session() {

        $cart_session = array();

        $cart_session['cart']               = WC()->session->cart;
        $cart_session['cart_totals']        = WC()->session->cart_totals;
        $cart_session['applied_coupons']    = WC()->session->applied_coupons;

        return apply_filters( 'wcss_get_cart_session', $cart_session, WC() );
    }

    public function share_medium_ajax() {
        
        global $wpdb;

        $cart_session = $this->get_cart_session();
        
        // 1st Generate UID
        $uid = apply_filters( 'wcss_unique_cart_key', $this->get_uniqid() );

        do_action( 'wcss_before_share_medium_ajax', $uid, $cart_session );

        // 2nd Save UID and Cart into the database
        wcss_insert_shared_cart( $uid, $cart_session );

        $social_share_msg = esc_html( get_option( 'wcss_social_share_message' ) );
        $cart_share_link  = wcss_get_cart_link( $uid );

        // Replace {link} with actual link.
        $complied_msg     = str_replace( '{link}', $cart_share_link, $social_share_msg );

        if ( wp_is_mobile() ) {
            $whatsapp_link    = "https://api.whatsapp.com/send?text={$complied_msg}";
        } else {
            $whatsapp_link    = "https://web.whatsapp.com/send?text={$complied_msg}";
        }

        $email_link       = "mailto:?body={$complied_msg}";
        $facebook_link    = "https://www.facebook.com/sharer.php?u=". urlencode( $cart_share_link ) ."";
        $twitter_link     = "http://twitter.com/share?text={$social_share_msg}&url={$cart_share_link}";
        $google_plus_link = "https://plus.google.com/share?url={$complied_msg}";
        $skype_link       = "https://web.skype.com/share?url={$complied_msg}";
        $messenger_link   = "fb-messenger://share/?link={$complied_msg}";
        $print_cart_key   = $uid;

        $login_page_url   = get_permalink( get_option('woocommerce_myaccount_page_id') );
        
        require_once WCSS_PLUGIN_PATH . 'templates/share-medium.php';

        do_action( 'wcss_after_share_medium_ajax', $uid, $cart_session );

        wp_die();
    }

    public function empty_share_cart_view() {
        // If cart is empty.
        if ( wcss_is_cart_empty() !== true ) {
            return;
        }
        require_once WCSS_PLUGIN_PATH . 'templates/empty-cart-message.php';
        
        wp_die();
    }

} // end of WCSS_Share_Cart

$wcss_share_cart = new WCSS_Share_Cart;