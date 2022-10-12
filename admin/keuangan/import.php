<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_import_data_keuangan() {
    ?>
    <div class="wrap">
        <h2>Import data keuangan</h2>
        <div>
            <div id="result"></div>
            <div id="status">
                <span class="error"></span>
                <span class="success"></span>
            </div>
            <input type="file" id="import-csv-keuangan" />
        </div>
    </div>
    <?php
}

