<?php $share_media = get_option( 'wcss_share_media' ); ?>

<div class="wcss-share-medium">

    <?php if ( 'yes' === $share_media['email'] ) : ?>
        <a href="<?php echo esc_url( $email_link ) ?>" data-wcss-email>
            <i class="wcss-icon-envelope"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Email', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === $share_media['whatsapp'] ) : ?>
        <a href="<?php echo esc_url( $whatsapp_link ) ?>" target="_blank" data-wcss-whatsapp>
            <i class="wcss-icon-whatsapp"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'WhatsApp', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === $share_media['copy_link'] ) : ?>
        <a href="#" data-wcss-copy-link data-clipboard-text="<?php echo esc_url( $cart_share_link ) ?>">
            <i class="wcss-icon-link"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Copy Link', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>


    <?php if ( 'yes' === $share_media['facebook'] ) : ?>
        <a href="<?php echo esc_url( $facebook_link ) ?>" target="_blank" data-wcss-facebook>
            <i class="wcss-icon-facebook"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Facebook', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>


    <?php if ( 'yes' === $share_media['twitter'] ) : ?>
        <a href="<?php echo esc_url( $twitter_link ) ?>" target="_blank" data-wcss-twitter>
            <i class="wcss-icon-twitter"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Twitter', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === $share_media['skype'] ) : ?>
        <a href="<?php echo esc_url( $skype_link ) ?>" target="_blank" data-wcss-skype>
            <i class="wcss-icon-skype"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Skype', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>


    <?php if ( 'yes' === $share_media['messenger'] ) : ?>
        <a href="<?php echo esc_html( $messenger_link ) ?>" target="_blank" data-wcss-messenger>
            <i class="wcss-icon-messenger"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Messenger', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === get_option( 'wcss_user_can_print_cart' ) ) : ?>
        <a href="#" data-wcss-print-cart="<?php echo esc_html( $print_cart_key ) ?>">
            <i class="wcss-icon-print"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Print Cart', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>

    <?php if ( 'yes' === get_option( 'wcss_user_can_save_cart' ) ) : ?>
        <a href="#" data-wcss-save-cart>
            <i class="wcss-icon-bookmark"></i>
            <div class="wcss-popup--text-color"><?php esc_html_e( 'Save Cart', 'woo-cart-share' ) ?></div>
        </a>
    <?php endif; ?>

</div>

<?php
    
    // load email cart form if email enable by admin
    if ( 'yes' === $share_media['email'] ) {
        require_once WCSS_PLUGIN_PATH . 'templates/email-cart-form.php'; 
    }
    if ( is_user_logged_in() ) {
        require_once WCSS_PLUGIN_PATH . 'templates/save-cart-form.php';
    } else {
        require_once WCSS_PLUGIN_PATH . 'templates/login-now.php';
    }

?>