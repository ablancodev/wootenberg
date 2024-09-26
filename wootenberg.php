<?php
/**
 * Plugin Name: Wootenberg
 * Description: Unlock the potential of WooCommerce with Gutenberg by enabling block editing and customizing WooCommerce templates.
 * Version: 1.0
 * Author: ablancodev
 * Author URI: https://ablancodev.com
 * License: GPLv2 or later
 * Text Domain: wootenberg
 */

// Disable new WooCommerce product template (from Version 7.7.0)
function bp_reset_product_template($post_type_args) {
    if (array_key_exists('template', $post_type_args)) {
        unset($post_type_args['template']);
    }
    return $post_type_args;
}
add_filter('woocommerce_register_post_type_product', 'bp_reset_product_template');

// Enable Gutenberg editor for WooCommerce
function bp_activate_gutenberg_product($can_edit, $post_type) {
    if ($post_type == 'product') {
        $can_edit = true;
    }
    return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'bp_activate_gutenberg_product', 10, 2);

// Enable taxonomy fields for WooCommerce with Gutenberg on
function bp_enable_taxonomy_rest($args) {
    $args['show_in_rest'] = true;
    return $args;
}
add_filter('woocommerce_taxonomy_args_product_cat', 'bp_enable_taxonomy_rest');
add_filter('woocommerce_taxonomy_args_product_tag', 'bp_enable_taxonomy_rest');

