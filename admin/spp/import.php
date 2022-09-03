<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_import_data_spp() {
    ?>
    <div class="wrap">
        <h2>Import SPP</h2>
        <div>
            <div class="format">
            Format CSV: <br>
            NIS, Bulan-tahun, Nominal, Tanggal dibayar, Status
            </div>

            <div id="result"></div>
            <input type="file" id="import-csv-spp" />
        </div>
    </div>
    <?php
}