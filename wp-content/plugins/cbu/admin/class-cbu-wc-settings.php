<?php

/**
 * The settings functionality of the plugin.
 *
 * @link       https://www.linkedin.com/company/level6/about/
 * @since      1.0.0
 *
 * @package    Cbu
 * @subpackage Cbu/includes
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Cbu_WC_Settings' ) ) {

	/**
	 * The settings functionality of the plugin.
	 *
	 * Defines the plugin settings in Woocommerce setting page
	 * @since 1.0.0
	 *
	 * @since      1.0.0
	 * @package    Cbu
	 * @subpackage Cbu/admin
	 * @author     Level6 <it@level6.co>
	 */
	class Cbu_WC_Settings{

		/**
		 * Constructor
		 * @since  1.0
		 */
		public function __construct() {

			$this->id    = 'cbu';
			$this->label = __( 'Cart URL', 'cbu' );

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
				'' => __( 'Settings', 'cbu' ),
//				'url-generator' => __( 'URL generator', 'cbu' )
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
			$prefix = 'cbu_';

			$settings = array();

			switch ($current_section) {
				case 'url-generator':
					include 'partials/cbu-admin-display.php';
					break;
				default:
					include 'partials/cbu-settings-fields.php';
			}

			return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );
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
			$settings = $this->get_settings();

			WC_Admin_Settings::save_fields( $settings );
		}


	}

}

return new Cbu_WC_Settings();
