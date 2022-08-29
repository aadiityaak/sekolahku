<?php
/**
 * @link              dev.websweet.xyz
 * @since             1.2.0
 * @package           sekolahku
 *
 * @wordpress-plugin
 * Plugin Name:       Sekolahku
 * Plugin URI:        dev.websweet.xyz
 * Description:       Plugin Sekolahan
 * Version:           1.5.0
 * Author:            Aditya Kristyanto
 * Author URI:        dev.websweet.xyz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sekolahku
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SEKOLAHKU_VERSION', '1.5.0' );

/**
 * Define plugin path url
 */
define( 'SEKOLAHKU_URL', plugin_dir_url( __FILE__ ) );

$files = array(
	'inc/function.php',
	'inc/posts-column.php',
    
	'admin/document/document.php',
	'admin/document/post-type.php',

    



	'admin/siswa/siswa.php'
);
foreach ( $files as $inc ) {
	require_once plugin_dir_path( __FILE__ ) . $inc;
}