<?php
/**
 * All admin facing functions
 */
namespace codexpert\Woolementor_Pro;
use codexpert\product\Base;
use codexpert\product\Metabox;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Admin
 * @author codexpert <hello@codexpert.io>
 */
class Admin extends Base {

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

	/**
	 * Internationalization
	 */
	public function i18n() {
		load_plugin_textdomain( 'woolementor-pro', false, WOOLEMENTOR_PRO_DIR . '/languages/' );
	}

	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {

		// Are we in debug mode?
		$min = defined( 'WOOLEMENTOR_DEBUG' ) && WOOLEMENTOR_DEBUG ? '' : '.min';

		wp_enqueue_style( "select2", 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css' );
		wp_enqueue_style( "{$this->slug}", plugins_url( "/assets/css/style{$min}.css", WOOLEMENTOR_PRO ), $this->version, 'all' );

		wp_enqueue_script( "select2", 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', ['jquery'] );
		wp_enqueue_script( "{$this->slug}", plugins_url( "/assets/js/admin{$min}.js", WOOLEMENTOR_PRO ), ['jquery'], $this->version, true );
	}

	public function widget_links( $links ) {
		unset( $links['gopro'] );

		return $links;
	}

	public function action_links( $links ) {
		$links['settings'] = '<a href="' . add_query_arg( 'page', 'woolementor', admin_url( 'admin.php' ) ) . '">' . __( 'Settings', 'woolementor-pro' ) . '</a>';

		return $links;
	}

	public function plugin_row_meta( $plugin_meta, $plugin_file ) {
		
		if ( $this->plugin['basename'] === $plugin_file ) {
			// $plugin_meta['check'] = '<a href="' . add_query_arg( 'cx-recheck', $this->slug, admin_url( 'plugins.php' ) ) . '">' . __( 'Check for update', 'woolementor-pro' ) . '</a>';
			$plugin_meta['help'] = '<a href="https://help.codexpert.io/" target="_blank" class="wl-plugins-help">' . __( 'Premium Support', 'woolementor-pro' ) . '</a>';
		}

		return $plugin_meta;
	}

	public function billing_extra_fields_meta( $order ) { 
		$meta_datas = $order->get_meta_data();

		$metas = [];

		if( is_array( $meta_datas ) && count( $meta_datas ) > 0 ) {
			foreach ( $meta_datas as $meta_data ) {
				$metas[ $meta_data->get_data()['key'] ] = $meta_data->get_data()['value'];
			}
		}

		$fields = get_option( '_woolementor_checkout_fields', true );
		$billing_metas = $fields['billing'];

		$billing_html = '';

		if( is_array( $billing_metas ) && count( $billing_metas ) > 0 ) {
			foreach ( $billing_metas as $billing_meta ) {
				$key 	= $billing_meta['billing_input_name'];
				$meta 	= $billing_meta['billing_input_label'];
				if ( array_key_exists( $key, $metas ) ) {
					$billing_html 	.= "<p class='wl-billing-extra-meta'><strong>{$meta}: </strong><span>{$metas[ $key ]}</span></p>";

				}
			}
		}

		if( $billing_html != '' ):
	    ?>
	    <div class="wl-billing-extra-metas">
    		<h3><?php _e( 'Billing Extra Fields', 'woolementor-pro' ) ?></h3>
			<?php echo $billing_html; ?>
	    </div>
	    <?php endif;
	}

	public function shipping_extra_fields_meta( $order ) {
		$meta_datas = $order->get_meta_data();

		$metas = [];

		if( is_array( $meta_datas ) && count( $meta_datas ) > 0 ) {
			foreach ( $meta_datas as $meta_data ) {
				$metas[ $meta_data->get_data()['key'] ] = $meta_data->get_data()['value'];
			}
		}

		$fields 			= get_option( '_woolementor_checkout_fields', true );
		$shipping_metas 	= $fields['shipping'];
		$order_notes_metas 	= $fields['order'];
		$shipping_html 		= $order_notes_html = '';
		
		if( is_array( $shipping_metas ) && count( $shipping_metas ) > 0 ) {
			foreach ( $shipping_metas as $shipping_meta ) {
				$key 	= $shipping_meta['shipping_input_name'];
				$meta 	= $shipping_meta['shipping_input_label'];
				if ( array_key_exists( $key, $metas ) ) {

					$shipping_html 	.= "<p class='wl-shipping-extra-meta'><strong>{$meta}: </strong><span>{$metas[ $key ]}</span></p>";
				}
			}
		}

		if( is_array( $order_notes_metas ) && count( $order_notes_metas ) > 0 ) {
			foreach ( $order_notes_metas as $order_notes_meta ) {
				$key 	= $order_notes_meta['order_input_name'];
				$meta 	= $order_notes_meta['order_input_label'];
				if ( array_key_exists( $key, $metas ) ) {
					$order_notes_html .= "<p class='wl-order-comments-meta'><strong>{$meta}: </strong><span>{$metas[ $key ]}</span></p>";
				}
			}
		}
	    
	    if( $shipping_html != '' ): ?>
   	    <div class="wl-shipping-extra-metas">
       		<h3><?php _e( 'Shipping Extra Fields', 'woolementor-pro' ) ?></h3>
   			<?php echo $shipping_html; ?>
   	    </div>
   		<?php endif; ?>

   		<?php if( $order_notes_html != '' || $order->get_customer_note() != '' ): ?>
   	    <div class="wl-order-comments-metas">
       		<h3><?php _e( 'Customer provided note:', 'woolementor-pro' ) ?></h3>
       		<p><?php echo $order->get_customer_note(); ?></p>
   			<?php  echo $order_notes_html; ?>
   	    </div>
	    <?php endif;

	}
	public function supports_payment_form( $supports, $features, $ins  )	{
		if( $features == 'payment_form' && woolementor_is_edit_mode() ) {
			return false;
		}

		return $supports;
	}

	public function conditions_for_templates()	{
		?>
			<div class="wl-templates-conditions">
				<?php echo woolementor_pro_get_template( 'template-conditions' ) ?>
			</div>
		<?php
	}

	public function save_template_data( $post_id ){

		if ( isset( $_GET['wl_template_conditions'] ) ) {
			foreach ( $_GET['wl_template_conditions'] as $key => $value ) {
				update_post_meta( $post_id, 'wl_'.$key, $value );
			}

			update_option( 'wl_template_conditions', $_GET['wl_template_conditions'] );
		}
	}

	public function pseudo_page_ids( $posts )	{
		$posts['home'] = __( 'Home', 'woolementor-pro' );

		return $posts;
	}
}