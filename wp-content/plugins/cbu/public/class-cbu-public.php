<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/company/level6/about/
 * @since      1.0.0
 *
 * @package    Cbu
 * @subpackage Cbu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cbu
 * @subpackage Cbu/public
 * @author     Level6 <it@level6.co>
 */
class Cbu_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Add products to cart URL functionality
	*/
	public function apply_cart(){
		// Make sure WC is installed, and add-to-cart query arg exists, and contains at least one comma or one attribute_.
		//If it's normal add to cart will be handles by WC.
	
		if (!class_exists('WC_Form_Handler') || empty($_REQUEST['add-to-cart']) || (false === strpos($_REQUEST['add-to-cart'], ',') && false === strpos($_REQUEST['add-to-cart'], 'attribute_'))) {
			return;
		}

		//Remove the default WC handler for the case the multiple products in URL
		remove_action('wp_loaded', array('WC_Form_Handler', 'add_to_cart_action'), 20);

		if ("yes" === get_option('cbu_empty_cart', "no")) {
			WC()->cart->empty_cart(true); // Empty the cart
			WC()->session->set('cart', array()); // Empty the session cart data
		} else { //TODO: Else add stock validation by elements.

		}

		$url = $this->get_formated_url();

		// Format: ?add-to-cart=354,355x4,356x5xattribute_weight:20_mil,357xattribute_weight:10_mil,358x3xattribute_weight:10_milxattribute_weight:20_mil,359xattribute_weight:10_milxattribute_weight:20_mil,360x456:2x457x5,
		// 354 -- add to cart the product (id 354) simple or variation with quantity of 1.
		// 355x4 -- add to cart a product (id 355) simple or variation with quantity of 4.
		// 356x5xattribute_weight:20_mil -- add to cart the variation (attribute_weight:20_mil) for the product variable with id 356 with a quantity of 5.
		// 357xattribute_weight:10_mil   -- add to cart the variation (attribute_weight:10_mil) for the product variable with id 357 with a quantity of 1.
		// 358xattribute_weight:10_milxattribute_weight:20_mil   -- add to cart the variation (attribute_weight:20_mil + attribute_weight:10_mil) for the product variable with id 358 with a quantity of 1.
		// 359x3xattribute_weight:10_milxattribute_weight:20_mil -- add to cart the variation (attribute_weight:20_mil + attribute_weight:10_mil) for the product variable with id 359 with a quantity of 3.
		// 360x456:2x457x5  -- add to cart 2 items of the product 456 and 5 items of the product 457 from the grouped product (id 360).
		$cart_items = explode(',', $_REQUEST['add-to-cart']);
		$quantity = wc_stock_amount(1);
		$items = array();

		foreach ($cart_items as $cart_item) {
			if (false !== strpos($cart_item, 'x')) {
				$cart_item = explode('x', $cart_item);
				$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($cart_item[0]));
				unset($cart_item[0]);
				foreach ($cart_item as $item) {
					if (false === strpos($item, ':')) {
						$quantity = wc_stock_amount(wp_unslash($item));
					} else {
						$item_key = explode(':', $item);
						$items[sanitize_title(wp_unslash($item_key[0]))] = wp_unslash($item_key[1]);
					}
				}
			} else {
				$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($cart_item));
			}

			$adding_to_cart = wc_get_product($product_id);

			if (!$adding_to_cart) {
				return;
			}

			$add_to_cart_handler = apply_filters('woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart);

			if ('variable' === $add_to_cart_handler || 'variation' === $add_to_cart_handler) {
				$this->add_to_cart_handler_variable($adding_to_cart, $quantity, isset($items) ? $items : null);
			} elseif ('grouped' === $add_to_cart_handler) {
				$this->add_to_cart_handler_grouped($product_id, isset($items) ? $items : null);
			} elseif (has_action('cbu_woocommerce_add_to_cart_handler_' . $add_to_cart_handler)) {
				do_action('cbu_woocommerce_add_to_cart_handler_' . $add_to_cart_handler, $url); // Custom handler.
			} else {
				$this->add_to_cart_handler_simple($product_id, $quantity);
			}
		}
		// Now optionally do a redirect.
		$url = apply_filters('woocommerce_add_to_cart_redirect', $url, $adding_to_cart);

		if ($url) {
			wp_safe_redirect($url);
			exit;
		} elseif ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wp_safe_redirect(wc_get_cart_url());
			exit;
		}
		
	}


	/**
	 * Add to cart handler for variable product
	 *
	 * @since    1.0.0
	 * @param      WC_Product       $product --  WC_Product_Variation | WC_Product_Variable
	 * @param      int              $quantity    The quantity of the product
	 * @param      string | null    $variations    The variable_key of the variation of the variable product.
	 * @return Bool
	 */
	private function add_to_cart_handler_variable( $product, $quantity, $variations = null ){
		if($product->is_type('variable')){ // Product is WC_Product_Variable
			$product_id = $product->get_id();
			$variation_id = null;
		}else{ //Product is WC_Product_Variation
			$variation_id = $product->get_id();
			$product_id = $product->get_parent_id();
		}

		$product      = wc_get_product( $product_id );

		if ( ! $product ) {
			return false;
		}

		// If no variation ID is set, attempt to get a variation ID from posted attributes.
		if ( empty( $variation_id ) ) {
			$data_store   = WC_Data_Store::load( 'product' );
			$variation_id = $data_store->find_matching_product_variation( $product, $variations );
		}

		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );

		if ( ! $passed_validation ) {
			return false;
		}

		// Prevent parent variable product from being added to cart.
		if ( empty( $variation_id ) && $product && $product->is_type( 'variable' ) ) {
			/* translators: 1: product link, 2: product name */
			wc_add_notice( sprintf( __( 'Please choose product options by visiting <a href="%1$s" title="%2$s">%2$s</a>.', 'woocommerce' ), esc_url( get_permalink( $product_id ) ), esc_html( $product->get_name() ) ), 'error' );
			return false;
		}

		if ( false !== WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}

		return false;
	}

	/**
	 * Add to cart handler for grouped product
	 *
	 * @since    1.0.0
	 * @param      WC_Product       $product -- WC_Product_Grouped
	 * @param      string | null    $items    The variable_key of the variation of the variable product.
	 * @return Bool
	 */
	private function add_to_cart_handler_grouped($product, $items = null){
		$was_added_to_cart = false;
		$added_to_cart     = array();

		if ( ! empty( $items ) ) {
			$quantity_set = false;

			foreach ( $items as $item => $quantity ) {
				$quantity = wc_stock_amount( $quantity );
				if ( $quantity <= 0 ) {
					continue;
				}
				$quantity_set = true;

				// Add to cart validation.
				$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $item, $quantity );

				// Suppress total recalculation until finished.
				remove_action( 'woocommerce_add_to_cart', array( WC()->cart, 'calculate_totals' ), 20, 0 );

				if ( $passed_validation && false !== WC()->cart->add_to_cart( $item, $quantity ) ) {
					$was_added_to_cart      = true;
					$added_to_cart[ $item ] = $quantity;
				}

				add_action( 'woocommerce_add_to_cart', array( WC()->cart, 'calculate_totals' ), 20, 0 );
			}

			if ( ! $was_added_to_cart && ! $quantity_set ) {
				wc_add_notice( __( 'Please choose the quantity of items you wish to add to your cart&hellip;', 'woocommerce' ), 'error' );
			} elseif ( $was_added_to_cart ) {
				wc_add_to_cart_message( $added_to_cart );
				WC()->cart->calculate_totals();
				return true;
			}
		}elseif ( $product ) {
			/* Link on product archives */
			wc_add_notice( __( 'Please choose a product to add to your cart&hellip;', 'woocommerce' ), 'error' );
		}
		return false;
	}

	/**
	 * Add to cart handler for simple product
	 *
	 * @since    1.0.0
	 * @param      int       $product_id --  WC_Product_Simple
	 * @param      int              $quantity    The quantity of the product
	 * @return Bool
	 */
	private function add_to_cart_handler_simple($product_id, $quantity){
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

		if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}
		return false;
	}

	/**
	 * Get formated URL saved in configuration
	 *
	 * @since    1.0.0
	 * @return string
	 */
	private function get_formated_url(){
		switch (get_option('cbu_redirect_to', 'none')) {
			case "checkout":
				return get_permalink( wc_get_page_id( 'checkout' ) );
				break;
			case "shop":
				return get_permalink( wc_get_page_id( 'shop' ) );
				break;
			case "cart":
				return get_permalink( wc_get_page_id( 'cart' ) );
				break;
			case "home":
				return get_home_url();
				break;
			default:
				return "";
				break;
		}
	}

}
