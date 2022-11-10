<?php
$settings = array(
    array(
        'name' => __( 'General Settings', 'cbu' ),
        'type' => 'title',
        'id'   => $prefix . 'general_config_settings'
    ),
    array(
        'name'      => __( 'Redirect to', 'cbu' ),
        'id'        => $prefix . 'redirect_to',
        'type'      => 'select',
        'class'     => 'wc-enhanced-select',
        'value'   => get_option($prefix . 'redirect_to'),
        'options'   => array(
            'checkout' => 'Checkout',
            'cart' => 'Cart',
            'shop' => 'Shop',
            'home' => 'Home',
            'none' => 'None',
        ),
        'desc_tip'  => __( ' Select page to redirect after add products to cart.', 'cbu')
    ),
    array(
        'name'     => __( 'Empty cart', 'cbu' ),
        'desc_tip' => __( 'Enable if you want to clear any other products the user may have in the cart before adding the products encoded in the URL.', 'text-domain' ),
        'id'       => $prefix . 'empty_cart',
        'value'   => get_option($prefix . 'empty_cart'),
        'type'     => 'checkbox',
        'css'      => 'min-width:300px;',
        'desc'     => __( 'Empty cart action.', 'text-domain' ),
    ),
    array(
        'id'        => $prefix . 'general_config_settings',
        'name'      => __( 'General Configuration', 'pill-pack-recommendation' ),
        'type'      => 'sectionend'
    ),
);