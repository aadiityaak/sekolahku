<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_import_data_siswa() {
    ?>
    <div class="wrap">
        <h2>Import data siswa</h2>
    
        <div>
            <div id="result"></div>
            <input type="file" id="import-csv" />
            
        </div>
    </div>
    <?php
}