<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $wpdb;
$table_name = $wpdb->prefix . 'siswa';

$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  nisn tinytext NOT NULL,
  nis tinytext NOT NULL,
  nama_lengkap text NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY nis (nis)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

$table_name = $wpdb->prefix . 'siswa_meta';

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  nis tinytext NOT NULL,
  meta_key tinytext NOT NULL,
  meta_value text NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

$table_name = $wpdb->prefix . 'tagihan';

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  id_tagihan tinytext NOT NULL,
  nis tinytext NOT NULL,
  tagihan tinytext NOT NULL,
  nominal text NOT NULL,
  tempo tinytext NOT NULL,
  create_at tinytext NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

$table_name = $wpdb->prefix . 'pembayaran';

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  nis tinytext NOT NULL,
  id_tagihan tinytext NOT NULL,
  nominal text NOT NULL,
  status tinytext NOT NULL,
  create_at tinytext NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

