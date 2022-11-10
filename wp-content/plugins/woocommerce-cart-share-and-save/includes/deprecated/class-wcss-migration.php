<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * This class is responsiable for the plugin migration with old version.
 * 
 * @since 1.7
 */
class WCSS_Migration {

    public function __construct() {
        add_action( 'wcss_before_install', array( $this, 'migration_options_1_6_to_1_7' ), 1 );
        add_action( 'wcss_before_install', array( $this, 'migration_options_1_7_6' ), 2 );
        add_action( 'wcss_before_install', array( $this, 'migration_options_1_7_7' ), 3 );
    }

    public function migration_options_1_7_7() {
        if ( get_option( 'wcss_retrieved_cart_redirection_url' ) ) {
            $retrieved_cart_redirection_id = get_option( 'wcss_retrieved_cart_redirection_url' );

            if ( ! is_numeric( $retrieved_cart_redirection_id ) ) {
                add_option( 'wcss_retrieved_cart_redirection_page_id', get_option( 'woocommerce_cart_page_id' ) );
            } else {
                add_option( 'wcss_retrieved_cart_redirection_page_id', $retrieved_cart_redirection_id );
            }

            delete_option( 'wcss_retrieved_cart_redirection_url' );
        }
    }

    public function migration_options_1_7_6() {
        if ( get_option( 'wcss_delete_shared_cart_after_retrieved' ) ) {

            add_option( 'wcss_automatically_delete_cart_options', array(
                'shared_cart_after_retrieved'           => get_option( 'wcss_delete_shared_cart_after_retrieved' ),
                'shared_and_saved_cart_after_retrieved' => get_option( 'wcss_delete_cart_after_retrieved' ),
            ) );

            delete_option( 'wcss_delete_cart_after_retrieved' );
            delete_option( 'wcss_delete_shared_cart_after_retrieved' );
        }
    }

