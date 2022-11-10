<?php
/**
 * Plugin Name: HT Image Marker for Elementor
 * Description: The HT Image Marker is for WordPress.
 * Plugin URI:  https://htplugins.com/
 * Author:      codecarnival
 * Author URI:  https://hasthemes.com/
 * Version:     1.0.0
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: htimg-marker
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

define( 'HTMARKER_VERSION', '1.0.0' );
define( 'HTMARKER_PL_ROOT', __FILE__ );
define( 'HTMARKER_PL_URL', plugins_url( '/', HTMARKER_PL_ROOT ) );
define( 'HTMARKER_PL_PATH', plugin_dir_path( HTMARKER_PL_ROOT ) );
define( 'HTMARKER_PL_INCLUDE', HTMARKER_PL_PATH .'include/' );

// Required File
include( HTMARKER_PL_INCLUDE.'/class.htmarker.php' );