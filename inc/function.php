<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// get post meta by nis
function get_meta_by_nis($nis, $meta_key)
{
    global $wpdb;
    $results = $wpdb->get_results("select * from $wpdb->postmeta where meta_key = 'nis' AND meta_value = '$nis'", ARRAY_A);
    return get_post_meta($results[0]['post_id'], $meta_key, true);
}
