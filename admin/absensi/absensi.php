<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type keuangan
add_action( 'init', 'register_custom_post_type_absensi' );
function register_custom_post_type_absensi() {
    register_post_type( 'absensi',
        array(
            'labels' => array(
                'name' => __( 'Absensi' ),
                'singular_name' => __( 'Absensi' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Absensi' ),
                'edit_item' => __( 'Edit Absensi' ),
                'new_item' => __( 'New Absensi' ),
                'view_item' => __( 'View Absensi' ),
                'search_items' => __( 'Search Absensi' ),
                'not_found' => __( 'No Absensi found' ),
                'not_found_in_trash' => __( 'No Absensi found in Trash' ),
                'parent_item_colon' => __( 'Parent Absensi' ),
                'menu_name' => __( 'Absensi' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'absensi'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/attendance.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'absensi',
        )
    );
}

// add_action('admin_menu', 'sekolahku_absensi_submenu_page');
// function sekolahku_absensi_submenu_page() {
//     add_submenu_page( 
//         'edit.php?post_type=absensi',
//         'Import',
//         'Import',
//         'manage_options',
//         'import-absensi',
//         'sekolahku_import_data_absensi',
//     );
// }