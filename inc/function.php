<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Activate the plugin.
 */
function sekolahku_activate() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'siswa';

    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      nisn tinytext NOT NULL,
      nis tinytext NOT NULL,
      nama_lengkap text NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );


    $table_name = $wpdb->prefix . 'siswa_meta';
    
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      meta_key tinytext NOT NULL,
      meta_value text NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

}
