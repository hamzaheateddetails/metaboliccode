<?php ob_start(); ?>

.wcss-print-cart-wrapper {
    width: 800px;
    padding: 15px;
}

.wcss-print-cart-header {
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.wcss-print-cart-header__logo {
    margin: 0 auto;
    display: block;
}

.wcss-print-cart-header__brand {
    width: 100%;
    text-align: center;
    display: block;
}

.wcss-print-cart-button {
    text-align: center;
    padding: 15px;
    font-size: 16px;
}

.wcss-print-cart-button a {
    color: #333;
}

.wcss-print-cart-table tbody tr td,
.wcss-print-cart-table tbody tr th {
    border-top: 1px solid #eee;
    padding: 10px;
    vertical-align: middle;
}

.wcss-print-cart-table.wcss-print-cart-totals tbody tr td,
.wcss-print-cart-table.wcss-print-cart-totals tbody tr th {
    padding: 8px 20px;
}

.wcss-print-cart-table .woocommerce-remove-coupon {
    display: none;
}

.wcss-print-cart-product__image img {
    width: 80px;
    height: 80px;
}

.wcss-print-cart-product__name,
.wcss-print-cart-product__qty {
    margin: 0;
    padding: 0;
}

.wcss-print-cart-social {
    list-stlye: none;
    padding: 0;
    margin: 0;
    width: 100%;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.wcss-print-cart-social li {
    display: inline-block;
}

.wcss-print-cart-social li a {
    padding: 8px;
    display: inline-block;
}

<?php $css = apply_filters( 'wcss_print_cart_css', ob_get_clean() ); ?>

<?php ob_start(); ?>

<div class="wcss-print-cart-wrapper">

    <!-- wcss-print-cart-header -->
    <div cellspacing="0" class="wcss-print-cart-header">
        <a href="<?php echo home_url(); ?>">
            <img class="wcss-print-cart-header__logo" src="<?php echo esc_url( get_option( 'wcss_email_brand_logo_url' ) ); ?>" alt="//">
        </a>
        <a class="wcss-print-cart-header__brand" href="<?php echo home_url(); ?>">
            <?php echo esc_html( get_option( 'wcss_email_brand_name' ) ) ?>
        </a>
    </div><!-- .wcss-email-header -->

    <div class="wcss-print-cart-button">
        <a href="<?php echo wcss_get_cart_link( $cart_key ) ?>"><?php echo wcss_get_cart_link( $cart_key ) ?></a>
    </div>

    <?php do_action( 'wcss_before_print_cart' ); ?>

    <!-- Mini Cart -->
    <?php if ( ! WC()->cart->is_empty() ) : ?>

        <table class="wcss-print-cart-table wcss-print-cart-products">
            <tbody>

            <?php

                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                        $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        $product_qty       = apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key );
                        $product_total     = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                        ?>
                        <tr>
                            <td width="110" class="wcss-print-cart-product__image">
                                <?php if ( $product_permalink ) : ?>
                                    <a href="<?php echo esc_url( $product_permalink ) ?>">
                                        <?php echo $thumbnail; ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo $thumbnail; ?>
                                <?php endif; ?>
                            </td>
                            <td class="wcss-print-cart-product__meta">
                                <p class="wcss-print-cart-product__name">
                                    <?php echo $product_name; ?>
                                </p>
                                <p class="wcss-print-cart-product__qty">
                                    <?php echo $product_qty; ?>
                                </p>
                                <p class="wcss-print-cart-product__item-meta">
                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                </p>
                            <td class="wcss-print-cart-product__price">
                                <?php echo $product_total; ?>
                            </td>
                        </tr>

                        <?php
                    }
                }

            ?>
                
            </tbody>
        </table>

        <table class="wcss-print-cart-table wcss-print-cart-totals">
            <tbody>

                <tr class="cart-subtotal">
                    <th><?php esc_html_e( 'Subtotal', 'woo-cart-share' ); ?></th>
                    <td data-title="<?php esc_attr_e( 'Subtotal', 'woo-cart-share' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
                </tr>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                        <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                    <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

                    <?php wc_cart_totals_shipping_html(); ?>

                    <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

                <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

                    <tr class="shipping">
                        <th><?php esc_html_e( 'Shipping', 'woo-cart-share' ); ?></th>
                        <td data-title="<?php esc_attr_e( 'Shipping', 'woo-cart-share' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
                    </tr>

                <?php endif; ?>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <tr class="fee">
                        <th><?php echo esc_html( $fee->name ); ?></th>
                        <td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
                    $taxable_address = WC()->customer->get_taxable_address();
                    $estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
                            ? sprintf( ' <small>' . __( '(estimated for %s)', 'woo-cart-share' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
                            : '';

                    if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                            <tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                                <th><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
                                <td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="tax-total">
                            <th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
                            <td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

                <tr class="order-total">
                    <th><?php esc_html_e( 'Total', 'woo-cart-share' ); ?></th>
                    <td data-title="<?php esc_attr_e( 'Total', 'woo-cart-share' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>

                <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
                
            </tbody>

        </table>

    <?php endif; ?>    
    <!-- .Mini Cart -->

    <ul class="wcss-print-cart-social">
        <?php 
            foreach( wcss_email_contact_media() as $contact_media ) :
                if ( $contact_media['link'] === '' ) {
                    continue;
                }
                ?>
        <li>
            <a href="<?php echo esc_url( $contact_media['link'] ) ?>" target="_blank">
                <img src="<?php echo esc_url( $contact_media['img'] ); ?>" alt="//" width="20">
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    
    <?php do_action( 'wcss_after_print_cart' ); ?>

    <div class="wcss-print-cart-button">
        <a href="<?php echo wcss_get_cart_link( $cart_key ); ?>"><?php echo wcss_get_cart_link( $cart_key ); ?></a>
    </div>

</div>

<?php $html = ob_get_clean(); ?>

<?php echo wcss_apply_inline_styles( $html, $css ); ?>