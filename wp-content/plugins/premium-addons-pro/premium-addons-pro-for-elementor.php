<?php
/*
Plugin Name: Premium Addons PRO
Description: Premium Addons PRO Plugin Includes 36+ premium widgets & addons for Elementor Page Builder.
Plugin URI: https://premiumaddons.com
Version: 2.8.12
Author: Leap13
Elementor tested up to: 3.7.8
Elementor Pro tested up to: 3.7.7
Author URI: https://leap13.com/
Text Domain: premium-addons-pro
Domain Path: /languages
*/

/**
 * Checking if WordPress is installed
 */
if ( ! function_exists( 'add_action' ) ) {
	die( 'WordPress not Installed' ); // if WordPress not installed kill the page.
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No access of directly access.
}

define( 'PREMIUM_PRO_ADDONS_VERSION', '2.8.12' );
define( 'PREMIUM_PRO_ADDONS_STABLE_VERSION', '2.8.11' );
define( 'PREMIUM_PRO_ADDONS_URL', plugins_url( '/', __FILE__ ) );
define( 'PREMIUM_PRO_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'PREMIUM_PRO_ADDONS_FILE', __FILE__ );
define( 'PREMIUM_PRO_ADDONS_BASENAME', plugin_basename( PREMIUM_PRO_ADDONS_FILE ) );
define( 'PAPRO_ITEM_NAME', 'Premium Addons PRO' );
define( 'PAPRO_STORE_URL', 'http://my.leap13.com' );
define( 'PAPRO_ITEM_ID', 361 );

// If both versions are updated, run all dependencies.
update_option( 'papro_updated', 'true' );

/*
 * Load plugin core file.
 */
require_once PREMIUM_PRO_ADDONS_PATH . 'includes/class-papro-core.php';
