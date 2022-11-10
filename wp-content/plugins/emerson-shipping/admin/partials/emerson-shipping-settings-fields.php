<?php

$values = Emerson_Shipping_WC_Settings::get_emerson_config();

$settings = array(
    array(
        'name' => __('General Settings', 'emerson'),
        'type' => 'title',
        'id'   => $prefix . 'general_config_settings'
    ),
    array(
        'id' => 'username',
        'title' => __('Username', 'emerson'),
        'type' => 'text',
        'value'   => isset($values['username']) ? $values['username'] : '',
        'desc'  => __( 'Username for consuming Emerson API', 'emerson'),
        'default' => __('', 'emerson')
    ),
    array(
        'id' => 'password',
        'title' => __('Password', 'emerson'),
        'type' => 'password',
        'value'   => isset($values['password']) ? $values['password'] : '',
        'desc' => __('Password for consuming Emerson API', 'emerson'),
        'default' => __('', 'emerson')
    ),
    array(
        'id' => 'apiKey',
        'title' => __('API Key', 'emerson'),
        'type' => 'text',
        'value'   => isset($values['apiKey']) ? $values['apiKey'] : '',
        'desc' => __('API Key for consuming Emerson', 'emerson'),
        'default' => __('', 'emerson')
    ),
    array(
        'id' => 'apiUrl',
        'title' => __('API URL', 'emerson'),
        'type' => 'text',
        'value'   => isset($values['apiUrl']) ? $values['apiUrl'] : '',
        'desc' => __('API URL for consuming Emerson, with version number (ex: https://api.emersonecologics.com/4.3 )', 'emerson'),
        'default' => __('', 'emerson')
    ),
    array(
        'id' => 'saveLogsEmerson',
        'title' => __('Logs', 'emerson'),
        'type' => 'checkbox',
        'value'   => isset($values['saveLogsEmerson']) ? $values['saveLogsEmerson'] : '',
        'desc' => __('Enable', 'emerson'),
        'default' => 'no'
    ),
    array(
        'id'        => 'periodicity_scheduled',
        'name'      => __( 'Periodicity of scheduled tasks', 'emerson' ),
        'type'      => 'select',
        'value'   => isset($values['periodicity_scheduled']) ? $values['periodicity_scheduled'] : '',
        'class'     => 'wc-enhanced-select',
        'options'   => array('1 hour', '2 hours'),
    ),
    array(
        'id'        => 'lifetime_order',
        'name'      => __( 'Maximum lifetime of an order', 'emerson' ),
        'type'      => 'select',
        'value'   => isset($values['lifetime_order']) ? $values['lifetime_order'] : '',
        'class'     => 'wc-enhanced-select',
        'options'   => array('1 hour', '2 hours'),
    ),
    array(
        'id'    => 'emerson_config_nonce',
        'type' => 'hidden',
        'value' => wp_create_nonce( 'emerson_config_nonce' ),
    )
    ,
    array(
        'id' => $prefix . 'general_config_settings',
        'type' => 'sectionend'
    )
);
?>