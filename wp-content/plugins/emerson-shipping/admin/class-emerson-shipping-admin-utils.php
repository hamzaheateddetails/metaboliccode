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

if ( ! class_exists( 'Emerson_Shipping_Admin_Utils' ) ) {

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
	class Emerson_Shipping_Admin_Utils
	{
		/**
		 * Initialize the class and set its properties.
		 *
		 * @since    1.0.0
		 */
		public function __construct()
		{
			
		}

	}
}

return new Emerson_Shipping_Admin_Utils();
