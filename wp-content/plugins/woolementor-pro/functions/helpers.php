<?php
if( !function_exists( 'get_plugin_data' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if( ! function_exists( 'woolementor_pro_pri' ) ) :
function woolementor_pro_pri( $data ) {
	echo '<pre>';
	if( is_object( $data ) || is_array( $data ) ) {
		print_r( $data );
	}
	else {
		var_dump( $data );
	}
	echo '</pre>';
}
endif;

if( ! function_exists( 'woolementor_pro_get_posts' ) ) :
function woolementor_pro_get_posts( $post_type = 'post', $limit = -1 ) {

	$posts = [ '' => sprintf( __( '- Choose a %s -', 'woolementor-pro' ), $post_type ) ];

	global $wpdb;
	$query = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `{$wpdb->posts}` WHERE `post_type` = '%s' AND `post_status` = 'publish'", $post_type ) );

	foreach( $query as $post ) :
		$posts[ $post->ID ] = $post->post_title;
	endforeach;

	return apply_filters( 'woolementor_pro_get_posts', $posts, $post_type, $limit );
}
endif;


if( ! function_exists( 'woolementor_pro_get_option' ) ) :
function woolementor_pro_get_option( $key, $section, $default = '' ) {

	$options = get_option( $key );

	if ( isset( $options[ $section ] ) ) {
		return $options[ $section ];
	}

	return $default;
}
endif;

if( !function_exists( 'woolementor_pro_get_template' ) ) :
/**
 * Includes a template file resides in /views diretory
 *
 * It'll look into /woolementor-pro directory of your active theme
 * first. if not found, default template will be used.
 * can be overriden with woolementor-pro_template_override_dir hook
 *
 * @param string $slug slug of template. Ex: template-slug.php
 * @param string $sub_dir sub-directory under base directory
 * @param array $fields fields of the form
 */
function woolementor_pro_get_template( $slug, $base = 'views', $args = null ) {

	// templates can be placed in this directory
	$override_template_dir = apply_filters( 'woolementor_pro_template_override_dir', get_stylesheet_directory() . '/woolementor-pro/', $slug, $base, $args );
	
	// default template directory
	$plugin_template_dir = dirname( WOOLEMENTOR_PRO ) . "/{$base}/";

	// full path of a template file in plugin directory
	$plugin_template_path =  $plugin_template_dir . $slug . '.php';
	
	// full path of a template file in override directory
	$override_template_path =  $override_template_dir . $slug . '.php';

	// if template is found in override directory
	if( file_exists( $override_template_path ) ) {
		ob_start();
		include $override_template_path;
		return ob_get_clean();
	}
	// otherwise use default one
	elseif ( file_exists( $plugin_template_path ) ) {
		ob_start();
		include $plugin_template_path;
		return ob_get_clean();
	}
	else {
		return __( 'Template not found!', 'woolementor-pro' );
	}
}
endif;

/**
 * Generates some action links of a plugin
 *
 * @since 1.0
 */
if( !function_exists( 'woolementor_pro_action_link' ) ) :
function woolementor_pro_action_link( $plugin, $action = '' ) {

	$exploded	= explode( '/', $plugin );
	$slug		= $exploded[0];

	$links = [
		'install'		=> wp_nonce_url( admin_url( "update.php?action=install-plugin&plugin={$slug}" ), "install-plugin_{$slug}" ),
		'update'		=> wp_nonce_url( admin_url( "update.php?action=upgrade-plugin&plugin={$plugin}" ), "upgrade-plugin_{$plugin}" ),
		'activate'		=> wp_nonce_url( admin_url( "plugins.php?action=activate&plugin={$plugin}&plugin_status=all&paged=1&s" ), "activate-plugin_{$plugin}" ),
		'deactivate'	=> wp_nonce_url( admin_url( "plugins.php?action=deactivate&plugin={$plugin}&plugin_status=all&paged=1&s" ), "deactivate-plugin_{$plugin}" ),
	];

	if( $action != '' && array_key_exists( $action, $links ) ) return $links[ $action ];

	return $links;
}
endif;

if( !function_exists( 'woolementor_pro_license_activated' ) ) :
function woolementor_pro_license_activated() {
	$_plugin				= get_plugin_data( WOOLEMENTOR_PRO );
	$_plugin['file']		= WOOLEMENTOR_PRO;
	$_plugin['basename']	= plugin_basename( WOOLEMENTOR_PRO );
	$_plugin['server']		= apply_filters( 'woolementor-pro_server', 'https://my.codexpert.io' );
	$_plugin['item_id']		= 8088;
	$_plugin['updatable']	= true;
	$_plugin['license_page']= admin_url( 'admin.php?page=woolementor' );
	
	$plugin = new \pluggable\product\License( $_plugin );
	return $plugin->_is_active();
}
endif;

if( !function_exists( 'woolementor_pro_action_link' ) ) :
function woolementor_pro_action_link( $plugin, $action = '' ) {

	$exploded	= explode( '/', $plugin );
	$slug		= $exploded[0];

	$links = [
		'install'		=> wp_nonce_url( admin_url( "update.php?action=install-plugin&plugin={$slug}" ), "install-plugin_{$slug}" ),
		'update'		=> wp_nonce_url( admin_url( "update.php?action=upgrade-plugin&plugin={$plugin}" ), "upgrade-plugin_{$plugin}" ),
		'activate'		=> wp_nonce_url( admin_url( "plugins.php?action=activate&plugin={$plugin}&plugin_status=all&paged=1&s" ), "activate-plugin_{$plugin}" ),
		'deactivate'	=> wp_nonce_url( admin_url( "plugins.php?action=deactivate&plugin={$plugin}&plugin_status=all&paged=1&s" ), "deactivate-plugin_{$plugin}" ),
	];

	if( $action != '' && array_key_exists( $action, $links ) ) return $links[ $action ];

	return $links;
}
endif;

if( !function_exists( 'get_archive_template_id' ) ) :
function get_archive_template_id( $template_type ){

	$object = get_queried_object();

	if ( is_null( $object ) && ( !is_home() || !is_front_page() ) ) return;
	
	if ( is_home() || is_front_page() ) {
		$id 	= 'home';
		$screen = 'page';
	}
	elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		$id 	= wc_get_page_id( 'shop' );
		$screen = 'page';
	}
	elseif ( is_tax() ) {
		$id 	= $object->term_id;
		$screen = 'tax';
	}
	elseif ( is_singular() ) {
		$screen = $object->post_type;
		$id 	= $object->ID;
	}
	else{
		$id 	= $object->ID;
		$screen = $object->post_type;
	}


	$args = [  
	    'post_type' 	 	=> 'elementor_library',
	    'post_status' 	 	=> 'publish',
	    'posts_per_page' 	=> 1, 
	    'orderby'     		=> 'modified',
	    'order' 		 	=> 'DESC',
	    'meta_query' 	 	=> [
	    	'relation' 	 	=> 'AND',
			[
				'key' 		=> '_elementor_template_type',
				'value' 	=> $template_type,
			],
	    	[
	    		'relation' 	=> 'or',
	    		[
	        	    'key'		=> "wl_{$screen}_includes",
	        	    'value'		=> '"' . $id . '"',
	        	    'compare'	=> 'LIKE'
	        	],
	    		[
	        	    'key'		=> "wl_{$screen}_includes",
	        	    'value'		=> '"0"',
	        	    'compare'	=> 'LIKE'
	        	],
	    	]
	    ]
	];
	
	$result 	= new \WP_Query( $args ); 
	$template 	= $result->post;

	if ( empty( $template ) ) return;

	return $template->ID;
}
endif;

if( !function_exists( 'get_tab_template' ) ) :
function get_tab_template(){

	$args = [  
	    'post_type' 	 => 'elementor_library',
	    'post_status' 	 => 'publish',
	    'posts_per_page' => -1, 
	    'order' 		 => 'DESC',
	    'meta_query' 	 => [
	    	'relation' 	 => 'AND',
			[
				'key' 		=> '_elementor_template_type',
				'value' 	=> 'wl-tab',
			]
	    ]
	];

	$result = new \WP_Query( $args ); 
	$_tabs 	= $result->posts;

	$tabs = [];
	foreach ( $_tabs as $tab ) {
        $tabs[ $tab->ID ] = $tab->post_title;
    }   

    return $tabs;
}
endif;

if( !function_exists( 'is_order_pay_page' ) ):
	function is_order_pay_page(){
		global $wp;
		$is_order_pay_page = ( !empty( $wp->query_vars['order-pay'] ) || isset( $_GET['pay_for_order'], $_GET['key'] ) );

		return $is_order_pay_page == 1 ? $is_order_pay_page : 0;
	}
endif;

if( !function_exists( 'wl_woocommerce_checkout_payment' ) ):
	function wl_woocommerce_checkout_payment() {
		echo woolementor_pro_get_template( 'review-order-2', 'widgets/order-review/template-parts' );
	}
endif;