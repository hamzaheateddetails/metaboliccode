<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcss_email_contact_media' ) ) {
    /**
     * Get email contact media.
     *
     * @return array
     */
    function wcss_email_contact_media() {
        $contact_media = get_option( 'wcss_email_contact_media' );

        $contact_media[0] = array(
            'img'   => WCSS_PLUGIN_URL . 'assets/images/email/email-facebook.png',
            'link'  => $contact_media['facebook'],
        );
        $contact_media[1] = array(
            'img'   => WCSS_PLUGIN_URL . 'assets/images/email/email-instagram.png',
            'link'  => $contact_media['instagram'],
        );
        $contact_media[2] = array(
            'img'   => WCSS_PLUGIN_URL . 'assets/images/email/email-twitter.png',
            'link'  => $contact_media['twitter'],
        );
        $contact_media[3] = array(
            'img'   => WCSS_PLUGIN_URL . 'assets/images/email/email-whatsapp.png',
            'link'  => ( $contact_media['whatsapp'] ) ? '//wa.me/' . $contact_media['whatsapp'] : $contact_media['whatsapp'],
        );

        // Unset default.
        if ( isset( $contact_media['facebook'] ) ) {
            unset( $contact_media['facebook'] );
        }
        if ( isset( $contact_media['instagram'] ) ) {
            unset( $contact_media['instagram'] );
        }
        if ( isset( $contact_media['twitter'] ) ) {
            unset( $contact_media['twitter'] );
        }
        if ( isset( $contact_media['whatsapp'] ) ) {
            unset( $contact_media['whatsapp'] );
        }

        return apply_filters( 'wcss_email_contact_media', $contact_media );
    }
}