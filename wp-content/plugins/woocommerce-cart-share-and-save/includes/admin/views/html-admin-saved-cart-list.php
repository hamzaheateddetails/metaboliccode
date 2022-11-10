<div class="wrap">
    <h1><?php esc_html_e( 'Saved Cart', 'woo-cart-share' ); ?></h1>

    <?php if ( isset( $_GET['wcss_delete_cart_done'] ) ) : ?>
        <div class="notice notice-success is-dismissible"> 
            <p><strong><?php esc_html_e( 'Cart deleted.', 'woo-cart-share' ) ?></strong></p>
        </div>
    <?php endif; ?>
    <hr>
    <?php
        $table = new WCSS_Admin_Saved_Cart_Table;
        $table->prepare_items();
    ?>
    <form method="post" action="#">
        <?php $table->search_box( 'Search', 'woo-cart-share' ); ?>
    </form>
    <?php $table->display(); ?>
    <hr>
    <a 
        href="<?php echo wp_nonce_url( admin_url( 'admin.php?wcss_delete_all_cart=1' ) ); ?>" 
        class="button button-link-delete"
        onClick="return confirm('<?php esc_attr_e( 'Are you sure, you want to delete all saved & shared carts?', 'woo-cart-share' ); ?>');">
        <?php esc_html_e( 'Delete all saved & shared carts', 'woo-cart-share' ) ?>
    </a>
</div>