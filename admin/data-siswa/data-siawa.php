<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type keuangan
add_action( 'init', 'register_custom_post_type_data_siswa' );
function register_custom_post_type_data_siswa() {
    register_post_type( 'data_siswa',
        array(
            'labels' => array(
                'name' => __( 'Data Siswa' ),
                'singular_name' => __( 'Data Siswa' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Data Siswa' ),
                'edit_item' => __( 'Edit Data Siswa' ),
                'new_item' => __( 'New Data Siswa' ),
                'view_item' => __( 'View Data Siswa' ),
                'search_items' => __( 'Search Data Siswa' ),
                'not_found' => __( 'No Data Siswa found' ),
                'not_found_in_trash' => __( 'No Data Siswa found in Trash' ),
                'parent_item_colon' => __( 'Parent Data Siswa' ),
                'menu_name' => __( 'Data Siswa' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'data-siswa'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/accounts.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'data_siswa',
        )
    );
}

add_action('admin_menu', 'sekolahku_data_siswa_submenu_page');
function sekolahku_data_siswa_submenu_page() {
    add_submenu_page( 
        'edit.php?post_type=data-siswa',
        'Import',
        'Import',
        'manage_options',
        'import-data-siswa',
        'sekolahku_import_data_siswa',
    );
}