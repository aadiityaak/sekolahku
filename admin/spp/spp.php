<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type spp
add_action( 'init', 'register_custom_post_type_spp' );
function register_custom_post_type_spp() {
    register_post_type( 'spp',
        array(
            'labels' => array(
                'name' => __( 'SPP' ),
                'singular_name' => __( 'SPP' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New SPP' ),
                'edit_item' => __( 'Edit SPP' ),
                'new_item' => __( 'New SPP' ),
                'view_item' => __( 'View SPP' ),
                'search_items' => __( 'Search SPP' ),
                'not_found' => __( 'No SPP found' ),
                'not_found_in_trash' => __( 'No SPP found in Trash' ),
                'parent_item_colon' => __( 'Parent SPP' ),
                'menu_name' => __( 'SPP' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'spp'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/accounts.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'spp',
        )
    );
}

add_action('admin_menu', 'sekolahku_spp_submenu_page');
function sekolahku_spp_submenu_page() {
    add_submenu_page( 
        'edit.php?post_type=spp',
        'Import',
        'Import',
        'manage_options',
        'import-spp',
        'sekolahku_import_data_spp',
    );
}