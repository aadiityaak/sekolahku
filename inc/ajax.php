<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function update_data_siswa() {
    // print_r($_POST);
    global $wpdb;
    // generate the response
    $response = [];

    // response output
    header( "Content-Type: application/json" );
    $nis = isset($_POST['nis']) ? $_POST['nis'] : '';
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    $value = isset($_POST['value']) ? $_POST['value'] : '';
    
    $table_siswa_meta = $wpdb->prefix . 'siswa_meta';
    $update = $wpdb->update( $table_siswa_meta, 
        [
            'meta_value'=>$value, 
        ], 
        [
            'meta_key'=>$key,
            'nis'=>$nis
        ]
    );
    // if($update) {
        $response['success'] = true;
        $response['message'] = $nis .' Berhasil di update!';
    // } else {
    //     $response['success'] = false;
    // }
    $response = json_encode( $response );
    echo $response;
    wp_die();
}
add_action( 'wp_ajax_update_data_siswa', 'update_data_siswa' );