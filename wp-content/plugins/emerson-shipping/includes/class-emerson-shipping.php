<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       Level 6
 * @since      1.0.0
 *
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/includes
 * @author     Level 6 <it@level6.co>
 */
class Emerson_Shipping {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Emerson_Shipping_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The requirement plugins for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $requirements    The list of requirements of this plugin
	 */
	protected $requirements = array(
		'woocommerce/woocommerce.php'=> array(
			'name'=> 'WooCommerce',
			'version' => '5.5.2',
		),
		'wc-shipping-packages/wc-shipping-packages.php'=> array(
			'name'=> 'Shipping Packages for WooCommerce',
			'version' => '1.1.18',
		)
	);

	/**
	 * The cron process.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Orders_Review_Cron    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $cron_job;



	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'EMERSON_SHIPPING_VERSION' ) ) {
			$this->version = EMERSON_SHIPPING_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'emerson-shipping';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * check for the required plugins
	 * if one of the requirements is missing, then deactivate 
	 * 
	 * @since 1.0.0
	 */
	public function check_error_on_requirements(){

		$active_plugins=apply_filters('active_plugins', get_option('active_plugins'));
		
		$this->missing_plugins = array();
		foreach($this->requirements as $key => $info){
			if (!in_array($key, $active_plugins)){
				array_push($this->missing_plugins, $key);
			}
		}
		if (count($this->missing_plugins)!==0){
			deactivate_plugins('emerson-shipping/emerson-shipping.php');
			$this->show_admin_missing_plugins_error();
			return $this->missing_plugins;
		}

		return false;
	}


	function get_requirements(){
		return $this->get_requirements;
	}


	public function show_admin_missing_plugins_error(){
		?>
			<div class="error notice">
				<p>Emerson</p>
				<p><?php
					foreach( $this->missing_plugins as $plugin){
						echo sprintf( __('Missing or inactive plugin: %s', 'emerson' ),  $this->requirements[$plugin]['name']).'<br/>'; 
					}
				?></p>
			</div>
		<?php
	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Emerson_Shipping_Loader. Orchestrates the hooks of the plugin.
	 * - Emerson_Shipping_i18n. Defines internationalization functionality.
	 * - Emerson_Shipping_Admin. Defines all hooks for the admin area.
	 * - Emerson_Shipping_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Util for auto deactivation 
		 */
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-emerson-shipping-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-emerson-shipping-i18n.php';
		
		/**
		 * The class responsible for processing url params
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-emerson-url.php';
		/**
		 * The class responsible for creating rest api endpoints
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-emerson-rest-api.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-emerson-shipping-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-emerson-shipping-public.php';

		/**
		 * The class responsible for cron.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-orders-review-cron.php';

		$this->loader = new Emerson_Shipping_Loader();
		$this->cron_job = new Orders_Review_Cron();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Emerson_Shipping_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Emerson_Shipping_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Emerson_Shipping_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Add plugin settings to WooCommerce
		$this->loader->add_filter( 'woocommerce_get_settings_pages', $plugin_admin, 'emerson_shipping_add_settings' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Emerson_Shipping_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Emerson_Shipping_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
