<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Shared_Cart {

    private $table_name;

    public function __construct() {
        global $wpdb;

        $this->table_name = $wpdb->prefix.'wcss_shared_cart';
    }

    /**
     * Insert data into wcss_shared_cart table.
     *
     * @param   string    $cart_key
     * @param   array     $cart_value
     * @param   int       $cart_retrieved 
     * @param   string    $cart_created 
     * @return  int       return current inserted ID
     */
    public function insert( $cart_key, $cart_value = array(), $cart_retrieved = '', $cart_created = '' ) {
        global $wpdb;

        if ( ! $cart_retrieved ) {
            $cart_retrieved = 0;
        }
        if ( ! $cart_created ) {
            $cart_created = wcss_current_time();
        }
        if ( $this->is_cart_exist( $cart_key ) ){
            return false;
        }

        return $wpdb->insert( $this->table_name, 
            array( 
                'cart_key'          => $cart_key, 
                'cart_value'        => maybe_serialize( $cart_value ),
                'cart_retrieved'    => $cart_retrieved,
                'cart_created'      => $cart_created,
            ),
            array(
                '%s', '%s', '%d', '%s',
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
     * Get numbers of retrieved cart.
     *
     * @param string $cart_key
     * @return int
     */
    public function get_cart_retrieved( $cart_key ) {
        global $wpdb;

        return $wpdb->get_var(
            $wpdb->prepare(
                "SELECT cart_retrieved
                FROM {$this->table_name}
                WHERE cart_key = %s", 
                $cart_key
            )
        );
    }

    /**
     * Get cart retrieved time.
     *
     * @param string $cart_key
     * @return int
     */
    public function get_cart_retrieved_time( $cart_key ) {
        global $wpdb;

        return $wpdb->get_var(
            $wpdb->prepare(
                "SELECT cart_retrieved_time
                FROM {$this->table_name}
                WHERE cart_key = %s", 
                $cart_key
            )
        );
    }

    /**
     * Get shared cart data
     *
     * @param string $cart_key
     * @param string $column    name of the column of database
     * @return mixed
     */
    public function get_shared_cart_data( $cart_key, $column ) {
        if ( ! $column ) {
            return false;
        }

        global $wpdb;

        $data = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT $column
                FROM {$this->table_name}
                WHERE cart_key = %s", 
                $cart_key
            )
        );

        return maybe_unserialize( $data );
    } 

    public function update( $cart_key, $data = array() ) {
        global $wpdb;

        $wpdb->update( 
            $this->table_name, 
            $data, 
            array( 'cart_key' => $cart_key )
        );
    }

    public function delete_cart( $cart_key ) {
        global $wpdb;

        return $wpdb->delete( $this->table_name, array( 'cart_key' => $cart_key ), array( '%s' ) );
    }

    public function is_cart_exist( $cart_key ) {
        global $wpdb;

        return $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id
                FROM {$this->table_name}
                WHERE cart_key = %s", 
                $cart_key
            )
        );
    }

}