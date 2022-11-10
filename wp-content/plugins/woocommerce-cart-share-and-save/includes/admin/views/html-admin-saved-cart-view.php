<div class="wrap">
    <h1><?php esc_html_e( 'Saved Cart', 'woo-cart-share' ) ?></h1>
    <?php if ( isset( $_POST['wcss_send_saved_cart_send'] ) ) : ?>
        <div class="notice notice-success is-dismissible"> 
            <p><strong><?php esc_html_e( 'Email sent.', 'woo-cart-share' ) ?></strong></p>
        </div>
    <?php endif; ?>
    <hr>
    <div>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=woocommerce-cart-share_saved-cart' ) ) ?>" class="button button-secondary">
            <i class="wcss-icon-arrow-left"></i>
            <?php esc_html_e( 'Go Back', 'woo-cart-share' ) ?>
        </a>
        <a href="#" id="wcss-send-saved-cart-form-tigger"  class="button button-primary">
            <i class="wcss-icon-envelope"></i>
            <?php esc_html_e( 'Email Cart', 'woo-cart-share' ) ?>
        </a>
        <a href="#" id="wcss-print-saved-cart" class="button button-primary">
            <i class="wcss-icon-print"></i>
            <?php esc_html_e( 'Print Cart', 'woo-cart-share' ) ?>
        </a>
    </div>
    <hr>
    <br>
    <form action="#" method="post" id="wcss-send-saved-cart-form">
        <input type="hidden" name="wcss_send_saved_cart[body]">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="wcss_send_saved_cart[subject]"><?php esc_html_e( 'Email Subject', 'woo-cart-share' ); ?></label>
                    </th>
                    <td>
                        <input type="text" class="regular-text" name="wcss_send_saved_cart[subject]" id="wcss_send_saved_cart[subject]">
                        <p class="description"><?php esc_html_e( 'Enter the subject of an email.', 'woo-cart-share' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="wcss_send_saved_cart[to]"><?php esc_html_e( 'Email To', 'woo-cart-share' ); ?></label>
                    </th>
                    <td>
                        <input type="text" class="regular-text" name="wcss_send_saved_cart[to]" id="wcss_send_saved_cart[to]">
                        <p class="description"><?php esc_html_e( 'Use comma (,) for multiple emails', 'woo-cart-share' ); ?></p>
                        <p class="description"><?php esc_html_e( 'Enter the email(s) where you want to send this saved cart.', 'woo-cart-share' ); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button( esc_html__( 'Send', 'woo-cart-share' ), 'primary', 'wcss_send_saved_cart_send' ); ?>
    </form>
    <div id="wcss-cart">
        <div class="fa-spinner-wrapper">
            <i class="wcss-icon-spinner wcss-spinner"></i>
        </div>
    </div>
</div>