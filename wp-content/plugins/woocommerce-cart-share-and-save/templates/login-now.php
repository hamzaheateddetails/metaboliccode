<div class="wcss-login-now">
    <div class="wcss-popup--text-color">
      <?php echo esc_html( get_option( 'wcss_save_cart_not_logged_in_message' ) ); ?>
    </div>
    <div>
        <a href="<?php echo esc_attr( $login_page_url ) ?>" class="button">
            <?php echo esc_html( get_option( 'wcss_login_now_button_text' ) ) ?>
        </a>
    </div>
</div>