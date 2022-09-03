<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add the custom columns to the book post type:
add_filter( 'manage_spp_posts_columns', 'set_custom_edit_spp_columns' );
function set_custom_edit_spp_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date'] );
    $columns['nis'] = __( 'NIS', 'sekolahku' );
    $columns['kelas'] = __( 'Kelas', 'sekolahku' );
    $columns['nominal'] = __( 'Nominal', 'sekolahku' );
    $columns['status'] = __( 'Status', 'sekolahku' );

    return $columns;
}
add_filter( 'manage_edit-spp_sortable_columns', 'my_sortable_spp_column' );
function my_sortable_spp_column( $columns ) {
    $columns['nis'] = 'nis';
    $columns['nominal'] = 'kelas';
    $columns['status'] = 'hp';
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);
 
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_spp_posts_custom_column' , 'custom_spp_column', 10, 2 );
function custom_spp_column( $column, $post_id ) {
    switch ( $column ) {

        case 'nis' :
            $nis = get_post_meta( $post_id , 'nis' , true);
            echo $nis;
            break;
        case 'kelas' :
            $nis = get_post_meta( $post_id , 'nis' , true);
            echo get_meta_by_nis($nis,'kelas');
            break;
        case 'nominal' :
            $nominal = get_post_meta( $post_id , 'nominal' , true);
            $nominal = preg_replace('/[^0-9]/', '', $nominal);
            $nominal = number_format($nominal,2,",",".");
            echo 'Rp '.$nominal;
            break;
        case 'status' :
            $status = get_post_meta( $post_id , 'status' , true);
            $status = $status == 'lunas' ? '<span class="sk-text-success">Lunas</span>' : '<span class="sk-text-danger">-</span>';
            echo $status;
            break;

    }
}

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