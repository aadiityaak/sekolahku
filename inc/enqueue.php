<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_admin_style() {
    wp_enqueue_style('my-admin-theme', SEKOLAHKU_URL.'asset/css/wp-admin.css');

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'custom-script', SEKOLAHKU_URL. 'asset/js/script.js', array( 'jquery' ) );
}
add_action('admin_enqueue_scripts', 'sekolahku_admin_style');
add_action('login_enqueue_scripts', 'sekolahku_admin_style');