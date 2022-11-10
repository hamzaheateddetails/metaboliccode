<?php
/**
 * All archive facing functions
 */

namespace codexpert\Woolementor_Pro\Templates;
use \Elementor\Modules\Library\Documents\Library_Document;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Archive extends Library_Document {

	public static function get_properties() {
		$properties = parent::get_properties();

		$properties['support_kit'] = true;

		return $properties;
	}

	/**
	 * Get document name.
	 *
	 * Retrieve the document name.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return string Document name.
	 */
	public function get_name() {
		return 'wl-archive';
	}

	/**
	 * Get document title.
	 *
	 * Retrieve the document title.
	 *
	 * @since 1.3.0
	 * @access public
	 * @static
	 *
	 * @return string Document title.
	 */
	public static function get_title() {
		return __( 'WL Product Archive', 'woolementor-pro' );
	}
}
