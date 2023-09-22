<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type keuangan
add_action( 'init', 'register_custom_post_type_keuangan' );
function register_custom_post_type_keuangan() {
    register_post_type( 'keuangan',
        array(
            'labels' => array(
                'name' => __( 'Keuangan' ),
                'singular_name' => __( 'Keuangan' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Keuangan' ),
                'edit_item' => __( 'Edit Keuangan' ),
                'new_item' => __( 'New Keuangan' ),
                'view_item' => __( 'View Keuangan' ),
                'search_items' => __( 'Search Keuangan' ),
                'not_found' => __( 'No Keuangan found' ),
                'not_found_in_trash' => __( 'No Keuangan found in Trash' ),
                'parent_item_colon' => __( 'Parent Keuangan' ),
                'menu_name' => __( 'Keuangan' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'keuangan'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/accounts.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'keuangan',
        )
    );
}

add_action('admin_menu', 'sekolahku_keuangan_submenu_page');
function sekolahku_keuangan_submenu_page() {
    add_submenu_page( 
        'edit.php?post_type=keuangan',
        'Import',
        'Import',
        'manage_options',
        'import-keuangan',
        'sekolahku_import_data_keuangan',
    );
}

// Fungsi untuk mengecek peran pengguna
function cek_peran_keuangan() {
    $current_user = wp_get_current_user();
    if (in_array('keuangan', $current_user->roles)) {
        // Tindakan yang akan diambil jika peran adalah 'keuangan'
        ?>
            <style>
                #menu-posts-buku,
                #menu-posts-absensi,
                #menu-posts-document,
                #menu-posts-absensi,
                #menu-posts-tahfiz {
                    display: none !important;
                }
            </style>
        <?php
    } else {
        ?>
            <style>
                #menu-posts-keuangan {
                    display: none !important;
                }
            </style>
        <?php
    }
}

// Hook ke dalam init atau hook lain yang sesuai
add_action('init', 'cek_peran_keuangan');