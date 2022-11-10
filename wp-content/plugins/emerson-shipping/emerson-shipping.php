<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Level 6
 * @since             1.0.0
 * @package           Emerson_Shipping
 *
 * @wordpress-plugin
 * Plugin Name:       Emerson-Integration
 * Plugin URI:        Level 6
 * Description:       This plugin was tested with the Emerson API version 4.3 
 * Version:           1.0.1
 * Author:            Level 6
 * Author URI:        Level 6
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       emerson-shipping
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('EMERSON_SHIPPING_VERSION', '1.0.1');

/**
 * Defining emerson config name for usage
 * in multiple class
 */
define('EMERSON_CONFIG_NAME', 'emerson_config');



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-emerson-shipping-activator.php
 */
function activate_emerson_shipping()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-emerson-shipping-activator.php';
	Emerson_Shipping_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-emerson-shipping-deactivator.php
 */
function deactivate_emerson_shipping()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-emerson-shipping-deactivator.php';
	Emerson_Shipping_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_emerson_shipping');
register_deactivation_hook(__FILE__, 'deactivate_emerson_shipping');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-emerson-shipping.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_emerson_shipping()
{

	$plugin = new Emerson_Shipping();
	$missing_requirements=$plugin->check_error_on_requirements();
	if ($missing_requirements!=false){
		add_action('admin_init', 'deactivate_emerson_shipping');
		return;
	}
	$plugin->run();
}
run_emerson_shipping();