    public function migration_options_1_6_to_1_7() {
        /**
         * If older version was never installed then no need to run migration.
         */
        if ( ! get_option( 'wcz_wcs_settings' ) ) {
            return;
        }
        
        // Main settings migration
        $main_settings = get_option( 'wcz_wcs_settings', array() );

        $wcss_share_media = array();

        foreach( $main_settings as $name => $value ) {
            if ( $name === 'ui_btn_bg_color' ) {
                $this->add_option( 'wcss_button_background_color', $value );
            }
            if ( $name === 'ui_btn_text_color' ) {
                $this->add_option( 'wcss_button_text_color', $value );
            }
            if ( $name === 'ui_popup_bg_color' ) {
                $this->add_option( 'wcss_popup_background_color', $value );
            }
            if ( $name === 'ui_popup_text_color' ) {
                $this->add_option( 'wcss_popup_text_color', $value );
            }
            if ( $name === 'text_share_cart_btn' ) {
                $this->add_option( 'wcss_share_cart_button_text', $value );
            }
            if ( $name === 'text_share_cart_title' ) {
                $this->add_option( 'wcss_share_cart_title', $value );
            }
            if ( $name === 'text_save_cart_msg' ) {
                $this->add_option( 'wcss_save_cart_message', $value );
            }
            if ( $name === 'text_save_cart_input_placeholder' ) {
                $this->add_option( 'wcss_save_cart_input_placeholder', $value );
            }
            if ( $name === 'text_save_cart_btn' ) {
                $this->add_option( 'wcss_save_cart_button_text', $value );
            }
            if ( $name === 'text_login_now_btn_text' ) {
                $this->add_option( 'wcss_login_now_button_text', $value );
            }
            if ( $name === 'text_save_cart_not_logged_in_msg' ) {
                $this->add_option( 'wcss_save_cart_not_logged_in_message', $value );
            }
            if ( $name === 'text_empty_cart_msg' ) {
                $this->add_option( 'wcss_empty_cart_message', $value );
            }
            if ( $name === 'text_email_to' ) {
                $this->add_option( 'wcss_share_cart_email_to_label', $value );
            }
            if ( $name === 'text_email_subject' ) {
                $this->add_option( 'wcss_share_cart_email_subject_label', $value );
            }
            if ( $name === 'text_email_message' ) {
                $this->add_option( 'wcss_share_cart_email_message_label', $value );
            }
            if ( $name === 'opt_share_cart_btn_location' ) {
                $this->add_option( 'wcss_trigger_button_location', $value );
            }
            if ( $name === 'opt_user_can_save_cart' ) {
                $this->add_option( 'wcss_user_can_save_cart', ( $value === 'yes' ) ? 'yes' : 'no' );
            }
            if ( $name === 'opt_user_can_print_cart' ) {
                $this->add_option( 'wcss_user_can_print_cart', ( $value === 'yes' ) ? 'yes' : 'no' );
            }
            if ( $name === 'opt_social_share_msg' ) {
                $this->add_option( 'wcss_social_share_message', $value );
            }
            if ( $name === 'opt_custom_css' ) {
                $this->add_option( 'wcss_custom_css', $value );
            }
            if ( $name === 'opt_is_rtl' ) {
                $this->add_option( 'wcss_rtl_status', ( $value === '0' ) ? 'no' : 'yes' );
            }
            if ( $name === 'opt_redirection_url' ) {
                $this->add_option( 'wcss_retrieved_cart_redirection_url', $value );
            }
            if ( $name === 'opt_roles_status' ) {
                $this->add_option( 'wcss_display_by_role_status', ( $value === '0' ) ? 'no' : 'yes' );
            }
            if ( $name === 'opt_roles' ) {
                $this->add_option( 'wcss_display_by_role', $value );
            }
            if ( $name === 'social_media' ) {
                foreach( $value as $n => $v ) {
                    if ( $n === 'whatsapp' ) {
                        $wcss_share_media['whatsapp'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                    if ( $n === 'email' ) {
                        $wcss_share_media['email'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                    if ( $n === 'copyLink' ) {
                        $wcss_share_media['copy_link'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                    if ( $n === 'facebook' ) {
                        $wcss_share_media['facebook'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                    if ( $n === 'twitter' ) {
                        $wcss_share_media['twitter'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                    if ( $n === 'skype' ) {
                        $wcss_share_media['skype'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                    if ( $n === 'messenger' ) {
                        $wcss_share_media['messenger'] = ( $v == '1' ) ? 'yes' : 'no';
                    }
                }

                $this->add_option( 'wcss_share_media', $wcss_share_media );
            }

        }
 
        // Email settings migration
        $email_settings = get_option( 'wcss_email_settings', array() );

        $email_follow_media = array(); 

        foreach( $email_settings as $name => $value ) {
            if ( $name === 'brand_logo' ) {
                $this->add_option( 'wcss_email_brand_logo_url', $value );
            }
            if ( $name === 'brand_name' ) {
                $this->add_option( 'wcss_email_brand_name', $value );
            }
            if ( $name === 'header_bg_color' ) {
                $this->add_option( 'wcss_email_header_background_color', $value );
            }
            if ( $name === 'header_text_color' ) {
                $this->add_option( 'wcss_email_header_text_color', $value );
            }
            if ( $name === 'button_bg_color' ) {
                $this->add_option( 'wcss_email_button_background_color', $value );
            }
            if ( $name === 'button_text_color' ) {
                $this->add_option( 'wcss_email_button_text_color', $value );
            }
            if ( $name === 'button_text' ) {
                $this->add_option( 'wcss_email_retrieve_cart_button_text', $value );
            }
            if ( $name === 'body_bg_color' ) {
                $this->add_option( 'wcss_email_body_background_color', $value );
            }
            if ( $name === 'description' ) {
                $this->add_option( 'wcss_email_description', $value );
            }
            if ( $name === 'follow_facebook' ) {
                $email_follow_media['facebook'] = $value;
            }
            if ( $name === 'follow_instagram' ) {
                $email_follow_media['instagram'] = $value;
            }
            if ( $name === 'follow_twitter' ) {
                $email_follow_media['twitter'] = $value;
            }
            if ( $name === 'follow_whatsapp' ) {
                $email_follow_media['whatsapp'] = $value;
            }
            if ( $name === 'email_from_name' ) {
                $this->add_option( 'wcss_email_from_name', $value );
            }
            if ( $name === 'email_from' ) {
                $this->add_option( 'wcss_email_from_email', $value );
            } 
        }
        $this->add_option( 'wcss_email_contact_media', $email_follow_media );

        // My account settings migration
        $my_account_settings = get_option( 'wcss_my_account_setting', array() );
        foreach( $my_account_settings as $name => $value ) {
            if ( $name === 'tab_name' ) {
                $this->add_option( 'wcss_my_account_tab_name', $value );
            }
            if ( $name === 'slug' ) {
                $this->add_option( 'wcss_my_account_tab_slug', $value );
            }
            if ( $name === 'no_saved_cart_button_text' ) {
                $this->add_option( 'wcss_my_account_empty_saved_cart_button_text', $value );
            }
            if ( $name === 'no_saved_cart_msg' ) {
                $this->add_option( 'wcss_my_account_empty_saved_cart_message', $value );
            }
        }

        // Developer settings migration
        $developer_settings = get_option( 'wcz_wcs_dev_settings', array() );
        foreach( $developer_settings as $name => $value ) {
            if ( $name === 'base_url' ) {
                $this->add_option( 'wcss_base_slug', $value );
            }
            if ( $name === 'delete_setting' ) {
                $this->add_option( 'wcss_delete_all', ( $value == '0') ? 'no' : 'yes' );
            }
        }

        // Delete version 1.6 or less then 1.6 settings.
        delete_option( 'wcz_wcs_settings' ); 
        delete_option( 'wcss_my_account_setting' ); 
        delete_option( 'wcss_email_settings' ); 
        delete_option( 'wcz_wcs_dev_settings' ); 
    }

    /**
     * Add option only if not exists.
     *
     * @param string $option
     * @param mixed $value
     * @return boolean 
     */
    public function add_option( $option, $value ) {
        if ( get_option( $option ) === false ) {
            add_option( $option, $value );
        }
    }

} // End of the class WCSS_Migration

$wcss_migration = new WCSS_Migration;