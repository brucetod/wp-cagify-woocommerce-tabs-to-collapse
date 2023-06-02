<?php
/**
 * Plugin Name: Woocommerce Tabs to Collapse
 * Version: 0.1
 * Plugin URI: http://www.cagify.com/review-cage
 * Description: Change Woocommerce Tabs to Collapse
 * Author: Cagify
 * Author URI: http://www.cagify.com/
 * Requires at least: 6.2
 * Tested up to: 6.2
 *
 * Text Domain: wp-cgf-woocommerce-tabs-to-collapse
 * Domain Path: /langs/
 *
 * @package WordPress
 * @author Cagify
 * @since 0.1
 */

if (!defined('ABSPATH')) {
    exit;
}

$svg_chevron_right = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
</svg>';
$svg_chevron_down = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
</svg>';

function move_tabs()
{
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 70);
}

add_action('wp', 'move_tabs');

function wp_cgf_woocommerce_tabs_to_collapse($tabs)
{
    global $svg_chevron_right, $svg_chevron_down;
    foreach ($tabs as $key => $tab) {
        if($key === 0){
            $tabs[$key]['title'] = '<div>' . $tab['title'] . $svg_chevron_down . '</div>';
        }else{
            $tabs[$key]['title'] = '<div>' . $tab['title'] . $svg_chevron_right . '</div>';
        }
    }

    return $tabs;
}

add_filter('woocommerce_product_tabs', 'wp_cgf_woocommerce_tabs_to_collapse', 98);

