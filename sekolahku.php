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

$incs = array(
	'inc/function.php',
    'inc/post-type.php',
    'inc/profile-tab.php',
	'inc/posts-column.php',

	'siswa/siswa.php'
);
foreach ( $incs as $inc ) {
	require_once plugin_dir_path( __FILE__ ) . $inc;
}

register_activation_hook( __FILE__, 'sekolahku_activate' );