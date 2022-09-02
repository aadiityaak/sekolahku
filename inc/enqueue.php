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
    wp_enqueue_script( 'jquery-csv', SEKOLAHKU_URL. 'asset/js/jquery.csv.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'jquery-highlight', SEKOLAHKU_URL. 'asset/js/highlight.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'custom-script', SEKOLAHKU_URL. 'asset/js/script.js', array( 'jquery' ) );

    wp_localize_script( 
        'custom-script', 
        'obj', 
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ) 
        ] 
    );
}
add_action('admin_enqueue_scripts', 'sekolahku_admin_style');
add_action('login_enqueue_scripts', 'sekolahku_admin_style');