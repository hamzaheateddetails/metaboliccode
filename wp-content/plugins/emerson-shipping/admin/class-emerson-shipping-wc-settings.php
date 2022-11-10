<?php

/**
 * The settings functionality of the plugin.
 *
 * @link       https://www.linkedin.com/company/level6/about/
 * @since      1.0.0
 *
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/admin
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Emerson_Shipping_WC_Settings' ) ) {


	/**
	 * The settings functionality of the plugin.
	 *
	 * Defines the plugin settings in Woocommerce setting page
	 * @since 1.0.0
	 *
	 * @package    Emerson_Shipping
	 * @subpackage Emerson_Shipping/admin
	 * @author     Level6 <it@level6.co>
	 */
	class Emerson_Shipping_WC_Settings {

		/**
		 * Constructor
		 * @since  1.0
		 */
		public function __construct() {

			$this->id    = 'emerson-shipping';
			$this->label = __( 'Emerson Integration', 'emerson-shipping' );

			// Define all hooks instead of inheriting from parent
			add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );
			add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
			add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );

		}

		public function get_id(){
			return $this->id;
		}

		// Create Settings tab
		public function add_settings_page($tabs) {
			$tabs[ $this->id ] = $this->label;
			return $tabs;
		}

		public function output_sections() {
			global $current_section;

			$sections = $this->get_sections();

			if ( empty( $sections ) || 1 === sizeof( $sections ) ) {
				return;
			}

			echo '<ul class="subsubsub">';

			$array_keys = array_keys( $sections );

			foreach ( $sections as $id => $label ) {
				echo '<li><a href="' . admin_url( 'admin.php?page=wc-settings&tab=' . $this->id . '&section=' . sanitize_title( $id ) ) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end( $array_keys ) == $id ? '' : '|' ) . ' </li>';
			}

			echo '</ul><br class="clear" />';
		}

		/**
		 * Get sections.
		 *
		 * @return array
		 */
		public function get_sections() {
			$sections = array(
				'' => __( 'Settings', 'emerson-shipping' ),
//				'log' => __( 'Log', 'emerson-shipping' )
			);

			return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
		}

		/**
		 * Get settings array
		 *
		 * @return array
		 */
		public function get_settings() {

			global $current_section;
			$prefix = 'emerson-shipping_';

			$settings = array();

			switch ($current_section) {
				case 'log':
					$settings = array(
						array()
					);
					break;
				default:
					include 'partials/emerson-shipping-settings-fields.php';
			}

			return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );
		}

		public static function get_emerson_config(){
			return unserialize(WC_Admin_Settings::get_option('emerson_config'));
		}


		/**
		 * Output the settings
		 */
		public function output() {
			$settings = $this->get_settings();
			WC_Admin_Settings::output_fields( $settings );
		}

		/**
		 * Save settings
		 *
		 * @since 1.0
		 */
		public function save() {
			$settings =  array(
				array(
					'type' => 'text',
					'id'   => 'emerson_config'
				)
			);

			$data = $_POST;
			
			if ($data['password'] !== $this->get_emerson_config()['password'] && $data['password'] !== ''){
				$cryptor = new Cryptor(10, 6);
				$data['password'] = $cryptor->encrypt($data['password']);
			}
			$data['saveLogsEmerson'] = $data['saveLogsEmerson'] ==1 ? 'yes' : 'no';

			unset($data['save']);
			unset($data['_wpnonce']);
			unset($data['_wp_http_referer']);

			WC_Admin_Settings::save_fields( $settings, array(
				'emerson_config'=> serialize($data),
				'save'=> $_POST['save'],
				'_wpnonce'=> $_POST['_wpnonce'],
				'_wp_http_referer'=> $_POST['_wp_http_referer'],
			));
		}


	}

}

return new Emerson_Shipping_WC_Settings();
