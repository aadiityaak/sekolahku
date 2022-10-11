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
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="import-csv">
                <label class="input-group-text" for="import-csv">Upload</label>
            </div>
            <div id="result"></div>
        </div>
    </div>
    <?php
}