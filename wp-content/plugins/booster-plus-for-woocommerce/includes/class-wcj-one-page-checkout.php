<?php
/**
 * Booster for WooCommerce - Module - One Page Checkout
 *
 * @version 5.4.7
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WCJ_One_page_checkout' ) ) :

class WCJ_One_page_checkout extends WCJ_Module {
    
    static $add_wc_scripts = true;

	/**
	 * Constructor.
	 *
	 * @version 5.4.2
	 */
	function __construct() {

		//woobt_show_items

		$this->id         = 'one_page_checkout';
		$this->short_desc = __( 'One Page Checkout', 'woocommerce-jetpack' );
		$this->desc       = __( 'Add One Page Checkout.', 'woocommerce-jetpack' );
		$this->desc_pro   = __( 'Add One Page Checkout.', 'woocommerce-jetpack' );
		$this->link_slug  = 'woocommerce-one-page-checkout';
		$this->extra_desc = sprintf( __( 'You can use below shortcode to display the One Page Checkout: %s', 'woocommerce-jetpack' ),
			'<ol>' .
				'<li>' . sprintf( __( '<strong>Shortcodes:</strong> %s', 'woocommerce-jetpack' ),
					'<code>[wcj_one_page_checkout product_ids = "1,2,3"]</code> set your product IDs <br>If you did not set product_ids, then it will get Global Product IDs selected in the Products option.' ) .
				'</li>' .
				'<li>' . sprintf( __( '<strong>PHP code:</strong> by using %s function,<br> e.g.: %s', 'woocommerce-jetpack' ),
					'<code>do_shortcode()</code>',
					'<code>echo&nbsp;do_shortcode(&nbsp;\'[wcj_one_page_checkout product_ids = "1,2,3"]\'&nbsp;);</code>' ) .
				'</li>' .
				'<li>' . sprintf( __( '<strong>Without Shortcode:</strong> %s', 'woocommerce-jetpack' ),
					'<code> If you need per product One Page Checkout, please check the "Booster: One Page Checkout" meta field on the product edit page.</code>' ) .
				'</li>' .
			'</ol>' );

		parent::__construct();

		if ( $this->is_enabled() ) {
			
            add_shortcode( 'wcj_one_page_checkout', array( $this, 'wcj_one_page_checkout' ) );

			add_action( 'add_meta_boxes',    array( $this, 'add_meta_box' ) );
			add_action( 'save_post_product', array( $this, 'save_meta_box' ), PHP_INT_MAX, 2 );

			if ( wcj_is_frontend() ) {
                
                add_action( 'wp_enqueue_scripts', array( $this, 'wcj_opc_enqueue_scripts' ) );
		        add_action( 'woocommerce_after_single_product_summary', array( $this, 'wcj_opc_single_product_checkout' ), 50 );
		        
		        add_action( 'wp_ajax_'        . 'wcj_ajax_add_opc_add_to_cart', array( $this, 'wcj_ajax_add_opc_add_to_cart' ) );
		        add_action( 'wp_ajax_nopriv_' . 'wcj_ajax_add_opc_add_to_cart', array( $this, 'wcj_ajax_add_opc_add_to_cart' ) );

                // load WC checkout js update order section
		        add_action( 'template_redirect', array( $this, 'wcj_opc_set_session' ), 1 );
				add_filter('thwcfe_force_enqueue_checkout_public_scripts','__return_true');
		    
			}
		}
	}

	/**
	 * wcj_opc_enqueue_scripts.
	 *
	 * @version 5.4.7
	 * @since   5.4.2
	 */
	function wcj_opc_enqueue_scripts() {
		wp_enqueue_style( 'wcj-opc-style', wcj_plugin_url() . '/includes/css/wcj-opc-style.css', array(), WCJ()->version );
		wp_enqueue_style( 'wcj-opc-styles', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), WCJ()->version );
		wp_enqueue_script( 'wcj-opc-script', wcj_plugin_url() . '/includes/js/wcj-opc-script.js', array(), WCJ()->version, true );
		wp_localize_script( 'wcj-opc-script', 'ajax_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			) );

		if ( self::$add_wc_scripts ) {
			$suffix      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		    $wc_assets_path = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
		    wp_enqueue_script( 'wc-checkout', $wc_assets_path . 'js/frontend/checkout' . $suffix . '.js', array( 'jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n' ), WC_VERSION, true );
			wp_enqueue_script( 'wc-checkouts','https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js' );
		    wp_enqueue_script( 'wc-credit-card-form' );
		}
	}
    
    /**
	 * wcj_opc_single_product_checkout.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	function wcj_opc_single_product_checkout(){
		global $product;
		$product_id  = $product->get_id();
		$current_product = wc_get_product( $product_id );
  		$wcj_opc_single_product_enabled  = get_post_meta( $product_id, '_wcj_product_opc_enabled', true );
        
        if( $wcj_opc_single_product_enabled === "yes" ){
        	
        	do_action( 'wcj_opc_before_wcj_opc_checkout' );
            
            WC()->cart->calculate_totals();
			$checkout = WC()->checkout(); 
			wc_get_template( 'checkout/form-checkout.php', array( 'checkout' => $checkout )  );
        }                          
	}	
    
    /**
	 * wcj_one_page_checkout.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	function wcj_one_page_checkout( $atts ) {
        if ( !wcj_is_frontend_request() ) {
            return;
        }
        
        if( isset($atts['product_ids']) && $atts['product_ids'] != "" ){
			$product_ids = explode(",",$atts['product_ids']);
		}
		else{
            $product_ids = get_option( 'wcj_opc_global_ids','no');
		}

        if ( is_array( $product_ids ) && ! empty($product_ids) ){
            
            do_action( 'wcj_opc_before_wcj_opc_checkout' );

            $products_args = array(
				'post_type'      => array( 'product', 'product_variation' ),
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post__in'       =>  $product_ids,
				'posts_per_page' => -1,
			);
            
            $products_post = get_posts( $products_args );
            $products = array();

            foreach ( $products_post as $product_post ) {

				$product = wc_get_product( $product_post->ID );

				if ( ! is_object( $product ) ) {
					continue;
				}

				if ( ( $product->is_type( 'variable' ) || $product->is_type( 'grouped' ) )  ) {

					$visible_children = $product->get_visible_children();

					foreach ( $visible_children as $child_id ) {

						$child = wc_get_product( $child_id );

						if ( ( $product->is_type( 'variable' ) && $this->all_variation_attributes_set( $child ) ) || ( $product->is_type( 'grouped' ) && ! $child->has_child() ) ) {
							$products = $this->build_products_array( $child, $products );
						}
					}

				} else {
					$products = $this->build_products_array( $product, $products );
				}
			}

            
            if ( is_array( $products ) && ! empty($products) ){
            	$located = untrailingslashit( realpath( plugin_dir_path( __FILE__ ) . '/..' ) ) . '/includes/templates/';
            	wc_get_template( 'wcj-opc-add-to-cart/wcj-opc-products.php', array( 'products' => $products ), '', $located );
            }

            WC()->cart->calculate_totals();
	        $checkout = WC()->checkout(); 
	        wc_get_template( 'checkout/form-checkout.php', array( 'checkout' => $checkout )  );
	    }
	}

    /**
	 * all_variation_attributes_set.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	private function all_variation_attributes_set( $variation ) {
		$set = true;
		// undefined attributes have null strings as array values
		foreach( $variation->get_variation_attributes() as $att ){
			if( ! $att ){
				$set = false;
				break;
			}
		}
		return $set;
	}

	/**
	 * build_products_array.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	private function build_products_array( $product, $products = array() ) {
		if ( ! is_object( $product ) || ! $product->exists() ) {
			return $products;
		}

		$products[ $product->get_id() ] = $product;

		return $products;
	}

	/**
	 * wcj_ajax_add_opc_add_to_cart.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	function wcj_ajax_add_opc_add_to_cart() {
		$product_id = $_POST['product_id'];
        
        $response_data       = array();
        $product_added_to_cart   = false;
		$product             = wc_get_product( $product_id );
		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->get_type(), $product );
		$wcj_product_title = $product->get_title();

		// Variation handling
		if ( 'variation' === $add_to_cart_handler ) {

			$variation_id       = $product_id;
			$product_id         = wcj_get_variation_parent_id( $product );
			$quantity           = 1;
			$all_variations_set = true;
			$variations         = array();

			$parent     = wc_get_product( $product_id );
			$attributes = $parent->get_attributes();
			$variations = $product->get_variation_attributes();
			$variation  = $product;

			// Verify all attributes
			foreach ( $variations as $name => $value ) {

				if ( $value ) {
					if ( ! taxonomy_exists( esc_attr( str_replace( 'attribute_', '', $name ) ) ) ) {
						$variations[ $name ] = $this->get_formatted_attribute_value( $name, $value, $attributes );
					}
					continue;
				}

				$all_variations_set = false;
			}

			if ( $all_variations_set ) {
				// Add to cart validation
				$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );

				if ( $passed_validation ) {
					if ( WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) ) {
						wc_add_notice( $this->get_add_to_cart_message( $quantity, $product->get_title() . ' (' . $this->get_formatted_variation_data( $variations, $attributes, true ) . ')' ), 'success' );
						$product_added_to_cart = true;
					}
				}
			} else {
				wc_add_notice( __( 'Please choose product options&hellip;', 'woocommerce-jetpack' ), 'error' );
			}

		// Variable product handling
		} elseif ( 'variable' === $add_to_cart_handler ) {

			$variation_id       = empty( $_REQUEST['variation_id'] ) ? '' : absint( $_REQUEST['variation_id'] );
			$quantity           = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
			$all_variations_set = true;
			$variations         = array();
			$passed_validation  = false;

			$attributes = $product->get_attributes();
			$variation  = wc_get_product( $variation_id );

			// Verify all attributes
			foreach ( $attributes as $attribute ) {
				if ( ! $attribute['is_variation'] ) {
					continue;
				}

				$taxonomy = 'attribute_' . sanitize_title( $attribute['name'] );

				if ( isset( $_REQUEST[ $taxonomy ] ) ) {
					if ( $attribute['is_taxonomy'] ) {
						$value = sanitize_title( stripslashes( $_REQUEST[ $taxonomy ] ) );
					} else {
						$value = wc_clean( stripslashes( $_REQUEST[ $taxonomy ] ) );
					}

					$variation_data = wc_get_product_variation_attributes( $variation_id );
					$valid_value    = $variation_data[ $taxonomy ];

					// Allow if valid
					if ( '' === $valid_value || $valid_value === $value ) {
						$variations[ $taxonomy ] = $value;
						continue;
					}
				}

				$all_variations_set = false;
			}

			if ( $all_variations_set ) {
				$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );

				if ( $passed_validation ) {
					if ( WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) ) {
						wc_add_notice( $this->get_add_to_cart_message( $quantity, $product->get_title() . ' (' . $this->get_formatted_variation_data( $variations, $attributes, true ) . ')' ), 'success' );
						$product_added_to_cart = true;
					}
				}
			}

			if ( empty( $variation_id ) || ! $all_variations_set ) {
				wc_add_notice( __( 'Please choose product options&hellip;', 'woocommerce-jetpack' ), 'error' );
			}
        
        // Simple Products
		} else {

			$quantity = 1;

			// Add to cart validation
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

			if ( $passed_validation ) {
				// Add the product to the cart
				if ( WC()->cart->add_to_cart( $product_id, $quantity ) ) {
					wc_add_notice( $this->get_add_to_cart_message( $quantity, $product->get_title() ), 'success' );
					$product_added_to_cart = true;
				}
			}

		}

		WC()->cart->maybe_set_cart_cookies();

		ob_start();

		wc_print_notices();

		$response_data['messages'] = ob_get_clean();

		if ( $passed_validation && $product_added_to_cart ) {
			$response_data['success'] = 1;
			if ( $product->is_type( 'variation' ) ) {
				$product_id = wcj_get_variation_parent_id( $product );
			}
			do_action( 'woocommerce_ajax_added_to_cart', $product_id );

		} else {
			$response_data['success'] = 0;
		}

        echo json_encode( $response_data );
		die();
	}
    
    /**
	 * wcj_opc_set_session.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	function wcj_opc_set_session() {
		if ( $this->is_wcj_opc_page() && ! WC()->session->has_session() ) {
			WC()->session->set_customer_session_cookie( true );
		}
	}

	/**
	 * is_wcj_opc_page.
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	private function is_wcj_opc_page( $id = "" ) {
		$is_wcj_opc_page = false;
		if($id == ""){
			global $post;
		    if ( is_object( $post ) ) {
			    if( false !== stripos( $post->post_content, '[wcj_one_page_checkout' ) ){
			    	$is_wcj_opc_page = true;
			    	self::$add_wc_scripts = true;
			    }
			}
		}
		else {
			$post = get_post( $id );
			if ( is_object( $post ) ) {
			    if( false !== stripos( $post->post_content, '[wcj_one_page_checkout' ) ){
			    	$is_wcj_opc_page = true;
			    	self::$add_wc_scripts = true;
			    }
			}
		}
		return $is_wcj_opc_page;
	}
    
    /**
	 * get_formatted_attribute_value
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	private function get_formatted_attribute_value( $attribute_title = '', $attribute_value = '', $product_attributes = null ) {

		if ( empty( $attribute_title ) || empty( $attribute_value ) ) {
			return;
		}

		$attribute_title = esc_attr( str_replace( 'attribute_', '', $attribute_title ) );

		if ( taxonomy_exists( $attribute_title ) ) {
			$term = get_term_by( 'slug', $attribute_value, $attribute_title );
			if ( ! is_wp_error( $term ) && $term->name ) {
				$attribute_value = $term->name;
			}
		} else {
			if ( ! $product_attributes ) {
				$attribute_value = ucwords( str_replace( '-', ' ', $attribute_value ) );
			} else {

				if ( isset( $product_attributes[ $attribute_title ] ) ) {

					$options = array_map( 'trim', explode( WC_DELIMITER, $product_attributes[ $attribute_title ]['value'] ) );

					foreach ( $options as $option ) {
						if ( sanitize_title( $option ) == $attribute_value ) {
							$attribute_value = $option;
							break;
						}
					}
				}
			}
		}

		return $attribute_value;

	}
    
    /**
	 * get_add_to_cart_message
	 *
	 * @version 5.4.2
	 * @since   5.4.2
	 */
	private function get_add_to_cart_message( $quantity, $product_title ) {

		$product_title = '&quot;' . $product_title;

		if ( $quantity > 1 ) {
			$product_title = $quantity . ' &times; ' . $product_title;
		}

		return sprintf( __( '%s&quot; added to your order. Complete your order below.', 'woocommerce-jetpack' ), $product_title );
	}
    
    /**
	 * get_formatted_variation_data.
	 *
	 * @version 5.4.2
	 */
	private function get_formatted_variation_data( $variation_attributes, $product_attributes, $flat = false ) {

		$item_data = array();

		// Variation data
		if ( ! empty( $variation_attributes ) && ! empty( $product_attributes ) ) {

			$variation_list = array();

			foreach ( $variation_attributes as $name => $value ) {

				if ( '' === $value )
					continue;

				$taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

				// If this is a term slug, get the term's nice name
				if ( taxonomy_exists( $taxonomy ) ) {
					$term = get_term_by( 'slug', $value, $taxonomy );
					if ( ! is_wp_error( $term ) && $term && $term->name ) {
						$value = $term->name;
					}
					$label = wc_attribute_label( $taxonomy );

				// If this is a custom option slug, get the options name
				} else {

					if ( isset( $product_attributes[ str_replace( 'attribute_', '', $name ) ] ) ) {
						$label = wc_attribute_label( $product_attributes[ str_replace( 'attribute_', '', $name ) ]['name'] );
					} else {
						$label = $name;
					}

					$options = array_map( 'trim', explode( WC_DELIMITER, $product_attributes[ str_replace( 'attribute_', '', $name ) ]['value'] ) );

					foreach ( $options as $option ) {
						if ( sanitize_title( $option ) == $value ) {
							$value = $option;
							break;
						}
					}
				}

				$item_data[] = array(
					'key'   => $label,
					'value' => apply_filters( 'woocommerce_variation_option_name', $value )
				);
			}
		}

		// Output flat or in list format
		if ( sizeof( $item_data ) > 0 ) {

			if ( $flat ) {

				$string = '';

				foreach ( $item_data as $data ) {
					$string .= esc_html( $data['key'] ) . ': ' . wp_kses_post( $data['value'] ) . ', ';
				}

				return rtrim( $string, ', ' );

			} else {
				ob_start();
				woocommerce_get_template( 'cart/cart-item-data.php', array( 'item_data' => $item_data ) );
				return ob_get_clean();
			}

		}

		return '';
	}

}
endif;

return new WCJ_One_page_checkout();