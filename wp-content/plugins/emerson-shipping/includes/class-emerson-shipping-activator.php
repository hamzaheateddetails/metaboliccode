<?php

/**
 * Fired during plugin activation
 *
 * @link       Level 6
 * @since      1.0.0
 *
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Emerson_Shipping
 * @subpackage Emerson_Shipping/includes
 * @author     Level 6 <it@level6.co>
 */
class Emerson_Shipping_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		wp_insert_term( 'Emerson', 'product_shipping_class', array(
			'slug' => 'emerson',
			'description'=> __('Emerson shipping class','emerson')
		) );

	}

}
