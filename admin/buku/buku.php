<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type keuangan
add_action( 'init', 'register_custom_post_type_buku' );
function register_custom_post_type_buku() {
    register_post_type( 'buku',
        array(
            'labels' => array(
                'name' => __( 'Buku' ),
                'singular_name' => __( 'Buku' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Buku' ),
                'edit_item' => __( 'Edit Buku' ),
                'new_item' => __( 'New Buku' ),
                'view_item' => __( 'View Buku' ),
                'search_items' => __( 'Search Buku' ),
                'not_found' => __( 'No Buku found' ),
                'not_found_in_trash' => __( 'No Buku found in Trash' ),
                'parent_item_colon' => __( 'Parent Buku' ),
                'menu_name' => __( 'Buku' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'buku'),
            'supports' => array( 'title','thumbnail','editor'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/books.png',
            'capability_type' => 'post',
            'show_in_rest' => true,
            'rest_base' => 'buku',
        )
    );
}

add_action('admin_menu', 'sekolahku_buku_submenu_page');
function sekolahku_buku_submenu_page() {
    add_submenu_page( 
        'edit.php?post_type=buku',
        'Import',
        'Import',
        'manage_options',
        'import-buku',
        'sekolahku_import_data_buku',
    );
}