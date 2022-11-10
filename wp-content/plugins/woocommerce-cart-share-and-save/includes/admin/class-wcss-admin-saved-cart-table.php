<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

class WCSS_Admin_Saved_Cart_Table extends WP_List_Table {

    private $_table_shared;
    private $_table_saved;

    /** Class constructor */
	public function __construct() {
        global $wpdb;

        $this->_table_shared = $wpdb->prefix.'wcss_shared_cart';
        $this->_table_saved  = $wpdb->prefix.'wcss_saved_cart';

		parent::__construct( [
			'singular' => esc_html__( 'Saved Cart', 'woo-cart-share' ), //singular name of the listed records
			'plural'   => esc_html__( 'Saved Cart', 'woo-cart-share' ), //plural name of the listed records
			'ajax'     => false //should this table support ajax?
		] );

    }
    
    public function prepare_items() {

        $order_by   = isset( $_GET['orderby'] ) ? trim( $_GET['orderby'] ) : '';
        $order      = isset( $_GET['order'] ) ? trim( $_GET['order'] ) : '';
        $search_term = isset( $_POST['s'] ) ? trim( $_POST['s'] ) : '';

        $data       = $this->wp_list_table_data( $order_by, $order, $search_term );

        $pre_page       = 10;
        $currnet_page   = $this->get_pagenum(); 
        $total_items    = count( $data );

        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $pre_page,
        ) );

        $columns    = $this->get_columns();
        $hidden     = $this->get_hidden_columns();
        $sortable   = $this->get_sortable_columns();
        
        $this->_column_headers  = array( $columns, $hidden, $sortable );
        $this->items            = array_slice( $data, ( ( $currnet_page - 1  ) * $pre_page ), $pre_page );
    }

    public function wp_list_table_data( $order_by = '', $order = '', $search_term = '' ) {
        global $wpdb;

        // Search results.
        if ( '' !== $search_term ) {
            $query = $wpdb->get_results( 
                "SELECT 
                    saved.id id, 
                    saved.user_id user_id,
                    users.user_login user_login, 
                    saved.cart_name cart_name, 
                    saved.cart_key cart_key, 
                    saved.cart_saved cart_saved, 
                    shared.cart_retrieved cart_retrieved, 
                    shared.cart_retrieved_time cart_retrieved_time,
                    saved.cart_key actions
                FROM 
                    $this->_table_saved saved 
                INNER JOIN 
                    $this->_table_shared shared 
                ON 
                    saved.cart_key = shared.cart_key
                INNER JOIN 
                    $wpdb->users users 
                ON 
                    users.id = saved.user_id
                WHERE ( users.user_login LIKE '%$search_term%' )
                    OR ( saved.cart_name LIKE '%$search_term%' )
                    OR ( saved.cart_key LIKE '%$search_term%' )
                    OR ( shared.cart_retrieved LIKE '%$search_term%' )
                    OR ( shared.cart_retrieved_time LIKE '%$search_term%' )
                    OR ( saved.cart_saved LIKE '%$search_term%' )
                ORDER BY id DESC",
                ARRAY_A 
            );
        } else { // Display all results.
            $query = $wpdb->get_results( 
                "SELECT
                    saved.id id, 
                    saved.user_id user_id,
                    users.user_login user_login, 
                    saved.cart_name cart_name, 
                    saved.cart_key cart_key, 
                    saved.cart_saved cart_saved, 
                    shared.cart_retrieved cart_retrieved, 
                    shared.cart_retrieved_time cart_retrieved_time,
                    saved.cart_key actions
                FROM 
                    $this->_table_saved saved 
                INNER JOIN 
                    $this->_table_shared shared 
                ON 
                    saved.cart_key = shared.cart_key
                INNER JOIN 
                    $wpdb->users users 
                ON 
                    users.id = saved.user_id
                ORDER BY saved.id DESC", 
                ARRAY_A 
            );
        }
        
        // Orderd by
        if ( '' !== $order_by && '' !== $order ) {
            if ( 'user_login' === $order_by ) {
                if ( 'asc' === $order ) {
                    usort( $query, $this->make_comparer( ['user_login', SORT_ASC ] ) );
                } else {
                    usort( $query, $this->make_comparer( ['user_login', SORT_DESC ] ) );
                }
            }
            if ( 'cart_name' === $order_by ) {
                if ( 'asc' === $order ) {
                    usort( $query, $this->make_comparer( ['cart_name', SORT_ASC ] ) );
                } else {
                    usort( $query, $this->make_comparer( ['cart_name', SORT_DESC ] ) );
                }
            }
            if ( 'cart_key' === $order_by ) {
                if ( 'asc' === $order ) {
                    usort( $query, $this->make_comparer( ['cart_key', SORT_ASC ] ) );
                } else {
                    usort( $query, $this->make_comparer( ['cart_key', SORT_DESC ] ) );
                }
            }
            if ( 'cart_retrieved' === $order_by ) {
                if ( 'asc' === $order ) {
                    usort( $query, $this->make_comparer( ['cart_retrieved', SORT_ASC ] ) );
                } else {
                    usort( $query, $this->make_comparer( ['cart_retrieved', SORT_DESC ] ) );
                }
            }
            if ( 'cart_retrieved_time' === $order_by ) {
                if ( 'asc' === $order ) {
                    usort( $query, $this->make_comparer( ['cart_retrieved_time', SORT_ASC ] ) );
                } else {
                    usort( $query, $this->make_comparer( ['cart_retrieved_time', SORT_DESC ] ) );
                }
            }
            if ( 'cart_saved' === $order_by ) {
                if ( 'asc' === $order ) {
                    usort( $query, $this->make_comparer( ['cart_saved', SORT_ASC ] ) );
                } else {
                    usort( $query, $this->make_comparer( ['cart_saved', SORT_DESC ] ) );
                }
            }
        }

        return $query;
    }

    public function get_columns() {
        $columns = array(
            'cb'                    => '<input type="checkbox" />',
            'user_login'            => esc_html__( 'Saved By', 'woo-cart-share' ),
            'cart_name'             => esc_html__( 'Cart Name', 'woo-cart-share' ),
            'cart_key'              => esc_html__( 'Cart Key', 'woo-cart-share' ),
            'cart_retrieved'        => esc_html__( 'Cart Retrieved', 'woo-cart-share' ),
            'cart_retrieved_time'   => esc_html__( 'Retrieved Time', 'woo-cart-share' ),
            'cart_saved'            => esc_html__( 'Cart Saved', 'woo-cart-share' ),
            'actions'               => esc_html__( 'Actions', 'woo-cart-share' ),
        );

        return $columns;
    }

    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'user_login':
                return '<a href="' . admin_url( 'user-edit.php?user_id=' . intval( $item['user_id'] ) ) . '">' . $item[$column_name] . '</a>';
            case 'cart_key':
                return '<a href="' . wcss_get_cart_link( $item['cart_key'] ) . '">' . $item[$column_name] . '</a>';
            case 'cart_retrieved':
                return intval( $item['cart_retrieved'] );
            case 'cart_retrieved_time':
                return esc_html( $item['cart_retrieved_time'] );
            case 'actions':
                return wp_sprintf( '<a class="button" href="%s"><i class="wcss-icon-eye"></i></a><a class="button button-link-delete" href="%s" onclick="return confirm( \'%s\' )"><i class="wcss-icon-trash"></i></a>',
                    admin_url( 'admin.php?page=woocommerce-cart-share_saved-cart&cart_key=' . $item['cart_key'] ),
                    wp_nonce_url( admin_url( '?wcss_delete_cart=' . $item['cart_key'] ) ),
                    esc_attr__( 'Are you sure?', 'woo-cart-share' )
                );
            case 'cart_name':
            case 'cart_saved':
                return $item[$column_name];
            default:
                return __( 'No Value', 'woo-cart-share' );
        }
    }

    public function get_hidden_columns() {
        return array();
    } 

    public function get_sortable_columns() {
        return array( 
            'user_login'            => array( 'user_login', false ),
            'cart_name'             => array( 'cart_name', false ),
            'cart_key'              => array( 'cart_key', false ),
            'cart_retrieved'        => array( 'cart_retrieved', false ),
            'cart_retrieved_time'   => array( 'cart_retrieved_time', false ),
            'cart_saved'            => array( 'cart_saved', false ),
        );
    }

    public function column_cb( $item ) {
        return sprintf( '<input type="checkbox" name="post[]" value="%s" />', $item['id'] );
    }

    public function make_comparer() {
        // Normalize criteria up front so that the comparer finds everything tidy
        $criteria = func_get_args();
        foreach ($criteria as $index => $criterion) {
            $criteria[$index] = is_array($criterion)
                ? array_pad($criterion, 3, null)
                : array($criterion, SORT_ASC, null);
        }
    
        return function($first, $second) use (&$criteria) {
            foreach ($criteria as $criterion) {
                // How will we compare this round?
                list($column, $sortOrder, $projection) = $criterion;
                $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;
    
                // If a projection was defined project the values now
                if ($projection) {
                    $lhs = call_user_func($projection, $first[$column]);
                    $rhs = call_user_func($projection, $second[$column]);
                }
                else {
                    $lhs = $first[$column];
                    $rhs = $second[$column];
                }
    
                // Do the actual comparison; do not return if equal
                if ($lhs < $rhs) {
                    return -1 * $sortOrder;
                }
                else if ($lhs > $rhs) {
                    return 1 * $sortOrder;
                }
            }
    
            return 0; // tiebreakers exhausted, so $first == $second
        };
    }

}
