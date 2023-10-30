<?php

/**
*Plugin Name: SP Custom Product Options
*Plugin URI: http://www.snehalpancholi.com
*Description: This plugin is used to add custom product options for woocommerce products.
*Version: 1.0
*Author: Snehal Pancholi
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_FILE.
if ( ! defined( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_FILE' ) ) {
    define( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_FILE', __FILE__ );
}

// Define SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_DIR.
if ( ! defined( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_DIR' ) ) {
    define( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Define SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_URL.

if ( ! defined( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_URL' ) ) {
    define( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Define SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_BASENAME.

if ( ! defined( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_BASENAME' ) ) {
    define( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

// Define SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_VERSION.

if ( ! defined( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_VERSION' ) ) {
    define( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_VERSION', '1.0' );
}

// Define SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_TEXT_DOMAIN.

if ( ! defined( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_TEXT_DOMAIN' ) ) {
    define( 'SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_TEXT_DOMAIN', 'sp-custom-product-options' );
}

//include backend product fields
require_once SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_DIR . 'includes/backend-product-fields.php';

//include frontend product fields
require_once SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_DIR . 'includes/frontend-product-fields.php';

//include custom functions
require_once SP_CUSTOM_PRODUCT_OPTIONS_PLUGIN_DIR . 'includes/custom-functions.php';