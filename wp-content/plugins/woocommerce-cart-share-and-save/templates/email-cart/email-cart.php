<?php 
/**
 * Email Cart
 *
 * This template can be overridden by copying it to yourtheme/wcss/templates/email-cart/email-cart.php.
 * 
 * @version 1.0.0
 * 
 * @var $cart_key                       Get cart key.
 * @var $cart_link                      Get cart link.
 * @var $message                        Get cart message.
 * @var $body_bg_color                  Get selected body background color from email settings.
 * @var $header_bg_color                Get selected header background color from email settings.
 * @var $header_text_color              Get selected header text color from email settings.
 * @var $button_bg_color                Get selected button background color from email settings.
 * @var $button_text_color              Get selected body text color from email settings.
 * @var $brand_name                     Get brand name from email settings.
 * @var $brand_logo_url                 Get brand logo from email settings.
 * @var $retrieve_cart_button_text      Get retrieve cart button text from email settings.
 * 
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

ob_start();

/**
 * CSS (without <style></style> tag)
 * wcss_apply_inline_styles() will automatically add CSS to HTML inline.
 * 
 */
?>
.wcss-email {
    width: 690px; 
    padding-left: 0; 
    padding-right: 0;
    font-size: 15px; 
    font-family: Arial, sans-serif; 
    line-height: 1.4em; 
    letter-spacing: -0.03em;
    margin-top: 0;
    margin-bottom: 0;
    margin-left: auto;
    margin-right: auto;
    background-color: <?php echo esc_html( $body_bg_color ); ?>;
    color: #444;
}

.wcss-email table {
    width: 100%;
}

.wcss-email dt,
.wcss-email dd {
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
}

.wcss-email ul {
    list-style: none;
    padding-top: 0;
    padding-bottom: 0;
    padding-left: 0;
    padding-right: 0;
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
}

.wcss-email p {
    padding-top: 0;
    padding-bottom: 0;
    padding-left: 0;
    padding-right: 0;
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
}

.wcss-email a {
    text-decoration: none;
}

.wcss-email-header,
.wcss-email-footer {
    background-color: <?php echo esc_html( $header_bg_color ); ?>;
    text-align: center;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
    padding-right: 15px;
    color: <?php echo esc_html( $header_text_color ); ?>;
}

.wcss-email-header {
    border-bottom: 1px solid #eee;
}

.wcss-email-header a,
.wcss-email-footer a {
    color: <?php echo esc_html( $header_text_color ); ?>;
}

.wcss-email-logo {
    max-width: 230px;
    width: auto;
    height: auto;
}

.wcss-email-header__brand {
    font-size: 21px;
    margin-top: 8px;
    margin-bottom: 8px;
    margin-left: 8px;
    margin-right: 8px;
    display: inline-block;
}

.wcss-email-body {
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
    padding-right: 15px;
}
.wcss-email-body__desc {
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
    padding-right: 15px;
}
.wcss-email-body__desc p {
    font-size: 16px;
}
.wcss-email-body__cta {
    text-align: center;
}
.wcss-email-body__cta a {
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 40px;
    padding-right: 40px;
    display: inline-block;
    background-color: <?php echo esc_html( $button_bg_color ); ?>;
    color: <?php echo esc_html( $button_text_color ); ?>;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid <?php echo esc_html( $button_bg_color ); ?>;
}

table.wcss-email-cart-table td,
table.wcss-email-cart-table th {
    border-bottom: 1px solid #eee;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
    text-align: left;
}

table.wcss-email-cart-products .wcss-email-cart-products__image img {
    width: 80px;
    height: 80px;
}

table.wcss-email-cart-products .wcss-email-cart-products__name {
    font-size: 15px;
    color: #555;
}

table.wcss-email-cart-products .wcss-email-cart-products__qty {
    color: #777;
    font-size: 13px;
}

table.wcss-email-cart-products .wcss-email-cart-products__price {
    font-size: 14px;
}

table.wcss-email-cart-totals {
    background-color: #f8f8f8;
}

table.wcss-email-cart-totals .woocommerce-remove-coupon {
    display: none;
}

