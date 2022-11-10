<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Saved_Cart {

    /**
     * Shaved cart table name
     */
    private $table_name;

    public function __construct() {
        global $wpdb;

        $this->table_name = $wpdb->prefix.'wcss_saved_cart';
    }


    public function insert( $user_id, $cart_name, $cart_key, $cart_saved = '' ) {
        global $wpdb;

        if ( ! $cart_saved ) {
            $cart_saved = wcss_current_time();
        }

        return $wpdb->insert( 
            $this->table_name, 
            array( 
                'user_id'       => $user_id,
                'cart_name'     => $cart_name,
                'cart_key'      => $cart_key,
                'cart_saved'    => $cart_saved,
            ),
            array(
                '%d', '%s', '%s', '%s' 
            )
        );
    }

    /**
     * Delete all the rows and data and make table empty.
     *
     * @return bool
     */
    public function truncate() {
        global $wpdb;
        return $wpdb->query( "TRUNCATE TABLE {$this->table_name}");
    }    

    /**
     * Delete saved cart by cart key.
     *
     * @param string $cart_key
     * @return int number of affected rows
     */
    public function delete_saved_cart( $cart_key ) {
        global $wpdb;

        return $wpdb->delete(
            $this->table_name,
            array( 'cart_key' => $cart_key ),
            array( '%s' )
        );
    }

    /**
     * Delete saved cart by user or by cart key and user ID
     *
     * @param string $cart_key
     * @param int $user_id
     * @return int number of affected rows
     */
    public function user_delete_saved_cart( $cart_key, $user_id ) {
        global $wpdb;

        return $wpdb->query( 
            $wpdb->prepare( 
                "DELETE FROM $this->table_name
                 WHERE cart_key = %s
                 AND user_id = %d",
                $cart_key, $user_id 
            )
        );
    }

    /**
     * Get all saved cart.
     *
     * @return array
     */
    public function get_all_saved_cart() {
        global $wpdb; 

        return $wpdb->get_results( 
            "SELECT *
            FROM {$wpdb->prefix}wcss_saved_cart", 
            ARRAY_A 
        );
    }

    /**
     * Get list of saved cart by user ID.
     *
     * @param int $user_id
     * @return array list of saved cart.
     */
    function get_saved_cart_by_user_id( $user_id ) {
        global $wpdb;
    
        return $wpdb->get_results( 
            $wpdb->prepare( 
                "SELECT * 
                FROM {$wpdb->prefix}wcss_saved_cart
                WHERE user_id = %d",
                $user_id
            ), ARRAY_A
        );
    }

    /**
     * Check whether cart saved or not. 
     *
     * @param string $cart_key
     * @since 1.7.2
     * @return boolean
     */
    public function is_cart_saved( $cart_key ) {
        global $wpdb;

        $query = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id
                FROM {$this->table_name}
                WHERE cart_key = %s", 
                $cart_key
            )
        );

        if ( $query ) {
            return true;
        }

        return false;
    }

}