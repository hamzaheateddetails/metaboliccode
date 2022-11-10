<table class="table wcss-saved-cart-table">
  
    <thead>
        <tr>
            <th>#</th>
            <th><?php esc_html_e( 'Cart Name', 'woo-cart-share' ) ?></th>
            <th><?php esc_html_e( 'Action', 'woo-cart-share' ) ?></th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>#</th>
            <th><?php esc_html_e( 'Cart Name', 'woo-cart-share' ) ?></th>
            <th><?php esc_html_e( 'Action', 'woo-cart-share' ) ?></th>
        </tr>
    </tfoot>

    <tbody>
        
        <?php 
            $count = 1;
            foreach ( $saved_carts as $saved_cart ) : 

            // Get cart link by cart_key 
            $cart_url = wcss_get_cart_link( $saved_cart['cart_key'] );
        ?>

            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo esc_html( $saved_cart['cart_name'] ); ?></td>
                <td>
                    <a href="<?php echo $cart_url; ?>" class="button">
                        <?php echo esc_html( get_option( 'wcss_my_account_restore_button_lable' ) ); ?>
                    </a>
                    <a href="#" class="button" data-wcss-share-saved-cart="<?php echo esc_html( $saved_cart['cart_key'] ) ?>">
                        <?php echo esc_html( get_option( 'wcss_my_account_share_button_lable' ) ); ?>
                    </a>
                    <a href="<?php echo esc_url( "?wcss_delete_saved_cart=" . $saved_cart['cart_key'] ) ?>" class="button" onClick="return confirm( '<?php esc_html_e( 'Are you sure?', 'woo-cart-share' ); ?>' )">
                        <?php echo esc_html( get_option( 'wcss_my_account_delete_button_lable' ) ); ?>
                    </a>
                </td>
            </tr>

        <?php 
            $count++;
            endforeach; 
        ?>

    </tbody>

</table>