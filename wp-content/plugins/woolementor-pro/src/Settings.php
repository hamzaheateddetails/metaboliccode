<?php
/**
 * All settings related functions
 */
namespace codexpert\Woolementor_Pro;
use codexpert\product\Base;
use codexpert\product\Table;
use codexpert\product\License;

/**
 * @package Plugin
 * @subpackage Settings
 * @author codexpert <hello@codexpert.io>
 */
class Settings extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}

	public function license_form( $section ) {
		if( $section['id'] != 'woolementor_license' ) return;

		echo $this->plugin['license']->activator_form();
	}

	public function settings_fields( $args ) {
		unset( $args['sections']['woolementor_upgrade'] );
		
		$args['sections']['woolementor_license'] = array(
			'id'        => 'woolementor_license',
			'label'     => __( 'License', 'woolementor' ),
			'icon'      => 'dashicons-admin-network',
			'color'		=> '#34B6E9',
			'hide_form'	=> true,
			'fields'    => array(),
		);

		return $args;
	}
}