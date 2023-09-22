<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add the custom columns to the book post type:
add_filter( 'manage_form_ppdb_posts_columns', 'set_custom_edit_form_ppdb_columns' );
function set_custom_edit_form_ppdb_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date'] );
    $columns['nis'] = __( 'NIS', 'sekolahku' );
    $columns['kelas'] = __( 'Kelas', 'sekolahku' );
    $columns['hp'] = __( 'HP', 'sekolahku' );
    $columns['alamat_lengkap'] = __( 'Alamat', 'sekolahku' );

    return $columns;
}
add_filter( 'manage_edit-siswa_sortable_columns', 'my_sortable_siswa_column' );
function my_sortable_form_ppdb_column( $columns ) {
    $columns['nis'] = 'nis';
    $columns['kelas'] = 'kelas';
    $columns['hp'] = 'hp';
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);
 
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_siswa_posts_custom_column' , 'custom_siswa_column', 10, 2 );
function custom_form_ppdb_column( $column, $post_id ) {
    switch ( $column ) {

        case 'nis' :
            $nis = get_post_meta( $post_id , 'nis' , true);
            echo $nis;
            break;
        case 'kelas' :
            $kelas = get_post_meta( $post_id , 'rombel_saat_ini' , true);
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
            $alamat = get_post_meta( $post_id , 'alamat' , true);
            echo $alamat;
            break;

    }
}

// add post type form ppdb
add_action( 'init', 'register_custom_post_type_form_ppdb' );
function register_custom_post_type_form_ppdb() {
    register_post_type( 'form-ppdb',
        array(
            'labels' => array(
                'name' => __( 'Form PPDB' ),
                'singular_name' => __( 'Form PPDB' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Form PPDB' ),
                'edit_item' => __( 'Edit Form PPDB' ),
                'new_item' => __( 'New Form PPDB' ),
                'view_item' => __( 'View Form PPDB' ),
                'search_items' => __( 'Search Form PPDB' ),
                'not_found' => __( 'No Form PPDB found' ),
                'not_found_in_trash' => __( 'No Form PPDB found in Trash' ),
                'parent_item_colon' => __( 'Parent Form PPDB' ),
                'menu_name' => __( 'Form PPDB' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'form-ppdb'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/form-ppdb.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'form_ppdb',
        )
    );
}

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');
function wpdocs_register_my_custom_submenu_page_form_ppdb() {
    add_submenu_page( 
        'edit.php?post_type=form_ppdb',
        'Import',
        'Import',
        'manage_options',
        'import-form-ppdb',
        'sekolahku_import_data_form_ppdb',
    );
}

//Creat Jenjang Taxonomy
function wpdocs_create_jenjang_tax_form_ppdb() {
	register_taxonomy( 'jenjang_sekolah', 'form-ppdb', array(
		'label'        => __( 'Jenjang', 'sekolahku' ),
		'rewrite'      => array( 'slug' => 'jenjang-sekolah' ),
		'hierarchical' => true,
        'show_admin_column' => true,
	) );
}
add_action( 'init', 'wpdocs_create_jenjang_tax_form_ppdb', 0 );

//Creating Filters With Custom Taxonomy
add_action( 'restrict_manage_posts', 'filter_by_jenjang' );
function filter_by_jenjang_form_ppdb() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'siswa' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Semua Jenjang',
            'taxonomy' => 'jenjang',
            'name' => 'jenjang',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['jenjang'] ) ? $wp_query->query['jenjang'] : '' ),
            'hierarchical' => true,
            'depth' => 3,
            'show_count' => true,
            'hide_empty' => false,
            'value_field' => 'slug',
        ) );
    }
}