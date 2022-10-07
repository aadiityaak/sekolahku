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
    $columns['kelas'] = __( 'Kelas', 'sekolahku' );
    $columns['hp'] = __( 'HP', 'sekolahku' );
    $columns['alamat_lengkap'] = __( 'Alamat', 'sekolahku' );

    return $columns;
}
add_filter( 'manage_edit-siswa_sortable_columns', 'my_sortable_siswa_column' );
function my_sortable_siswa_column( $columns ) {
    $columns['nis'] = 'nis';
    $columns['kelas'] = 'kelas';
    $columns['hp'] = 'hp';
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);
 
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_siswa_posts_custom_column' , 'custom_siswa_column', 10, 2 );
function custom_siswa_column( $column, $post_id ) {
    switch ( $column ) {

        case 'nis' :
            $nis = get_post_meta( $post_id , 'nis' , true);
            echo $nis;
            break;
        case 'kelas' :
            $kelas = get_post_meta( $post_id , 'kelas' , true);
            echo $kelas;
            break;
        case 'hp' :
            $hp = get_post_meta( $post_id , 'hp' , true);
            $hps = explode('/', $hp);
            foreach($hps as $nohp){
                echo $nohp.'<br>';
            }
            break;
        case 'alamat_lengkap' :
            $alamat = get_post_meta( $post_id , 'alamat_lengkap' , true);
            echo $alamat;
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