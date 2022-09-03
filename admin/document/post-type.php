<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post type document
add_action( 'init', 'register_custom_post_type_document' );
function register_custom_post_type_document() {
    register_post_type( 'document',
        array(
            'labels' => array(
                'name' => __( 'Dokumen' ),
                'singular_name' => __( 'Dokumen' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Dokumen' ),
                'edit_item' => __( 'Edit Dokumen' ),
                'new_item' => __( 'New Dokumen' ),
                'view_item' => __( 'View Dokumen' ),
                'search_items' => __( 'Search Dokumen' ),
                'not_found' => __( 'No Dokumen found' ),
                'not_found_in_trash' => __( 'No Dokumen found in Trash' ),
                'parent_item_colon' => __( 'Parent Dokumen' ),
                'menu_name' => __( 'Dokumen' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'document'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/folders.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'document',
        )
    );
}