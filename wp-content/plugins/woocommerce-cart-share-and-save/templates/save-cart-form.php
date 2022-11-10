<div class="wcss-save-cart-form">

    <form action="#" method="post">

        <div class="wcz_wcs-popup--text-color">
            <?php echo esc_html( get_option( 'wcss_save_cart_message' ) ) ?>
        </div>
        <input type="text" name="wcss_save_cart[cart_name]" autocomplete="off" placeholder="<?php echo esc_attr( get_option( 'wcss_save_cart_input_placeholder' ) ) ?>" required="required" />
        <input type="hidden" name="wcss_save_cart[cart_key]" value="<?php echo esc_attr( $uid ); ?>" />
        <input type="submit" name="wcss_save_cart_submit" class="button btn btn-primary wcss-btn" value="<?php echo esc_attr( get_option( 'wcss_save_cart_button_text' ) ) ?>">

    </form>

</div>