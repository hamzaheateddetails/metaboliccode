<?php
/**
 * Plugin Name: Shipping Packages for WooCommerce
 * Plugin URI: https://wordpress.org/plugins/wc-shipping-packages
 * Description: Groups products in the cart into packages, so they can be shipped with different shipping methods.
 * Version: 1.1.27
 * Tested up to: 6.0.2
 * WC requires at least: 6.0
 * WC tested up to: 6.9
 * Author: OneTeamSoftware
 * Author URI: http://oneteamsoftware.com/
 * Developer: OneTeamSoftware
 * Developer URI: http://oneteamsoftware.com/
 * Text Domain: wc-shipping-packages
 * Domain Path: /languages
 *
 * Copyright: © 2022 FlexRC, 3-7170 Ash Cres, V6P 3K7, Canada. Voice 604 800-7879
 */

namespace OneTeamSoftware\WooCommerce\ShippingPackages;

require_once(__DIR__ . '/includes/ShippingPackages.php');

(new ShippingPackages())->register();
