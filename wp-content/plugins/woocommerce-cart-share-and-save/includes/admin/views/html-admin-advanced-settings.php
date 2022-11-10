<?php
return apply_filters( 'wcss_advanced_settings', array(
    'wcss_automatically_delete_cart_options' => array(
        'title'   => __( 'Automatically Delete Cart Options', 'woo-cart-share' ),
        'id'      => 'wcss_automatically_delete_cart_options',
        'type'    => 'checkboxgroup',
        'options' => array(
            'shared_cart_after_retrieved'           => __( 'Delete shared cart after retrieved?', 'woo-cart-share' ),
            'shared_and_saved_cart_after_retrieved' => __( 'Delete saved and shared cart after retrieved?', 'woo-cart-share' ),
        ),
    ),
) );