.wcss-email-footer__social li {
    display: inline-block;
    margin-top: 15px;
    margin-bottom: 15px;
    margin-left: 15px;
    margin-right: 15px;
}

.wcss-email-footer__social li a {
    text-decoration: none;
}

<?php 
$css = apply_filters( 'wcss_email_css', ob_get_clean() );

ob_start(); 
/**
 * HTML goes here
 */
?>

<div style="display: none;"><?php echo $message; // WPCS: XSS ok. ?></div>

<!-- wcss-email -->
<div class="wcss-email">

    <?php do_action( 'wcss_before_email_header' ); ?>
    
    <!-- wcss-email-header -->
    <table cellspacing="0" class="wcss-email-header">
        <tbody>
            <tr>
                <td>
                    <a href="<?php echo home_url(); ?>">
                        <img class="wcss-email-logo" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="//">
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="wcss-email-header__brand" href="<?php echo home_url(); ?>">
                        <?php echo esc_html( $brand_name ) ?>
                    </a>
                </td>
            </tr>
        </tbody>
    </table><!-- .wcss-email-header -->

    <?php do_action( 'wcss_after_email_header' ); ?>

    <?php do_action( 'wcss_before_email_body' ); ?>

    <!-- wcss-email-body -->
    <table cellspacing="0" class="wcss-email-body">
        <tbody>
            <tr>
                <td class="wcss-email-body__desc">
                    <div style="text-align: center;"><?php echo wpautop( $message ); // WPCS: XSS ok. ?></div>
                </td>
            </tr>
            <tr>
                <td class="wcss-email-body__cta">
                    <a href="<?php echo esc_url( wcss_get_cart_link( $cart_key ) ); ?>" target="_blank" >
                        <?php echo esc_html( $retrieve_cart_button_text ) ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="height: 20px; border-bottom: 1px solid #eee;"></td>
            </tr>
            <tr>
                <td>

                    <!-- Mini Cart -->
                    <?php if ( ! WC()->cart->is_empty() ) : ?>

                        <table cellspacing="0" class="wcss-email-cart-table wcss-email-cart-products">
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
                                            <td width="100" class="wcss-email-cart-products__image">
                                                <?php if ( $product_permalink ) : ?>
                                                    <a href="<?php echo esc_url( $product_permalink ) ?>">
                                                        <?php echo $thumbnail; ?>
                                                    </a>
                                                <?php else : ?>
                                                    <?php echo $thumbnail; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="wcss-email-cart-products__meta">
                                                <p class="wcss-email-cart-products__name"><strong><?php echo $product_name; ?></strong></p>
                                                <p class="wcss-email-cart-products__qty"><?php echo $product_qty; ?></p>
                                                <div class="wcss-email-cart-products__item-data">
                                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                                </div>
                                            </td>
                                            <td class="wcss-email-cart-products__price">
                                                <p><?php echo $product_total ?></p>
                                            </td>

                                        </tr>

                                        <?php
                                    }
                                }

                            ?>
                                
                            </tbody>
                        </table>

                        <table cellspacing="0" class="wcss-email-cart-table wcss-email-cart-totals">

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

                        </table>

                    <?php endif; ?>    
                    <!-- .Mini Cart -->

                </td>
            </tr>

        </tbody>
    </table><!-- .wcss-email-body -->

    <?php do_action( 'wcss_after_email_body' ); ?>
    
    <?php do_action( 'wcss_before_email_footer' ); ?>

    <!-- wcss-email-footer -->
    <table cellspacing="0" class="wcss-email-footer">
        <tbody>
            <tr>
                <td>
                    <ul class="wcss-email-footer__social">
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
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo home_url(); ?>">
                        <?php echo esc_html( $brand_name ); ?>
                    </a>
                </td>
            </tr>
        </tbody>
    </table><!-- .wcss-email-footer -->

    <?php do_action( 'wcss_after_email_footer' ); ?>

</div><!-- .wcss-email -->

<?php
$html = ob_get_clean();

/**
 * Return HTML with applied inline CSS.
 */
echo wcss_apply_inline_styles( $html, $css );