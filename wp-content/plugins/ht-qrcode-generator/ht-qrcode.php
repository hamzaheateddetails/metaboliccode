<?php
/**
 * Plugin Name: HT QR Code Generator
 * Description: The HT QR Code Generator is for WordPress plugin you can generate wide custom and automatic site page URL QR code generator and use them for Elementor, widgets, and Shortcodes.
 * Plugin URI:  https://codecanyon.net/item/ht-qr-code-generator-for-wordpress/25515123
 * Author:      codecarnival
 * Author URI:  https://hasthemes.com/
 * Version:     2.1.2
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ht-qrcode
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

define( 'HTQRCODE_VERSION', '2.1.2' );
define( 'HTQRCODE_PL_ROOT', __FILE__ );
define( 'HTQRCODE_PL_URL', plugins_url( '/', HTQRCODE_PL_ROOT ) );
define( 'HTQRCODE_PL_PATH', plugin_dir_path( HTQRCODE_PL_ROOT ) );
define( 'HTQRCODE_PL_INCLUDE', HTQRCODE_PL_PATH .'include/' );
// Required File
include( HTQRCODE_PL_INCLUDE.'/class.htqrcode.php' );
HTQRcode_Addons_Elementor::instance();