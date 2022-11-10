<div class="notice notice-info is-dismissible">
    <p><strong><?php esc_html_e( 'Fix 404 redirection issue while retrieving cart.', 'woo-cart-share' ); ?></strong></p>
    <p><?php esc_html_e( 'In some cases, you might be faced the 404 redirection issue while you retrieving the cart. So please click on the FIX IT NOW button to fix the issue.', 'woo-cart-share' ) ?></p>
    <p>
        <a class="button button-primary" href="<?php echo wp_nonce_url( '?wcss_flush_rewrite_rules=1' ); ?>"><?php esc_html_e( 'Fix It Now', 'woo-cart-share' ); ?></a>
        <a class="button button-secondary" href="?wcss_flush_rewrite_rules_notification_hide=1"><?php esc_html_e( 'Already Fixed', 'woo-cart-share' ); ?></a>
    </p>
</div>