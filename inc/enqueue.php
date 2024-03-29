<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_admin_style() {
    $page = isset($_GET['page']) ? $_GET['page'] : '';

    wp_enqueue_script( 'jquery' );

    if(in_array($page,['dashboard-sekolah','import-siswa']) ) {
        wp_enqueue_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css');
        wp_enqueue_style('admin-bootstrap', SEKOLAHKU_URL.'asset/css/custom.css');

        wp_enqueue_script( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js', array( 'jquery' ) );
    }
    wp_enqueue_style('my-admin-theme', SEKOLAHKU_URL.'asset/css/wp-admin.css');

    
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

function sekolahku_public() {

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'custom-script', SEKOLAHKU_URL. 'asset/js/custom-script.js', array( 'jquery' ) );

    wp_localize_script( 
        'custom-script', 
        'obj', 
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ) 
        ] 
    );
}
add_action('wp_enqueue_scripts', 'sekolahku_public');