<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add the custom columns to the book post type:
add_filter( 'manage_siswa_posts_columns', 'set_custom_edit_siswa_columns' );
function set_custom_edit_siswa_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date'] );
    $columns['nis'] = __( 'NIS', 'sekolahku' );
    $columns['tanggal'] = __( 'Tanggal Upload', 'sekolahku' );
    $columns['guru'] = __( 'Guru', 'sekolahku' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_siswa_posts_custom_column' , 'custom_siswa_column', 10, 2 );
function custom_siswa_column( $column, $post_id ) {
    switch ( $column ) {

        case 'document_id' :
            $id = get_post_meta( $post_id , 'document_id' , true);
            $url_by_id = get_attached_file($id);
            $nama_file = basename($url_by_id);
            // print_r($attachment);
            if ( $id ){
                echo '<a href="'.wp_get_attachment_url($url_by_id).'">'.$nama_file.'</a>';
            } else {
                echo 'Document tidak valid.';
            }
            break;

        case 'tanggal' :
            $date = get_the_date('d F Y');
            if ( $date ){
                echo $date;
            } else {
                echo '-';
            }
            break;
        case 'guru' :
            $author = get_the_author();
            if ( $author ){
                echo $author;
            } else {
                echo '-';
            }
            break;

    }
}

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

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');
function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page( 
        'edit.php?post_type=siswa',
        'Import',
        'Import',
        'manage_options',
        'import-siswa',
        'sekolahku_import_data_siswa',
    );
}