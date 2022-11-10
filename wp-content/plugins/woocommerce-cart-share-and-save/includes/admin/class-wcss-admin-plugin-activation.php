<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class WCSS_Admin_Plugin_Activation {

    public $plugin_prefix;

    public $plugin_id;

    public $activation_redirection;

    private $activation_form;

    private $deactivation_form;

    private $message;

    private $response;

    public $args;

    public function __construct( $activation_option_key, $args = array() ) {
        $this->args                     = $args;
        $this->activation_form          = $args['activation_form'];
        $this->deactivation_form        = $args['deactivation_form'];
        $this->activation_redirection   = $args['activation_redirection'];
        $this->plugin_id                = $args['plugin_id'];
        $this->activation_option_key    = $activation_option_key;
        $this->plugin_prefix            = $args['plugin_prefix'];

        add_action( 'admin_init', array( $this, 'activate_plugin' ) );
        add_action( 'admin_init', array( $this, 'deactivate_plugin' ) );

        add_action( "{$this->args['plugin_prefix']}_plugin_activation_form", array( $this, 'output' ) );
    }


    public function activate_plugin() {
        if ( ! isset( $_POST["{$this->plugin_prefix}_plugin_activation_submit"] ) ) {
            return;
        }

        $purchase_code = trim( $_POST['purchase_code'] );
        $site_url      = home_url();
        $plugin_id     = $this->plugin_id;

        // Activation URL
        $activation_url = add_query_arg( array(
            'cp_plugin_activate'    => $purchase_code,
            'cp_plugin_id'          => $plugin_id,
            'cp_site_url'           => $site_url,
            'uniqid'                => uniqid(),
        ), 'http://envato.wecreativez.com/codecanyon/' );
                
        // Make the GET request
        $response = wp_remote_get( $activation_url, array(
            'timeout'     => 20,
            'httpversion' => '1.1',
        ) );
            
        // Check if response is valid
        if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ) {
            
            $this->response = json_decode( wp_remote_retrieve_body( $response ) );

            switch ( $this->response->code ) {
                case 200:
                    update_option( $this->activation_option_key, $purchase_code);
                    wp_safe_redirect( esc_url( $this->activation_redirection ) );
                    break;
                
                default:
                    $this->message = sprintf( esc_html( 'Error Code: %s - %s' ), $this->response->code, $this->response->message );
                    break;
            }
        } else {
            $this->message = esc_html( 'Server error. Please contact us.', 'woo-cart-share' );
        }

    }
    
    public function deactivate_plugin() {
        if ( ! is_admin() ) {
            return;
        }
        if ( ! isset( $_POST["{$this->plugin_prefix}_plugin_deactivate_submit"] ) ) {
            return;
        }

        $purchase_code = trim( $_POST['purchase_code'] );
        $plugin_id     = $this->plugin_id;
        $site_url      = home_url();

        // Deactivation URL
        $deactivation_url = add_query_arg( array(
            'cp_plugin_deactivate'  => $purchase_code,
            'cp_plugin_id'          => $plugin_id,
            'cp_site_url'           => $site_url,
            'uniqid'                => uniqid(),
        ), 'http://envato.wecreativez.com/codecanyon/' );
                
        // Make the GET request
        $response = wp_remote_get( $deactivation_url, array(
            'timeout'     => 20,
            'httpversion' => '1.1',
        ) );

        delete_option( $this->activation_option_key );

        wp_safe_redirect( esc_url( $this->activation_redirection ) );
        exit;
    }

    public function output() {
        echo "<div class='{$this->plugin_prefix}-plugin-activation-form'>";
        echo "<h2>" . esc_html( $this->args['title'] ) . "</h2>";
        echo "<p>" . esc_html( $this->args['description'] ) . "</p>";

        if ( ! get_option( $this->activation_option_key ) ) {
            $this->activation_form();
        } else {
            $this->deactivation_form();
        }

        if ( isset( $this->args['links'] ) ) {
            echo "<p>";
            foreach ( $this->args['links'] as $link ) {
                echo sprintf( '<a href="%s" target="_blank">%s</a> &#183; ', esc_url( $link['link'] ), esc_html( $link['text'] ) );
            }   
            echo "</p>";
        }

        if ( $this->message ) {
            echo '<p style="font-weight: bold; border: 1px dashed #aaa; padding: 10px; background: #fff;">' . $this->message . '</p>';
        }
        echo "</div>";
    }

    public function activation_form() {
        ?>
            <form action="#" method="post">
                <input 
                    type="text" 
                    class="regular-text" 
                    name="purchase_code"
                    placeholder="<?php echo esc_attr( $this->activation_form['placeholder'] ); ?>" 
                    value="<?php echo esc_attr( get_option( $this->activation_option_key ) ) ?>"
                    required>
                <input 
                    type="submit" 
                    class="button button-primary"
                    name="<?php echo esc_attr( $this->plugin_prefix . '_plugin_activation_submit' ); ?>"
                    value="<?php echo esc_attr( $this->activation_form['button_text'] ); ?>">
            </form>
        <?php
    }
    
    public function deactivation_form() {
        ?>
            <form action="#" method="post">
                <input 
                    type="text" 
                    class="regular-text" 
                    name="purchase_code"
                    placeholder="<?php echo esc_attr( $this->deactivation_form['placeholder'] ); ?>" 
                    value="<?php echo esc_attr( get_option( $this->activation_option_key ) ) ?>"
                    required>
                <input 
                    type="submit" 
                    class="button button-secondary"
                    name="<?php echo esc_attr( $this->plugin_prefix . '_plugin_deactivate_submit' ); ?>"
                    value="<?php echo esc_attr( $this->deactivation_form['button_text'] ); ?>">
            </form>
        <?php
    }

}

new WCSS_Admin_Plugin_Activation( 'wcss_activation_key', array(
    'plugin_prefix'     => 'wcss',
    'plugin_id'         => 21364305,
    'activation_redirection'    => admin_url( 'admin.php?page=woocommerce-cart-share' ),
    'title'             => __( 'Activate Plugin', 'woo-cart-share' ),
    'description'       => __( 'Please enter your purchase code. Purchasing plugin license also grants access to premium support. Use one license per domain please!', 'woo-cart-share' ),
    'activation_form'   => array(
        'placeholder'  => __( 'Enter Envato Purchase Code', 'woo-cart-share' ),
        'button_text'  => __( 'Activate', 'woo-cart-share' ),
    ),
    'deactivation_form'   => array(
        'placeholder'  => __( 'Enter Envato Purchase Code', 'woo-cart-share' ),
        'button_text'  => __( 'Deactivate', 'woo-cart-share' ),
    ),
    'links'             => array(
        array(
            'text'  => __( 'Where is my purchase code?', 'woop-cart-share' ),
            'link'  => 'http://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-',
        ),
        array(
            'text'  => __( 'Need our help?', 'woo-cart-share' ),
            'link'  => 'http://wecreativez.com/demo/wp-admin/admin.php?page=woocommerce-cart-share_share-support',
        ),
        array(
            'text'  => __( 'License Agreement', 'woo-cart-share' ),
            'link'  => 'https://codecanyon.net/licenses/standard',
        ),
    ),
) );