<?php
/**
* WooCommerce Cart Share & Save
*
* @author      WeCreativez
* @copyright   2019 WeCreativez
* @license     GPL-2.0-or-later
*
* @wordpress-plugin
* Plugin Name: WooCommerce Cart Share & Save
* Plugin URI:  https://codecanyon.net/item/woocommerce-cart-share-and-save/21364305/
* Description: WooCommerce cart share and save extends the possibilities of WooCommerce by offering function where user can share and save cart and retrieve it any time. WooCommerce cart share and save will definitely increase your sales and promotions.
* Version:     1.7.7.1
* Author:      WeCreativez
* Author URI:  https://wecreativez.com
* Text Domain: woo-cart-share
* Domain Path: /languages/
* License:     GPL v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/ 

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Plugin file
define( 'WCSS_PLUGIN_FILE', __FILE__ );
// Plugin absolute path
define( 'WCSS_PLUGIN_PATH', plugin_dir_path( WCSS_PLUGIN_FILE ) );
// Plugin URL
define( 'WCSS_PLUGIN_URL', plugin_dir_url( WCSS_PLUGIN_FILE ) );
// Plugin current version
define( 'WCSS_PLUGIN_VER', '1.7.7.1' );

/**
 * Plugin installation.
 */
function wcss_plugin_install() {
    // Run migration first
    require_once WCSS_PLUGIN_PATH . 'includes/deprecated/class-wcss-migration.php';
    
    require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-install.php';
    WCSS_Install::install();
}
register_activation_hook( WCSS_PLUGIN_FILE, 'wcss_plugin_install' );

/**
* Plugin deactivation Hook function
*/
function wcss_plugin_deactivation() {
    require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-deactivate.php';
    WCSS_Deactivate::deactivate();
}
register_deactivation_hook( WCSS_PLUGIN_FILE, 'wcss_plugin_deactivation' );

/**
 * Plugin init.
 */
function wcss_init() {
    // Init plugin files if WooCommerce activate.
    if ( class_exists( 'WooCommerce' ) ) {
        require_once WCSS_PLUGIN_PATH . 'includes/class-wcss-init.php';
        $wcss = new WCSS_Init;
        $wcss->init();
    } else {
        require_once WCSS_PLUGIN_PATH . 'includes/admin/class-wcss-admin-no-woocommerce.php';
    }
}
add_action( 'plugins_loaded', 'wcss_init', 20 );