<?php
$email_contact_media = get_option( 'wcss_email_contact_media', array() );

return apply_filters( 'wcss_email_settings', array(
    array(
        'title'    => __( 'Brand Logo', 'woo-cart-share' ),
        'desc_tip' => __( 'Upload your brand logo.', 'woo-cart-share' ),
        'id'       => 'wcss_email_brand_logo_url',
        'default'  => '',
        'type'     => 'file',
        'css'      => 'width:240px;',
    ),
    array(
        'title'    => __( 'Brand Name', 'woo-cart-share' ),
        'desc_tip' => __( 'Enter your brand name.', 'woo-cart-share' ),
        'id'       => 'wcss_email_brand_name',
        'default'  => '',
        'type'     => 'text',
        'class'    => 'regular-text',
    ),
    array(
        'title'    => __( 'Header Background Color', 'woo-cart-share' ),
        'desc_tip' => __( 'Change the email header and footer background color.', 'woo-cart-share' ),
        'id'       => 'wcss_email_header_background_color',
        'default'  => '#333333',
        'type'     => 'color',
    ),
    array(
        'title'    => __( 'Header Text Color', 'woo-cart-share' ),
        'desc_tip' => __( 'Change the email header and footer text color.', 'woo-cart-share' ),
        'id'       => 'wcss_email_header_text_color',
        'default'  => '#ffffff',
        'type'     => 'color',
    ),
    array(
        'title'    => __( 'Button Background Color', 'woo-cart-share' ),
        'desc_tip' => __( 'Change the email button background color.', 'woo-cart-share' ),
        'id'       => 'wcss_email_button_background_color',
        'default'  => '#96588a',
        'type'     => 'color',
    ),
    array(
        'title'    => __( 'Button Text Color', 'woo-cart-share' ),
        'desc_tip' => __( 'Change the email button text color.', 'woo-cart-share' ),
        'id'       => 'wcss_email_button_text_color',
        'default'  => '#ffffff',
        'type'     => 'color',
    ),
    array(
        'title'    => __( 'Body Color', 'woo-cart-share' ),
        'desc_tip' => __( 'Change the email body background color.', 'woo-cart-share' ),
        'id'       => 'wcss_email_body_background_color',
        'default'  => '#ffffff',
        'type'     => 'color',
    ),
    array(
        'title'    => __( 'Button Text', 'woo-cart-share' ),
        'desc_tip' => __( 'You can change the button text here.', 'woo-cart-share' ),
        'id'       => 'wcss_email_retrieve_cart_button_text',
        'default'  => '',
        'type'     => 'text',
        'class'    => 'regular-text',
    ),
    array(
        'title'   => __( 'Email Description', 'woo-cart-share' ),
        'desc'    => __( 'Add the email description here.', 'woo-cart-share' ),
        'id'      => 'wcss_email_description',
        'default' => '',
        'type'    => 'wp_editor',
    ),
    array(
        'title'  => __( 'Follow Us', 'woo-cart-share' ),
        'id'     => 'wcss_email_contact_media',
        'type'   => 'custom',
        'custom' => '
            <div style="margin-bottom:30px;">
                <label for="wcss_email_contact_media[facebook]"><strong>' . __( 'Facebook', 'woo-cart-share' ) . '</strong><br>
                    <input
                        type="text"
                        name="wcss_email_contact_media[facebook]"
                        id="wcss_email_contact_media[facebook]"
                        class="regular-text"
                        value="' . esc_attr( $email_contact_media['facebook'] ) . '">
                </label>
                <p class="description">' . __( 'Leave blank for disable.', 'woo-cart-share' ) . '</p>
            </div>
            <div style="margin-bottom:30px;">
                <label for="wcss_email_contact_media[instagram]"><strong>' . __( 'Instagram', 'woo-cart-share' ) . '</strong><br>
                    <input
                        type="text"
                        name="wcss_email_contact_media[instagram]"
                        id="wcss_email_contact_media[instagram]"
                        class="regular-text"
                        value="' . esc_attr( $email_contact_media['instagram'] ) . '">
                </label>
                <p class="description">' . __( 'Leave blank for disable.', 'woo-cart-share' ) . '</p>
            </div>
            <div style="margin-bottom:30px;">
                <label for="wcss_email_contact_media[twitter]"><strong>' . __( 'Twitter', 'woo-cart-share' ) . '</strong><br>
                    <input
                        type="text"
                        name="wcss_email_contact_media[twitter]"
                        id="wcss_email_contact_media[twitter]"
                        class="regular-text"
                        value="' . esc_attr( $email_contact_media['twitter'] ) . '">
                </label>
                <p class="description">' . __( 'Leave blank for disable.', 'woo-cart-share' ) . '</p>
            </div>
            <div style="margin-bottom:30px;">
                <label for="wcss_email_contact_media[whatsapp]"><strong>' . __( 'WhatsApp', 'woo-cart-share' ) . '</strong><br>
                    <input
                        type="text"
                        name="wcss_email_contact_media[whatsapp]"
                        id="wcss_email_contact_media[whatsapp]"
                        class="regular-text"
                        value="' . esc_attr( $email_contact_media['whatsapp'] ) . '">
                </label>
                <p class="description">' . __( 'Enter mobile phone number with the international country code, without + character. Example:  911234567890 for (+91) 1234567890', 'woo-cart-share' ) . '</p>
            </div>
        ',
    ),
    array(
        'title'    => __( 'Email From Name', 'woo-cart-share' ),
        'desc'     => sprintf( __( 'For best practice use %s', 'woo-cart-share' ), '<code>' . get_bloginfo( 'name' ) . '</code>' ),
        'desc_tip' => __( 'Enter the email come from name.', 'woo-cart-share' ),
        'id'       => 'wcss_email_from_name',
        'default'  => get_bloginfo( 'name' ),
        'type'     => 'text',
        'class'    => 'regular-text',
    ),
    array(
        'title'    => __( 'Email From', 'woo-cart-share' ),
        'desc'     => sprintf( __( 'For best practice use %s', 'woo-cart-share' ), '<code>' . get_bloginfo( 'admin_email' ) . '</code>' ),
        'desc_tip' => __( 'Enter an email of your store.', 'woo-cart-share' ),
        'id'       => 'wcss_email_from_email',
        'default'  => get_bloginfo( 'admin_email' ),
        'type'     => 'email',
        'class'    => 'regular-text',
    ),
) );
