<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add admin Menu
function siswa_menu_items(){
    add_menu_page( 'Siswa', 'Data Siswa', 'activate_plugins', 'data_siswa', 'sekolahku_siswa_render', SEKOLAHKU_URL .'asset/img/mortarboard.png',30 );
}
add_action( 'admin_menu', 'siswa_menu_items' );

// Render admin page
function sekolahku_siswa_render(){
    $myListTable = new Table_Siswa();
    add_thickbox();
    ?>
    <div class="wrap">
        <h2>Data Siswa</h2>
        <div class="alignright">
            <a href="#" class="button button-primary">Tambah Data</a>
            <a href="#TB_inline?width=600&height=150&inlineId=import-window" title="Import data dari csv" class="thickbox button button-primary">Import Data</a>
        </div>
        <div id="import-window" style="display:none;">
            <?php sekolahku_import_data(); ?>
        </div>
        <form id="data-siswa" method="post">
        <input type="hidden" name="page" value="'.$_REQUEST['page'].'" />
        <?php
            $myListTable->prepare_items(); 
            $myListTable->display(); 
        ?>
        </form>
    </div>
    <?php
}
