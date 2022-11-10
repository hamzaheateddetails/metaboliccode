<?php
/**
 * All Widgets facing functions
 */

namespace codexpert\Woolementor_Pro;
use codexpert\product\Base;
use \Elementor\Plugin as Elementor_Plugin;
use \Elementor\Controls_Manager;
use \Elementor\Core\Documents_Manager;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Widgets
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class Widgets extends Base {

	/**
	 * Constructor function
	 *
	 * @since 1.0
	 */
	public function __construct( $plugin ) {
		$this->slug = $plugin['TextDomain'];
		$this->name = $plugin['Name'];
		$this->version = $plugin['Version'];
	}

	public function enqueue_scripts() {

		// Are we in debug mode?
		$min = defined( 'WOOLEMENTOR_DEBUG' ) && WOOLEMENTOR_DEBUG ? '' : '.min';

		wp_enqueue_style( "{$this->slug}-widgets", plugins_url( "assets/css/style{$min}.css", WOOLEMENTOR_PRO ), '', $this->version, 'all' );
		// enqueue JavaScript
		wp_enqueue_script( 'xdLocalStorage', 'https://cdn.jsdelivr.net/npm/xdlocalstorage@2.0.5/dist/scripts/xdLocalStorage.min.js', [], '2.0.5', true );
		if ( woolementor_is_pro_activated() ) {
			wp_enqueue_script( "{$this->slug}-widgets", plugins_url( "assets/js/widgets{$min}.js", WOOLEMENTOR_PRO ), [], $this->version, true );
		}
	}

	/**
	 * Adds a new control in the editor
	 *
	 * @since 1.1
	 */
	public function add_control( $element, $section_id, $args ) {
		if ( 'section' === $element->get_name() && 'section_structure' == $section_id ) {
			$element->start_controls_section(
				'woolementor',
				[
					'tab' => Controls_Manager::TAB_LAYOUT,
					'label' => __( 'Woolementor', 'woolementor' ),
				]
			);

			$element->add_control(
				'contains_checkout',
				[
					'type'			=> Controls_Manager::SWITCHER,
					'label'			=> __( 'Contains Checkout?', 'woolementor' ),
					'description'	=> __( 'Does this section contain Woolementor Checkout Form?', 'woolementor' ),
				]
			);

			$element->add_control(
				'contains_thankyou',
				[
					'type'			=> Controls_Manager::SWITCHER,
					'label'			=> __( 'Contains Thankyou?', 'woolementor' ),
					'description'	=> __( 'Does this section contain Woolementor Thankyou page', 'woolementor' ),
					'separator'		=> 'before',
				]
			);

			$element->add_control(
				'contains_orderpay',
				[
					'type'			=> Controls_Manager::SWITCHER,
					'label'			=> __( 'Contains Order-pay?', 'woolementor' ),
					'description'	=> __( 'Does this section contain Woolementor Order pay section', 'woolementor' ),
					'separator'		=> 'before',
				]
			);

			$element->end_controls_section();
		}
	}

	public function conditions_for_templates( $element ) {

		if( !isset( $_GET['post'] ) || get_post_type( $_GET['post'] ) != 'elementor_library' ) return;

		$template_type =  get_post_meta( $_GET['post'], '_elementor_template_type', true );

		$element->start_controls_section(
			'wl_conditions',
			[
				'tab' => Controls_Manager::TAB_SETTINGS,
				'label' => __( 'Conditions', 'woolementor' ),
			]
		);

		if ( in_array( $template_type , [ 'wl-header', 'wl-footer' ] ) ) {
			$element->add_control(
				'page_includes',
				[
					'label' 		=> __( 'Include Pages', 'woolementor-pro' ),
					'type' 			=> Controls_Manager::SELECT2,
					'multiple' 		=> true,
					'label_block' 	=> true,
					'options' 		=> [ 0 => __( 'All', 'woolementor-pro' ) ] + woolementor_get_posts( 'page', false ),
				]
			);

			$element->add_control(
				'post_includes',
				[
					'label' 		=> __( 'Include Posts', 'woolementor-pro' ),
					'type' 			=> Controls_Manager::SELECT2,
					'multiple' 		=> true,
					'label_block' 	=> true,
					'options' 		=> [ 0 => __( 'All', 'woolementor-pro' ) ] + woolementor_get_posts( 'post', false ),
				]
			);
		}

		if ( in_array( $template_type , [ 'wl-header', 'wl-footer', 'wl-single' ] ) ) {
			$element->add_control(
				'product_includes',
				[
					'label' 		=> __( 'Include Products', 'woolementor-pro' ),
					'type' 			=> Controls_Manager::SELECT2,
					'multiple' 		=> true,
					'label_block' 	=> true,
					'options' 		=> [ 0 => __( 'All', 'woolementor-pro' ) ] + woolementor_get_posts( 'product', false ),
				]
			);
		}
		
		if ( !in_array( $template_type , [ 'wl-single' ] ) ) {

			$element->add_control(
				'tax_includes',
				[
					'label' 		=> __( 'Include categories', 'woolementor-pro' ),
					'type' 			=> Controls_Manager::SELECT2,
					'multiple' 		=> true,
					'label_block' 	=> true,
					'options' 		=> [ 0 => __( 'All', 'woolementor-pro' ), 'shop' => __( 'Shop Only', 'woolementor-pro' ) ] + woolementor_get_terms()
				]
			);
		}

		$element->end_controls_section();
	}

	/**
	 * Starting <form> tag
	 *
	 * @since 1.1
	 */
	public function form_start ( $element ) {
		$settings = $element->get_settings_for_display();	

		if( $settings['contains_checkout'] == 'yes' ) {
			echo apply_filters( 'woolementor-checkout_form_tag', '<form name="checkout" method="post" class="checkout woocommerce-checkout" action="" enctype="multipart/form-data" novalidate="novalidate">' );
		}
	}

	/**
	 * Closing </form> tag
	 *
	 * @since 1.1
	 */
	public function form_close( $element ) {
		$settings = $element->get_settings_for_display();

		if( $settings['contains_checkout'] == 'yes' ) {
			echo '</form>';
		}
	}

	public function custom_checkout_page_id( $checkout_page_id  ) {
		if( is_admin() ) return $checkout_page_id;

		global $post;
		$post_id = $post->ID;

		if ( isset( $_COOKIE['wl_current_page_id'] ) ) {
			$post_id = $_COOKIE['wl_current_page_id'];
		}
		$elementor_data = get_post_meta( $post_id, '_elementor_data', true );
		$_data 			= json_decode( $elementor_data );

		if( isset( $_data[0]->settings->contains_checkout ) ) {
			return $post_id;
		}

	    return $checkout_page_id;
	}

	public function order_received_permalink() {
		$slug = get_option( 'woocommerce_checkout_order_received_endpoint' );
		add_rewrite_endpoint( $slug . '/[0-9]+', EP_PERMALINK | EP_PAGES );
	}

	public function setcookie_pageid() {
		if( wp_doing_ajax() ) return;
		global $wp;

		$page = url_to_postid( home_url( $wp->request ) );
		if( $page != 0 ) {
			setcookie( 'wl_current_page_id', $page, time() + HOUR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
	}

	public function register_type( Documents_Manager $manager ) {
		$manager->register_document_type( 'wl-header', 'codexpert\Woolementor_Pro\Templates\Header' );
		$manager->register_document_type( 'wl-footer', 'codexpert\Woolementor_Pro\Templates\Footer' );
		$manager->register_document_type( 'wl-archive', 'codexpert\Woolementor_Pro\Templates\Archive' );
		$manager->register_document_type( 'wl-single', 'codexpert\Woolementor_Pro\Templates\Single' );
		$manager->register_document_type( 'wl-tab', 'codexpert\Woolementor_Pro\Templates\Tab' );
	}

	/**
	 * Register template types
	 *
	 * @since 1.3.0
	 */
	public function template_types( $types, $document_types ) {
		$types['wl-header']		= __( 'WL Header', 'woolementor-pro' );
		$types['wl-footer']		= __( 'WL Footer', 'woolementor-pro' );
		$types['wl-archive']	= __( 'WL Product Archive', 'woolementor-pro' );
		$types['wl-single']		= __( 'WL Single Product', 'woolementor-pro' );
		$types['wl-tab']		= __( 'WL Tab', 'woolementor-pro' );

		return $types;
	}

	public function save_template_meta( $post_id )	{
		
		if ( !in_array( get_post_meta( $post_id, '_elementor_template_type', true ), [ 'wl-header', 'wl-footer', 'wl-archive', 'wl-single' ] ) ) return;

		$data = json_decode( wp_unslash( $_POST['actions'] ) )->save_builder->data->settings;

		if ( isset( $data->page_includes ) && count( $data->page_includes ) > 0 ) {
			update_post_meta( $post_id, 'wl_page_includes', $data->page_includes );
		}
		else {
			delete_post_meta( $post_id, 'wl_page_includes' );
		}

		if ( isset( $data->post_includes ) && count( $data->post_includes ) > 0 ) {
			update_post_meta( $post_id, 'wl_post_includes', $data->post_includes );
		}
		else {
			delete_post_meta( $post_id, 'wl_post_includes' );
		}

		if ( isset( $data->product_includes ) && count( $data->product_includes ) > 0 ) {
			update_post_meta( $post_id, 'wl_product_includes', $data->product_includes );
		}
		else {
			delete_post_meta( $post_id, 'wl_product_includes' );
		}

		if ( isset( $data->tax_includes ) && count( $data->tax_includes ) > 0 ) {
			update_post_meta( $post_id, 'wl_tax_includes', $data->tax_includes );

			if( count( array_intersect( [ 'shop', 0 ], $data->tax_includes ) ) > 0 ) {
				$page_includes 		= get_post_meta( $post_id, 'wl_page_includes', true ) ? : [];
				$page_includes[] 	= '"' . wc_get_page_id( 'shop' ) . '"';
				update_post_meta( $post_id, 'wl_page_includes', $page_includes );
			}
		}
		else {
			delete_post_meta( $post_id, 'wl_tax_includes' );
		}
	}

	public function load_canvas_template( $single_template ) {
		global $post;

		if ( in_array( get_post_meta( $post->ID, '_elementor_template_type', true ), [ 'wl-header', 'wl-footer' ] ) ) {
			return ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';
		}

		return $single_template;
	}

	public function stop_render_checkout( $should_render, $object )	{
		$settings = $object->get_settings_for_display();

		if ( isset( $settings['contains_checkout'] ) && $settings['contains_checkout'] == 'yes'  && ( is_order_received_page() || is_order_pay_page() ) ) {
			return false;
		}
		elseif ( isset( $settings['contains_thankyou'] ) && $settings['contains_thankyou'] == 'yes'  && !is_order_received_page() ) {
			return false;
		}
		elseif ( isset( $settings['contains_orderpay'] ) && $settings['contains_orderpay'] == 'yes'  && !is_order_pay_page() ) {
			return false;
		}

		return $should_render;
	}
}