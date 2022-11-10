<?php
/**
 * Plugin Name: WC Designer Pro
 * Description: Premium feature unlocker for <strong>WC Designer (Formerly Woolementor)</strong>.
 * Plugin URI: https://codexpert.io/woolementor/?utm_source=dashboard&utm_medium=plugins&utm_campaign=plugin-uri
 * Author: WC Designer
 * Version: 2.7.0
 * Author URI: https://codexpert.io/woolementor/?utm_source=dashboard&utm_medium=plugins&utm_campaign=plugin-uri
 * Text Domain: woolementor-pro
 * Domain Path: /languages
 */

namespace codexpert\Woolementor_Pro;
use pluggable\product\License;
use codexpert\product\Survey;
use codexpert\product\Notice;
use codexpert\product\Deactivator;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package Plugin
 * @author codexpert <hello@codexpert.io>
 */
final class Plugin {
	
	public static $_instance;

	public function __construct() {
		self::include();
		self::define();
		self::hook();
	}

	/**
	 * Includes files
	 */
	public function include() {
		require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
	}

	/**
	 * Define variables and constants
	 */
	public function define() {
		// constants
		define( 'WOOLEMENTOR_PRO', __FILE__ );
		define( 'WOOLEMENTOR_PRO_DIR', dirname( WOOLEMENTOR_PRO ) );
		define( 'WOOLEMENTOR_PRO_DEBUG', apply_filters( 'woolementor-pro-debug', get_option( 'wl_enable_debug' ) == 'yes' ) );
		define( 'WOOLEMENTOR_PRO_ASSETS', plugins_url( 'assets', WOOLEMENTOR_PRO ) );

		// plugin data
		$this->plugin				= get_plugin_data( WOOLEMENTOR_PRO );
		$this->plugin['basename']	= plugin_basename( WOOLEMENTOR_PRO );
		$this->plugin['file']		= WOOLEMENTOR_PRO;
		$this->plugin['server']		= apply_filters( 'woolementor-pro_server', 'https://my.codexpert.io' );
		$this->plugin['min_php']	= '5.6';
		$this->plugin['min_wp']		= '4.0';
		$this->plugin['depends']	= [ 'woolementor/woolementor.php' => 'WC Designer' ];

		$this->plugin['item_id']	= 8088;
		$this->plugin['updatable']	= true;
		$this->plugin['license_page']= admin_url( 'admin.php?page=woolementor' );
		$this->plugin['license']	= new License( $this->plugin );
	}

	/**
	 * Hooks
	 */
	public function hook() {

		if( is_admin() ) :

			/**
			 * Admin facing hooks
			 *
			 * To add an action, use $admin->action()
			 * To apply a filter, use $admin->filter()
			 */
			$admin = new Admin( $this->plugin );
			$admin->action( 'plugins_loaded', 'i18n' );
			$admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );
			$admin->filter( 'woolementor-widget_links', 'widget_links' );
			$admin->filter( "plugin_action_links_{$this->plugin['basename']}", 'action_links' );
			$admin->filter( 'plugin_row_meta', 'plugin_row_meta', 10, 2 );
			$admin->action( 'woocommerce_admin_order_data_after_billing_address', 'billing_extra_fields_meta' );
			$admin->action( 'woocommerce_admin_order_data_after_shipping_address', 'shipping_extra_fields_meta', 10 );
			$admin->filter( 'woocommerce_payment_gateway_supports', 'supports_payment_form', 10, 3 );
			$admin->action( 'save_post', 'save_template_data' );
			$admin->filter( 'woolementor_pro_get_posts', 'pseudo_page_ids' );
			$admin->filter( 'cx-plugin_remote_notice_endpoint', '__return_false', 10, 2 ); // temporary

			/**
			 * Settings related hooks
			 *
			 * To add an action, use $settings->action()
			 * To apply a filter, use $settings->filter()
			 */
			$settings = new Settings( $this->plugin );
			$settings->action( 'cx-settings-before-form', 'license_form' );
			$settings->filter( 'woolementor-is_pro', '__return_true' );
			$settings->filter( 'woolementor-settings_args', 'settings_fields' );

			// Product related classes
			$survey			= new Survey( $this->plugin );
			$notice			= new Notice( $this->plugin );
			$deactivator	= new Deactivator( $this->plugin );

		else : // is_admin() ?

			/**
			 * Front facing hooks
			 *
			 * To add an action, use $front->action()
			 * To apply a filter, use $front->filter()
			 */
			$front = new Front( $this->plugin );
			$front->action( 'wp_head', 'head' );
			$front->action( 'wp_enqueue_scripts', 'enqueue_scripts' );
			$front->filter( 'the_content', 'filter_content' );
			$front->filter( 'template_include', 'override_product_templates', 11 );
			$front->filter( 'woocommerce_checkout_fields', 'filter_checkout_fields' );

		endif;

		/**
		 * Widgets related hooks
		 *
		 * To add an action, use $settings->action()
		 * To apply a filter, use $settings->filter()
		 *
		 * @since 1.0
		 */
		$widgets = new Widgets( $this->plugin );
		$widgets->action( 'elementor/editor/after_enqueue_scripts', 'enqueue_scripts' );
		$widgets->action( 'elementor/element/after_section_end', 'add_control', 10, 3 );
		$widgets->action( 'elementor/frontend/section/before_render', 'form_start' );
		$widgets->action( 'elementor/frontend/section/after_render', 'form_close' );
		$widgets->filter( 'elementor/frontend/section/should_render', 'stop_render_checkout', 10, 2 );
		$widgets->action( 'init', 'order_received_permalink' );
		$widgets->action( 'wp', 'setcookie_pageid' );
		$widgets->action( 'elementor/documents/register', 'register_type' );
		$widgets->action( 'elementor/template-library/create_new_dialog_types', 'template_types', 10, 2 );
		$widgets->action( 'elementor/documents/register_controls', 'conditions_for_templates' );
		$widgets->action( 'save_post', 'save_template_meta' );
		$widgets->filter( 'single_template', 'load_canvas_template' );

		/**
		 * Theme_Support related hooks
		 *
		 * To add an action, use $settings->action()
		 * To apply a filter, use $settings->filter()
		 *
		 * @since 1.0
		 */
		$theme_support = new Theme_Support( $this->plugin );
	}

	/**
	 * Cloning is forbidden.
	 */
	private function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	// private function __wakeup() { }

	/**
	 * Instantiate the plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

Plugin::instance();