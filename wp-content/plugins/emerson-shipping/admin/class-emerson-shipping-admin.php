<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Level 6
 * @since      1.0.0
 *
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/admin
 * @author     Level 6 <it@level6.co>
 */
class Emerson_Shipping_Admin {

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
	 * The requirement plugins for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $requirements    The list of requirements of this plugin
	 */
	private $requirements = array(
		'woocommerce2/woocommerce.php'=> array(
			'name'=> 'WooCommerce',
			'version' => '5.5.2',
		),
		'wc-shippin2g-packages/wc-shipping-packages.php'=> array(
			'name'=> 'Shipping Packages for WooCommerce',
			'version' => '1.1.18',
		),
	);

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
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-emerson-shipping-admin-utils.php';

		/**
		 * Emerson API services connection
		 */
		require_once plugin_dir_path(__FILE__) . '../includes/class-emerson-api.php';
		require_once plugin_dir_path(__FILE__) . '../includes/class-cryptor.php';
		
		require_once plugin_dir_path(__FILE__) . '/class-emerson-shipping-method.php';
		add_action('woocommerce_shipping_init', 'emerson_shipping_method');
		add_filter('woocommerce_shipping_methods', array($this, 'add_emerson_shipping_method'));
		require_once plugin_dir_path(__FILE__) . '../includes/class-emerson-order.php';

	}
	

	function add_emerson_shipping_method($methods)
	{
		$methods['emerson'] = 'Emerson_Shipping_Method'; // methods index must have the class id in order to appear in `Shipping methods` table
		return $methods;
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Emerson_Shipping_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Emerson_Shipping_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/emerson-shipping-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Emerson_Shipping_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Emerson_Shipping_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/emerson-shipping-admin.js', array( 'jquery' ), $this->version, false );

	}

	
	/**
	 * Load dependencies for additional WooCommerce settings
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function emerson_shipping_add_settings( $settings ) {
		$settings[] = include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-emerson-shipping-wc-settings.php';
		return $settings;
	}
}
