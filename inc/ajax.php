<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'wp_ajax_import_siswa', 'import_siswa' );
function import_siswa() {
	// print_r($_POST[]);
    $data = isset($_POST['data']) ? $_POST['data'] : [];
    $nis = $data[0];
    echo $nis;
	wp_die(); // this is required to terminate immediately and return a proper response
}