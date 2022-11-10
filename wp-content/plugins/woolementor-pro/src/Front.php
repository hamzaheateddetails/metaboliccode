<?php
/**
 * All public facing functions
 */
namespace codexpert\Woolementor_Pro;
use codexpert\product\Base;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author codexpert <hello@codexpert.io>
 */
class Front extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
		$this->license	= $this->plugin['license'];
		$this->assets 	= WOOLEMENTOR_PRO_ASSETS;
	}
	
	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		// define localized scripts
		$localized = array(
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'_nonce'		=> wp_create_nonce( $this->slug ),
		);

		wp_localize_script( $this->slug, 'WOOLEMENTOR', apply_filters( "{$this->slug}-localized", $localized ) );
	}

	/**
	 * Add some script to head
	 *
	 * @since 1.0
	 */
	public function head() {

		// WC -> EDD license migration
		if ( get_option( 'woolementor-pro-woolementor-pro-php' ) != '' ) {
			
			// set the key temporarily
			update_option( $this->license->get_license_key_name(), get_option( 'woolementor-pro-woolementor-pro-php' ) );

			// actual activation
			$this->license->do( 'activate', get_option( 'woolementor-pro-woolementor-pro-php' ), 'Woolementor Pro' );

			delete_option( 'woolementor-pro-woolementor-pro-php' );
		}
	}

	public function filter_content( $content ) {

		if ( 'elementor_canvas' !== get_page_template_slug() ) {
			return $content;
		}

		$header = $footer = '';

		$template_id = get_archive_template_id( 'wl-header' );
		if ( !is_null( $template_id ) ) {
			$elementor_instance = \Elementor\Plugin::instance();
			$header = $elementor_instance->frontend->get_builder_content_for_display( $template_id );
		}

		$template_id = get_archive_template_id( 'wl-footer' );
		if ( !is_null( $template_id ) ) {
			$elementor_instance = \Elementor\Plugin::instance();
			$footer = $elementor_instance->frontend->get_builder_content_for_display( $template_id );
		}

		return $header . $content . $footer;
	}

	public function override_loader_files( $templates, $template ) {
		$basename 		= basename( $template );
		$template_type 	= $basename == 'single-product.php' ? 'wl-single' : 'wl-archive';
		$template_id 	= get_archive_template_id( $template_type );
		if ( !is_null( $template_id ) ) {	
	    	wp_cache_set( "woolementor-template_{$basename}", $template );
		}
	    return $templates;
	}

	public function override_product_templates( $template ) {

		$object = get_queried_object();
		
		if ( is_null( $object ) && ( !is_home() || !is_front_page() ) ) return $template;

		if ( is_home() || is_front_page() ) {
			$screen = 'page';
		}
		elseif ( function_exists( 'is_shop' ) && is_shop() ) {
			$screen = 'page';
		}
		elseif ( is_tax() ) {
			$screen = 'tax';
		}
		elseif ( is_singular() ) {
			$screen = $object->post_type;
		}
		else{
			$screen = $object->post_type;
		}

		$basename 		= basename( $template );
		$template_type  = $basename == 'single-product.php' ? 'wl-single' : 'wl-archive';
		$template_id 	= get_archive_template_id( $template_type );

		$template_meta 	= get_post_meta( $template_id, "wl_{$screen}_includes", true );

		if( !is_array( $template_meta ) || count( $template_meta ) <= 0 ) return $template;

		if ( is_shop() || is_tax() ) {
			return trailingslashit( WOOLEMENTOR_PRO_DIR ) . "views/templates/archive.php";
		}
		elseif ( is_singular() ) {
			return trailingslashit( WOOLEMENTOR_PRO_DIR ) . "views/templates/single-product.php";
		}
	}

	public function filter_checkout_fields( $fields ) {

		if ( woolementor_is_edit_mode() || woolementor_is_preview_mode() ) return $fields;

		$_wl_fields = get_option( '_woolementor_checkout_fields', [] );

		if( count( $_wl_fields ) <= 0 ) return $fields;

		$wl_ids 		 = [];
		$checkout_fields = [];
		foreach ( $_wl_fields as $section => $checkout_section_fields ) {
			if ( in_array( $section, [ 'billing', 'shipping', 'order' ] ) ) {
				foreach( $checkout_section_fields as $item ) {	
					$wl_ids[] = $item[ "{$section}_input_name" ];
					$checkout_fields[$section][ sanitize_text_field( $item["{$section}_input_name"] ) ] = 
				        [
				            'label'			=> sanitize_text_field( $item["{$section}_input_label"] ),
				            'type'			=> $item["{$section}_input_type"],
				            'required'		=> $item["{$section}_input_required"] == 'true' ? true : false,
				            'class'			=> is_array( $item["{$section}_input_class"] ) ? $item["{$section}_input_class"] : explode( ' ', $item["{$section}_input_class"] ),
				            'autocomplete'	=> sanitize_text_field( $item["{$section}_input_autocomplete"] ), 
				            'placeholder'	=> sanitize_text_field( $item["{$section}_input_placeholder"] ),
				            'priority'		=> 10,
				        ];
				}
			}
		}

		$fields = $checkout_fields + $fields;		

		foreach ( $fields as $section => $section_fields ) {
			foreach ( $section_fields as $key => $value ) {
				if ( !in_array( $key, $wl_ids ) ) {
					unset( $fields[ $section ][ $key ] );
				}
			
			}
		}

		return $fields;
	}
	
	public function wishlist_button(){
		global $product;
		if( is_null( $product ) ) return;
		$user_id  	 = get_current_user_id();
		$wishlist 	 = woolementor_get_wishlist( $user_id );
		$fav_product = in_array( $product->get_ID(), $wishlist );

		if ( !empty( $fav_product ) ) {
		    $fav_item = 'fav-item';
		}
		else{
		    $fav_item = '';
		}
		if( !apply_filters( 'woolementor-pro_default_wishlist_icon', true, $product ) ) return;

		$title = __( "Add to Wishlist", "woolementor-pro" );
		echo '<button class="ajax_add_to_wish wl-wish-button button ' . $fav_item . '" type="button" title="' . $title . '" data-product_id="' . $product->get_ID() . '">
                <i aria-hidden="true" class="fas fa-heart"></i>
            </button>';
	}
		
}