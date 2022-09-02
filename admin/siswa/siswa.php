<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type siswa
add_action( 'init', 'register_custom_post_type_siswa' );
function register_custom_post_type_siswa() {
    register_post_type( 'siswa',
        array(
            'labels' => array(
                'name' => __( 'Siswa' ),
                'singular_name' => __( 'Siswa' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Siswa' ),
                'edit_item' => __( 'Edit Siswa' ),
                'new_item' => __( 'New Siswa' ),
                'view_item' => __( 'View Siswa' ),
                'search_items' => __( 'Search Siswa' ),
                'not_found' => __( 'No Siswa found' ),
                'not_found_in_trash' => __( 'No Siswa found in Trash' ),
                'parent_item_colon' => __( 'Parent Siswa' ),
                'menu_name' => __( 'Siswa' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'siswa'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/mortarboard.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'siswa',
        )
    );
}