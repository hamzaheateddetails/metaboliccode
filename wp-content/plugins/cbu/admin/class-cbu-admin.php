<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/company/level6/about/
 * @since      1.0.0
 *
 * @package    Cbu
 * @subpackage Cbu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cbu
 * @subpackage Cbu/admin
 * @author     Level6 <it@level6.co>
 */
class Cbu_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Load dependencies for add Plugin WooCommerce settings
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function add_settings( $settings ) {
		$settings[] = include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cbu-wc-settings.php';
		return $settings;
	}

}
