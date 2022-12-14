<?php
/**
 * @link              websweet.xyz
 * @since             1.2.0
 * @package           sekolahku
 *
 * @wordpress-plugin
 * Plugin Name:       Sekolahku
 * Plugin URI:        websweet.xyz
 * Description:       Plugin Sekolahan
 * Version:           1.6.1
 * Author:            Aditya Kristyanto
 * Author URI:        websweet.xyz
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
define( 'SEKOLAHKU_VERSION', '1.6.1' );

/**
 * Define plugin path url
 */
define( 'SEKOLAHKU_URL', plugin_dir_url( __FILE__ ) );

// Meta siswa
$siswametas = [
	'kelas' => 'Kelas',
	'hp' => 'HP',
	'alamat' => 'Alamat',
	'ayah' => 'Nama Ayah',
	'ibu' => 'Nama Ibu',
	'wali' => 'Nama Wali',
	'jenjang_sosial' => 'Jenjang Sosial',
	'saudara_kandung' => 'Saudara kandung',
	'orangtua_asuh' => 'Orang Tua Asuh',
	'alamat_orangtua_asuh' => 'Alamat',
	'hp_orangtua_asuh' => 'HP'
];

$files = array(
	'inc/function.php',
	'inc/enqueue.php',
	'inc/ajax.php',

	'admin/dashboard/dashboard.php',
    
	'admin/document/document.php',
	'admin/document/post-type.php',
	'admin/document/meta-box.php',

	'admin/siswa/siswa.php',
	'admin/siswa/meta-box.php',
	'admin/siswa/import.php',

	'admin/spp/spp.php',
	'admin/spp/meta-box.php',
	'admin/spp/import.php',

	'admin/keuangan/keuangan.php',
	'admin/keuangan/meta-box.php',
	'admin/keuangan/import.php',

	'public/document/profile-tab.php'

);
foreach ( $files as $inc ) {
	require_once plugin_dir_path( __FILE__ ) . $inc;
}

function sekolahku_plugin_activation(){
	include('inc/activation.php');
  }
  register_activation_hook( __FILE__, 'sekolahku_plugin_activation' );