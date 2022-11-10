<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcss_current_time' ) ) {
    /**
     * Get current time and date.
     * 
     * Default: Month date, Year H:M am|pm
     *
     * @since  1.7
     * @return string return current time with format.
     */
    function wcss_current_time() {
        return current_time( apply_filters( 'wcss_date_format', 'M j, Y g:i a' ) );
    }
}

if ( ! function_exists( 'wcss_get_cart_link' ) ) {
    /**
     * Get complete share cart link by cart key.
     *
     * @param string $cart_key
     * @return string
     */
    function wcss_get_cart_link( $cart_key ) {
        $cart_share_link  = home_url() . '/' . get_option( 'wcss_base_slug' ) . '/' . $cart_key;
        return esc_url( $cart_share_link );
    }
}

if ( ! function_exists( 'wcss_get_template' ) ) {
    /**
     * Get plugin templates.
     *
     * @param string $template_name relative path
     * @param array $args
     */
    function wcss_get_template( $template_name, $args = array() ) {
        extract( $args );
        
        $template_file = get_stylesheet_directory() . '/wcss/' . $template_name;

        if ( file_exists( $template_file ) ) {
            $template = $template_file;
        } else {
            $template = trailingslashit( WCSS_PLUGIN_PATH ) . $template_name;
        }

        require apply_filters( 'wcss_get_template', $template, $template_name, $args );
    }
}

if ( ! function_exists( 'wcss_get_template_html' ) ) {
    /**
     * Get plugin templates.
     *
     * @param string $template_name relative path
     * @param array $args
     */ 
    function wcss_get_template_html( $template_name, $args = array() ) {
        ob_start();
        wcss_get_template( $template_name, $args );
        return apply_filters( 'wcss_get_template_html', ob_get_clean(), $template_name, $args );
    }
}

if ( ! function_exists( 'wcss_apply_inline_styles' ) ) {
    /**
     * Apply inline styles to dynamic html.
     *
     * We only inline CSS for html emails, and to do so we use Emogrifier library (if supported).
     *
     * @param string|null $html html that will receive inline styles.
     * @return string
     */
    function wcss_apply_inline_styles( $html = '', $css = '' ) {
        
        if ( class_exists( 'DOMDocument' ) && version_compare( PHP_VERSION, '5.5', '>=' ) ) {

            if ( ! class_exists( 'Pelago\\Emogrifier' ) ) {
                require_once WCSS_PLUGIN_PATH . 'includes/libraries/emogrifier/class-wcss-emogrifier.php';
            }
            // Apply Emogrifier to inline the CSS.
            $emogrifier = new Pelago\Emogrifier();
            $emogrifier->setHtml( $html );
            $emogrifier->setCss( strip_tags( $css ) );
            $html = $emogrifier->emogrify();
        } else {
            $html = '<style type="text/css">' . $css . '</style>' . $html; 
        }
        
        return $html;
    }    
}
if ( ! function_exists( 'wcss_get_current_user_role' ) ) {
    /**
     * Get the current user role.
     *
     * @return bool|int
     */
    function wcss_get_current_user_role() {
        if( is_user_logged_in() ) {
            $user = wp_get_current_user();
            $role = ( array ) $user->roles;
            return $role[0];
        } else {
            return false;
        }
    }    
}

if ( ! function_exists( 'wcss_currnet_role_has_access' ) ) {
    /**
     * Check whether current user has ability to share the cart or not.
     *
     * @return bool
     */
    function wcss_currnet_role_has_access() {
        if ( get_option( 'wcss_display_by_role_status' ) === 'yes' ) {
            if ( ! in_array( wcss_get_current_user_role(), get_option( 'wcss_display_by_role' ) ) ) {
                return false;
            }
        }

        return true;
    }   
}